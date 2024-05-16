<?php

namespace App\Http\Controllers;

use App\Models\BookmarkLocation;
use App\Models\Category;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function listCategories(Request $request)
    {
        // Get the per_page and page parameters from the request query string
        $perPage = $request->query('per_page', 10);
        $page = $request->query('page', 1);

        // Retrieve categories with products using pagination
        $categories = Category::with('products')->paginate($perPage, ['*'], 'page', $page);

        // Return the paginated categories as JSON response
        return response()->json($categories);
    }

    #my cart items
    public function listCartItems()
    {
        $user = auth()->user();
        $cartItems = $user->cartItems()->with(['product'])->get();
        return response()->json($cartItems);
    }

    public function addToCart(Request $request)
    {
        $user = auth()->user();
        $cart = Cart::create([
            'user_id' => $user->id,
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
        ]);

        return response()->json(
            [
                'message' => 'Product added to cart', 'cart' => $cart->load('product')
            ]
        );
    }


    public function removeFromCart(Request $request)
    {
        $user = auth()->user();
        $productId = $request->product_id;

        // Find the cart item associated with the product ID
        $cartItem = Cart::where('user_id', $user->id)
            ->where('product_id', $productId)
            ->first();

        if (!$cartItem) {
            return response()->json(['message' => 'Item not found in the cart'], 404);
        }

        // Delete the cart item
        $cartItem->delete();

        return response()->json([
            'message' => 'Item removed from the cart', 'cart_item' => $cartItem->load('product')
        ]);
    }



    public function checkout(Request $request)
    {
        try {
            // Step 1: Validate request data
            $request->validate([
                'latitude' => 'required|numeric',
                'longitude' => 'required|numeric',
                'address' => 'required|string',
                'products' => 'required|array',
                'products.*.product_id' => [
                    'required',
                    'exists:products,id' // Ensure each product ID exists in the database
                ],
                'products.*.quantity' => 'required|integer|min:1',
                'bookmark_location_id' => 'nullable|exists:bookmark_locations,id' ,// Check if the bookmark_location_id exists
                'address_url' => 'nullable|string',
            ]);

            // Step 2: Start a database transaction
            DB::beginTransaction();

            // Step 3: Process the checkout, including location and address
            $user = auth()->user();
            $cartItems = $request->input('products');
            $totalAmount = $this->calculateTotalAmount($cartItems);


            // Check if bookmark location ID is provided
            if ($request->has('bookmark_location_id')) {
                $bookmarkLocation = BookmarkLocation::findOrFail($request->bookmark_location_id);
                $latitude = $bookmarkLocation->latitude;
                $longitude = $bookmarkLocation->longitude;
                $address = $bookmarkLocation->address;
            } else {
                // Check if a bookmark location with the same latitude, longitude, and address exists
                $existingLocation = BookmarkLocation::where('latitude', $request->latitude)
                    ->where('longitude', $request->longitude)
                    ->where('address', $request->address)
                    ->first();

                // If a matching bookmark location exists, use it
                if ($existingLocation) {
                    $latitude = $existingLocation->latitude;
                    $longitude = $existingLocation->longitude;
                    $address = $existingLocation->address;
                } else {
                    // Create a new bookmark location
                    $newBookmarkLocation = BookmarkLocation::create([
                        'user_id' => $user->id,
                        'latitude' => $request->latitude,
                        'longitude' => $request->longitude,
                        'address' => $request->address,
                    ]);
                    $latitude = $newBookmarkLocation->latitude;
                    $longitude = $newBookmarkLocation->longitude;
                    $address = $newBookmarkLocation->address;
                }
            }
            // Proceed with the checkout
            $order = Order::create([
                'user_id' => $user->id,
                'total_amount' => $totalAmount,
                'latitude' => $latitude,
                'longitude' => $longitude,
                'address' => $address,
            ]);
            //if request has address_url
            if ($request->has('address_url')) {
                $order->address_url = $request->address_url;
            }

            // Attach products to the order
            foreach ($cartItems as $cartItem) {
                $productId = $cartItem['product_id'];
                $quantity = $cartItem['quantity'];
                $order->products()->attach($productId, ['quantity' => $quantity]);
            }
            // Clear user's cart
            $user->cartItems()->delete();

            $order->save();

            // Commit the transaction
            DB::commit();

            // Return success response
            return response()->json([
                'message' => 'Order placed successfully',
                'order' => $order->fresh()->load('products') // Load fresh order instance before eager loading products
            ]);
        } catch (\Exception $e) {
            // If an exception occurs, rollback the transaction and return error response
            DB::rollback();
            return response()->json([
                'error' => 'Failed to process checkout',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    //    public function checkout(Request $request)
    //    {
    //        // Process the checkout, including location and address
    //        $user = auth()->user();
    //        $cartItems = $user->cartItems;
    //
    //        $order = Order::create([
    //            'user_id' => $user->id,
    //            'total_amount' => $this->calculateTotalAmount($cartItems),
    //            'latitude' => $request->latitude,
    //            'longitude' => $request->longitude,
    //            'address' => $request->address,
    //        ]);
    //
    //        foreach ($cartItems as $cartItem) {
    //            $order->products()->attach($cartItem->product_id
    //            // , ['quantity' => $cartItem->quantity]
    //            );
    //        }
    //
    //        // Clear user's cart
    //        $user->cartItems()->delete();
    //
    //        return response()->json(
    //            [
    //                'message' => 'Order placed successfully'
    //                , 'order' => $order->load('products')
    //            ]);
    //    }

    //    private function calculateTotalAmount($cartItems)
    //    {
    //        $totalAmount = 0;
    //        foreach ($cartItems as $cartItem) {
    //            $totalAmount += $cartItem->product->price * $cartItem->quantity;
    //        }
    //        return $totalAmount;
    //
    //    }

    private function calculateTotalAmount($cartItems)
    {
        $totalAmount = 0;
        foreach ($cartItems as $cartItem) {
            // Ensure the 'product_id' and 'quantity' keys exist in the cart item array
            if (isset($cartItem['product_id']) && isset($cartItem['quantity'])) {
                // Retrieve the product price from the database based on the product ID
                $productId = $cartItem['product_id'];
                $quantity = $cartItem['quantity'];

                // Retrieve the product information from the database
                $product = Product::find($productId);

                // If the product exists, calculate the subtotal
                if ($product) {
                    $productPrice = $product->price;
                    $subtotal = $productPrice * $quantity;
                    $totalAmount += $subtotal;
                }
            }
        }
        return $totalAmount;
    }



    public function listOrders(Request $request)
    {
        $user = auth()->user();

        // Get the per_page and page parameters from the request query string
        $perPage = $request->query('per_page', 10);
        $page = $request->query('page', 1);

        // Initialize query builder for orders
        $query = $user->orders()->with(['products'])->latest('created_at');

        // Filter orders by status if it exists in the request
        if ($request->has('status')) {
            $status = $request->input('status');
            if (in_array($status, ['pending', 'completed'])) {
                $query->where('status', $status);
            } else {
                return response()->json(['error' => 'Invalid status value'], 400);
            }
        }

        // Paginate the filtered orders
        $orders = $query->paginate($perPage, ['*'], 'page', $page);

        // Return the paginated orders as JSON response
        return response()->json($orders);
    }

    // List products by category ID with pagination and filters
    public function listProductsByCategoryId(Request $request, $categoryId)
    {
        // Define query builder for products
        $query = Product::where('category_id', $categoryId);

        // Filter products by name
        if ($request->has('name')) {
            $query->where('name', 'like', '%' . $request->input('name') . '%');
        }

        // Filter products by price range
        if ($request->has('min_price')) {
            $query->where('price', '>=', $request->input('min_price'));
        }
        if ($request->has('max_price')) {
            $query->where('price', '<=', $request->input('max_price'));
        }

        // Filter products by size
        if ($request->has('size')) {
            $query->where('size', $request->input('size'));
        }

        // Paginate the products
        $perPage = $request->query('per_page', 10);
        $page = $request->query('page', 1); // Ensure 'page' parameter is included
        $products = $query->paginate($perPage, ['*'], 'page', $page);

        // Return paginated products as JSON response
        return response()->json($products);
    }

    // List categories with pagination and filters by name
    public function listCategoriesOnly(Request $request)
    {
        // Define query builder for categories
        $query = Category::query();

        // Filter products by name
        if ($request->has('name')) {
            $query->where('name', 'like', '%' . $request->input('name') . '%');
        }

        // Paginate the categories
        $perPage = $request->query('per_page', 10);
        $page = $request->query('page', 1); // Ensure 'page' parameter is included
        $categories = $query->paginate($perPage, ['*'], 'page', $page);

        // If a parameter 'hot_deals' is present, retrieve categories with the most ordered products
        if ($request->has('hot_deals')) {
            $categories = $this->getHotDealCategories($categories, $perPage, $page);
        }

        // If a parameter 'most_ordering' is present, retrieve categories with the most ordered products
        if ($request->has('most_ordering')) {
            $categories = $this->getMostOrderingCategories($categories, $perPage, $page);
        }

        // Return paginated categories as JSON response
        return response()->json($categories);
    }

    // Helper function to get categories with the most ordered products
    private function getMostOrderingCategories($categories, $perPage, $page)
    {
        // Get category IDs
        $categoryIds = $categories->pluck('id');

        // Get the count of orders for each category
        $categoryOrderCounts = DB::table('order_product')
        ->join('products', 'order_product.product_id', '=', 'products.id')
        ->whereIn('products.category_id', $categoryIds)
            ->select('products.category_id', DB::raw('COUNT(*) as order_count'))
            ->groupBy('products.category_id')
            ->get();

        // Get the category IDs with the maximum order count
        $maxOrderCount = $categoryOrderCounts->max('order_count');
        $maxOrderCategoryIds = $categoryOrderCounts->where('order_count', $maxOrderCount)->pluck('category_id');

        // Retrieve categories based on the category IDs with the maximum order count
        $maxOrderCategories = Category::whereIn('id', $maxOrderCategoryIds)
            ->paginate($perPage, ['*'], 'page', $page);

        return $maxOrderCategories;
    }

    // Helper function to get categories with the most ordered products
    private function getHotDealCategories($categories, $perPage, $page)
    {
        // Get category IDs
        $categoryIds = $categories->pluck('id');

        // Get the count of orders for each category
        $categoryOrderCounts = DB::table('order_product')
        ->join('products', 'order_product.product_id', '=', 'products.id')
        ->whereIn('products.category_id', $categoryIds)
            ->select('products.category_id', DB::raw('COUNT(*) as order_count'))
            ->groupBy('products.category_id')
            ->get();

        // Sort categories by order count in descending order
        $categoryOrderCounts = $categoryOrderCounts->sortByDesc('order_count');

        // Get the sorted category IDs
        $sortedCategoryIds = $categoryOrderCounts->pluck('category_id');

        // Retrieve categories based on the sorted IDs
        $sortedCategories = Category::whereIn('id', $sortedCategoryIds)
        ->paginate($perPage, ['*'], 'page', $page);


        return $sortedCategories;
    }

    
}
