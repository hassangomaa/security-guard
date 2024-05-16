<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Company;
use App\Models\Contact;
use App\Models\Family;
use App\Models\FamilyBranch;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Person;
use App\Models\Product;
use App\Models\User;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function admin()
    {
        $totalUsers = User::count();
        // $totalOrders = Order::count();
        // $completedOrders = Order::where('status', 'completed')->count();
        // $pendingOrders = Order::where('status', 'pending')->count();
        // $totalProducts = Product::count();
        // $totalCategories = Category::count();
        // $totalPaidMoney = Order::where('status', 'completed')->sum('total_amount');
        // //TOTALL FAMILY 
        // $totalFamily = Family::count();
        // //totall family branch
        // $totalFamilyBranch = FamilyBranch::count();

        // //total persons
        // $totalPersons = Person::count();

        $totalContacts = Contact::count();

        return view('admin-login', compact(
            'totalUsers',
            // 'totalOrders',
            // 'completedOrders',
            // 'pendingOrders',
            // 'totalProducts',
            // 'totalCategories',
            // 'totalPaidMoney',
            // 'totalFamily',
            // 'totalFamilyBranch',
            // 'totalPersons',
            'totalContacts'
        ));
    }
}
