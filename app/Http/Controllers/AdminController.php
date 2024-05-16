<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\Table;
use App\Models\User;
use App\Models\Waiter;
use App\Models\Zone;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    // listTables
    public function listTables()
    {
        $tables = Table::with('zone', 'order') // Retrieving tables with zone
            ->latest()
            ->get(); // Retrieving tables in descending order by creation time
        return response()->json($tables);
    }
    //getTable
    public function getTable($id)
    {
        $table = Table::find($id);
        if (!$table)
            return response()->json(['message' => 'Table not found'], 404);
        return response()->json($table->load('zone', 'order'));
    }


    //createTable
    public function createTable(Request $request)
    {
        $table = Table::create([
            'name' => $request->name,
            'zone_id' => $request->zone_id,
            'status' => $request->status,
            'order_id' => $request->order_id,
            'from' => $request->from,
            'to' => $request->to,
        ]);
        return response()->json(['message' => 'Table created successfully', 'table' => $table]);
    }

    //updateTable
    public function updateTable(Request $request, $id)
    {
        $table = Table::find($id);
        if (!$table)
            return response()->json(['message' => 'Table not found'], 404);
        $table->update([
            'name' => $request->name,
            'zone_id' => $request->zone_id,
            'status' => $request->status,
            'order_id' => $request->order_id,
            'from' => $request->from,
            'to' => $request->to,
        ]);
        $table->save();
        return response()->json(['message' => 'Table updated successfully', 'table' => $table]);
    }

    //deleteTable
    public function deleteTable($id)
    {
        $table = Table::find($id);
        if (!$table)
            return response()->json(['message' => 'Table not found'], 404);
        $table->delete();
        return response()->json([
            'message' => 'Table deleted successfully',
            'table' => $table
        ]);
    }




    public function listProducts()
    {
        $products = Product::all();
        return response()->json($products);
    }

    public function listCategories()
    {
        $categories = Category::all();
        return response()->json($categories);
    }

    public function listCategoriesProducts()
    {
        $categories = Category::with('products')->get();
        return response()->json($categories);
    }

    public function listOrders()
    {
        $orders = Order::with(['user', 'products'])
            ->latest()
            ->get();
        return response()->json($orders);
    }

    #update order
    public function updateOrder(Request $request, $id)
    {
        $order = Order::find($id);
        if (!$order)
            return response()->json(['message' => 'Order not found'], 404);
        $order->update([
            'user_id' => $request->user_id,
            'total_amount' => $request->total_amount,
            'table_number' => $request->table_number,
            'waiter_name' => $request->waiter_name,
            'casher_name' => $request->casher_name,
        ]);
        $order->save();

        return response()->json(['message' => 'Order updated successfully']);
    }

    #get order
    public function getOrder($id)
    {
        $order = Order::find($id);
        if (!$order)
            return response()->json(['message' => 'Order not found'], 404);
        return response()->json($order->load('products'));
    }
    #delete order
    public function deleteOrder($id)
    {
        $order = Order::find($id);
        if (!$order)
            return response()->json(['message' => 'Order not found'], 404);
        $order->delete();
        return response()->json(['message' => 'Order deleted successfully', 'order' => $order]);
    }


    public function createCategory(Request $request)
    {
        $category = Category::create([
            'name' => $request->name,
            'printer_name' => $request->printer_name,
        ]);
        #upload the image
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image->move('images', $image->getClientOriginalName());
            $category->image = $image->getClientOriginalName();
            $category->save();
        }

        return response()->json([
            'message' => 'Category created successfully', 'category' => $category->load('products')
        ]);
    }

    public function updateCategory(Request $request, $id)
    {
        // return $request->all();

        #if not found throw 404
        $category = Category::find($id);

        if (!$category)
            return  response()->json(['message' => 'Category not found'], 404);

        $category->update([
            'name' => $request->name,
            'printer_name' => $request->printer_name,

        ]);
        $category->save();

        #upload the image
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image->move('images', $image->getClientOriginalName());
            $category->image = $image->getClientOriginalName();
            $category->save();
        }

        return response()->json([
            'message' => 'Category updated successfully', 'category' => $category->load('products')
        ]);
    }

    public function deleteCategory($id)
    {
        $category = Category::find($id);
        if (!$category)
            return response()->json(['message' => 'Category not found'], 404);
        // #remove the image
        // $image = $category->image;
        // $image_path = public_path('images/'.$image);
        // if(file_exists($image_path))
        //     unlink($image_path);
        #delete the category
        $category->delete();


        return response()->json(['message' => 'Category deleted successfully']);
    }

    public function createProduct(Request $request)
    {

        $product = Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'category_id' => $request->category_id,
            'quantity' => $request->quantity,
        ]);
        //image
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image->move('images', $image->getClientOriginalName());
            $product->image = $image->getClientOriginalName();
            $product->save();
        }
        return response()->json([
            'message' => 'Product created successfully', 'product' => $product->load('category')
        ]);
    }

    public function updateProduct(Request $request, $id)
    {
        $product = Product::find($id);
        if (!$product)
            return response()->json(['message' => 'Product not found'], 404);
        $product->update([
            'name' => $request->name,
            'price' => $request->price,
            'category_id' => $request->category_id,
            'quantity' => $request->quantity,
        ]);
        $product->save();

        //image
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image->move('images', $image->getClientOriginalName());
            $product->image = $image->getClientOriginalName();
            $product->save();
        }
        return response()->json([
            'message' => 'Product updated successfully', 'product' => $product->load('category')
        ]);
    }

    public function deleteProduct($id)
    {
        $product = Product::find($id);
        if (!$product)
            return response()->json(['message' => 'Product not found'], 404);
        $product->delete();
        return response()->json([
            'message' => 'Product deleted successfully', 'product' => $product
        ]);
    }

    public function updateUser(Request $request, $id)
    {
        $user = User::find($id);
        if (!$user)
            return response()->json(['message' => 'User not found'], 404);

        $request->validate([
            'name' => 'required|string',
            // 'email' => 'required|email|unique:users,email',
            'password' => 'required|string',
            // 'user_type' => 'required|in:admin,casher,waiter',
        ]);

        $user->update([
            'name' => $request->name,
            "password" => bcrypt($request->password),
            "user_type" => $request->user_type,
        ]);
        $user->save();
        // #update email if changed
        // if($request->email != $user->email)
        // {

        //     $user->update(['email' => $request->email]);
        // }
        return  response()->json([
            'message' => 'User updated successfully', 'user' => $user
        ]);
    }
    #getUser
    public function getUser($id)
    {
        $user = User::find($id);
        if (!$user)
            return response()->json(['message' => 'User not found'], 404);
        return response()->json($user);
    }
    #getUserTotalOrdersAmountByDate
    #getUserAccountTotalOrders
    #getUserAccountTotalOrders
    public function getUserAccountTotalOrders($id)
    {
        $user = User::find($id);
        if (!$user)
            return response()->json(['message' => 'User not found'], 404);

        $ordersByDate = Order::select(DB::raw('DATE(created_at) as order_date'), DB::raw('COUNT(id) as order_count'), DB::raw('SUM(total_amount) as total_price'))
            ->where('user_id', $id)
            ->groupBy('order_date')
            ->orderBy('order_date')
            ->get();

        $formattedResponse = [];

        foreach ($ordersByDate as $orderData) {
            $formattedResponse[] = [
                'Date' => date('d-m-Y', strtotime($orderData->order_date)),
                'Count of orders' => $orderData->order_count,
                'Total price' => $orderData->total_price,
            ];
        }

        return response()->json($formattedResponse);
    }



    #getAllCashierOrders
    public function getAllCashierOrders()
    {
        $cashierOrders = User::where('user_type', 'Cashier')
            ->with(['orders' => function ($query) {
                $query->select(DB::raw('DATE(created_at) as order_date'), DB::raw('COUNT(id) as order_count'), DB::raw('SUM(total_amount) as total_price'))
                    ->groupBy('order_date')
                    ->orderBy('order_date');
            }])
            ->get();

        $formattedResponse = [];

        foreach ($cashierOrders as $cashier) {
            foreach ($cashier->orders as $orderData) {
                $formattedResponse[] = [
                    'User' => [
                        'Name' => $cashier->name,
                        'User Type' => $cashier->user_type,
                    ],
                    'Date' => date('d-m-Y', strtotime($orderData->order_date)),
                    'Count of orders' => $orderData->order_count,
                    'Total price' => $orderData->total_price . ' USD',
                ];
            }
        }

        return response()->json($formattedResponse);
    }


    #list users
    public function listUsers()
    {
        $users = User::all();
        return response()->json($users);
    }

    //listWaiters
    public function listWaiters()
    {
        $waiters = Waiter::all();
        return response()->json($waiters);
    }
    //getWaiter
    public function getWaiter($id)
    {
        $waiter = Waiter::find($id);
        if (!$waiter)
            return response()->json(['message' => 'Waiter not found'], 404);
        return response()->json($waiter);
    }
    //createWaiter
    public function createWaiter(Request $request)
    {
        $waiter = Waiter::create([
            'name' => $request->name,
            'title' => $request->title,
            'details' => $request->details,
        ]);
        return response()->json(['message' => 'Waiter created successfully', 'waiter' => $waiter]);
    }
    //updateWaiter
    public function updateWaiter(Request $request, $id)
    {
        $waiter = Waiter::find($id);
        if (!$waiter)
            return response()->json(['message' => 'Waiter not found'], 404);
        $waiter->update([
            'name' => $request->name,
            'title' => $request->title,
            'details' => $request->details,
        ]);
        $waiter->save();
        return response()->json(['message' => 'Waiter updated successfully', 'waiter' => $waiter]);
    }
    //deleteWaiter
    public function deleteWaiter($id)
    {
        $waiter = Waiter::find($id);
        if (!$waiter)
            return response()->json(['message' => 'Waiter not found'], 404);
        $waiter->delete();
        return response()->json([
            'message' => 'Waiter deleted successfully',
            'waiter' => $waiter
        ]);
    }



    //listOrdersByDate
    public function listOrdersByDate($date)
    {
        $orders = Order::whereDate('created_at', $date)->with(['user', 'products'])->get();
        return response()->json($orders);
    }

    #deleteUser
    public function deleteUser($id)
    {

        $user = User::find($id);
        if (!$user)
            return response()->json(['message' => 'User not found'], 404);
        $tmep = $user;
        $user->delete();
        return response()->json([
            'message' => 'User deleted successfully',
            'user' => $tmep
        ]);
    }

    //update order status
    public function updateOrderStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->update([
            'status' => $request->status,
        ]);

        return response()->json([
            'message' => 'Order status updated successfully', 'order' => $order->load('products')
        ]);
    }

    //cruds for zones
    public function listZones()
    {
        $zones = Zone::with('branches')
            ->latest()
            ->get();
        return response()->json($zones);
    }
    #getZone
    public function getZone($id)
    {
        $zone = Zone::find($id);
        if (!$zone)
            return response()->json(['message' => 'Zone not found'], 404);
        return response()->json($zone->load('branches'));
    }

    public function createZone(Request $request)
    {
        //unique name for each zone
        $request->validate([
            'name' => 'required|string|unique:zones,name',
        ]);

        $zone = Zone::create([
            'name' => $request->name,
        ]);

        return response()->json(['message' => 'Zone created successfully', 'zone' => $zone]);
    }

    public function updateZone(Request $request, $id)
    {
        $zone = Zone::find($id);
        if (!$zone)
            return response()->json(['message' => 'Zone not found'], 404);
        $zone->update([
            'name' => $request->name,
        ]);
        $zone->save();
        return response()->json(['message' => 'Zone updated successfully', 'zone' => $zone]);
    }

    public function deleteZone($id)
    {
        $zone = Zone::find($id);
        if (!$zone)
            return response()->json(['message' => 'Zone not found'], 404);
        $zone->delete();
        return response()->json([
            'message' => 'Zone deleted successfully',
            'zone' => $zone
        ]);
    }

    //cruds for branches
    public function listBranches()
    {
        // return 'list branches' ;
        $branches = Branch::with('zone')
            ->latest()
            ->get();
        return response()->json($branches);
    }

    public function createBranch(Request $request)
    {
        $branch = Branch::create([
            'name' => $request->name,
            'zone_id' => $request->zone_id,
        ]);
        return response()->json(['message' => 'Branch created successfully', 'branch' => $branch]);
    }

    public function updateBranch(Request $request, $id)
    {
        $branch = Branch::find($id);
        if (!$branch)
            return response()->json(['message' => 'Branch not found'], 404);
        $branch->update([
            'name' => $request->name,
            'zone_id' => $request->zone_id,
        ]);
        $branch->save();
        return response()->json(['message' => 'Branch updated successfully', 'branch' => $branch]);
    }

    public function deleteBranch($id)
    {
        $branch = Branch::find($id);
        if (!$branch)
            return response()->json(['message' => 'Branch not found'], 404);
        $branch->delete();
        return response()->json([
            'message' => 'Branch deleted successfully',
            'branch' => $branch
        ]);
    }



    // Add this method to your AdminController class
    public function getItemSalesCountByDate($date)
    {
        $orders = Order::whereDate('created_at', $date)->with('products')->get();

        $itemCounts = [];

        foreach ($orders as $order) {
            foreach ($order->products as $product) {
                if (!isset($itemCounts[$product->id])) {
                    $itemCounts[$product->id] = [
                        'Item Name' => $product->name,
                        'Item Count' => 1,
                    ];
                } else {
                    $itemCounts[$product->id]['Item Count']++;
                }
            }
        }

        return response()->json(array_values($itemCounts));
    }
}
