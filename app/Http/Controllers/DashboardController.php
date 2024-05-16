<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard');
    }


    public function company()
    {
        return view('company.dashboard');
    }


    public function user()
    {
        return view('user.dashboard');
    }

    public function terms()
    {
        return view('terms_condition');
    }


}
