<?php

use App\Http\Controllers\AdminController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookmarkLocationController;
use App\Http\Controllers\CashierController;
use App\Http\Controllers\UserController;


Route::middleware([
    //    'auth:api'
    'throttle:10,1',
    'guest'
])->group(function () {
    Route::post('auth/verifyToken/{token}/{email}', [AuthController::class, 'verifyEmail'])->name('verify.email');
    Route::get('auth/verifyToken/{token}/{email}', [AuthController::class, 'verifyEmailByGet'])->name('verify.email.get  ');

    Route::post('auth/resend-otp/{email}', [AuthController::class, 'resendOTP'])->name('resend.otp');
});

Route::middleware('guest')->group(
    function () {
        Route::post('register', [AuthController::class, 'register']);
        Route::post('login', [AuthController::class, 'login']);
    }
);

#my profile
#update profile
Route::middleware('auth:sanctum')->group(
    function () {
        // Route::put('user/update/{id}', [AuthController::class, 'update'])->middleware('auth:sanctum');
        //update my profile
        Route::put('profile/update/', [AuthController::class, 'updateMyProfile'])->middleware('auth:sanctum');
        Route::post('profile/upload-avatar', [AuthController::class, 'uploadAvatar'])->name('upload.avatar')->middleware('auth:sanctum');

        Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
        Route::get('profile', [AuthController::class, 'profile']);
    }
);



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['middleware' => 'auth:sanctum'], function () {
    // Protected routes


    /* ****************************************************************Admin routes******************************************************************* */
    Route::prefix('admin')->group(function () {
        Route::get('orders', [AdminController::class, 'listOrders']);
        //update order
        Route::put('orders/{id}', [AdminController::class, 'updateOrder']);
        //get order
        Route::get('orders/{id}', [AdminController::class, 'getOrder']);
        //delete order
        Route::delete('orders/{id}', [AdminController::class, 'deleteOrder']);

        //get orders by date
        Route::get('orders/{date}', [AdminController::class, 'listOrdersByDate']);
        #list users
        Route::get('users', [AdminController::class, 'listUsers']);
        #delete user
        Route::delete('users/{id}', [AdminController::class, 'deleteUser']);


        // Categories
        Route::get('categories', [AdminController::class, 'listCategories']);
        Route::get('categories/products', [AdminController::class, 'listCategoriesProducts']);
        Route::post('categories', [AdminController::class, 'createCategory']);
        Route::post('categories/{id}', [AdminController::class, 'updateCategory']);
        Route::delete('categories/{id}', [AdminController::class, 'deleteCategory']);

        //waiters
        Route::get('waiters', [AdminController::class, 'listWaiters']);
        #get one
        Route::get('waiters/{id}', [AdminController::class, 'getWaiter']);
        Route::post('waiters', [AdminController::class, 'createWaiter']);
        Route::post('waiters/{id}', [AdminController::class, 'updateWaiter']);
        Route::delete('waiters/{id}', [AdminController::class, 'deleteWaiter']);


        // Products
        Route::get('products', [AdminController::class, 'listProducts']);
        Route::post('products', [AdminController::class, 'createProduct']);
        Route::post('products/{id}', [AdminController::class, 'updateProduct']);
        Route::delete('products/{id}', [AdminController::class, 'deleteProduct']);

        //tables
        Route::get('tables', [AdminController::class, 'listTables']);
        #get one
        Route::get('tables/{id}', [AdminController::class, 'getTable']);
        Route::post('tables', [AdminController::class, 'createTable']);
        Route::post('tables/{id}', [AdminController::class, 'updateTable']);
        Route::delete('tables/{id}', [AdminController::class, 'deleteTable']);

        //zones
        Route::get('zones', [AdminController::class, 'listZones']);
        #get one
        Route::get('zones/{id}', [AdminController::class, 'getZone']);
        Route::post('zones', [AdminController::class, 'createZone']);
        Route::post('zones/{id}', [AdminController::class, 'updateZone']);
        Route::delete('zones/{id}', [AdminController::class, 'deleteZone']);

        //branches
        Route::get('branches', [AdminController::class, 'listBranches']);
        Route::post('branches', [AdminController::class, 'createBranch']);
        Route::post('branches/{id}', [AdminController::class, 'updateBranch']);
        Route::delete('branches/{id}', [AdminController::class, 'deleteBranch']);


        // Users (for example, updating user details)
        Route::put('users/{id}', [AdminController::class, 'updateUser']);
        Route::get('users/{id}', [AdminController::class, 'getUser']);

        //get user totla orders amount by date
        Route::get('users/{id}/totalorders', [AdminController::class, 'getUserAccountTotalOrders']);
        #getAllCashierOrders
        Route::get('users/cashier/orders', [AdminController::class, 'getAllCashierOrders']);
        #getItemSalesCountByDate
        Route::get('users/cashier/orders/{date}', [AdminController::class, 'getItemSalesCountByDate']);
    });

    /******************************************  Cashier routes ***************************************************/

    Route::prefix('cashier')->group(function () {
        Route::get('products', [CashierController::class, 'listProducts']);
        Route::post('create-order', [CashierController::class, 'createOrder']);
        Route::post('orders/{id}', [CashierController::class, 'updateOrder']);
    });


    /******************************************  User routes ***************************************************/
    Route::prefix('user')->group(function () {
        Route::post('add-to-cart', [UserController::class, 'addToCart']);
        Route::post('checkout', [UserController::class, 'checkout']);
        Route::get('orders', [UserController::class, 'listOrders']);
        Route::get('cart-items', [UserController::class, 'listCartItems']);
        Route::post('cart/remove', [UserController::class, 'removeFromCart']);


        // Bookmark Locations
        Route::post('bookmark-locations', [BookmarkLocationController::class, 'store']);
        Route::get('bookmark-locations', [BookmarkLocationController::class, 'listBookmarkedLocations']);
        Route::delete('bookmark-locations/{id}', [BookmarkLocationController::class, 'delete']);
    });
});

/*************PUBLIC ROUTES IOS/ ANDROID ******************************************************/

Route::middleware([
    //    'auth:api'
    'throttle:30,1'
])
    // ->name('user.') // Fix: Use the 'name' method instead of 'as'
    ->prefix('user')
    ->group(function () {
        Route::get('categories', [UserController::class, 'listCategories']);

        ###
        // List products by category ID
        Route::get('products/category/{categoryId}', [UserController::class, 'listProductsByCategoryId']);

        // List categories with pagination and filters by name
        Route::get('categories/index', [UserController::class, 'listCategoriesOnly']);
    });
