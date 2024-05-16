<?php

namespace App\Http\Controllers\Auth\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
//use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    //    use AuthenticatesUsers;

    protected $redirectTo = '/admin/dashboard';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        // return User::all();//select * from users

        return view('admin.auth.login');
    }

    public function userLogin(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        $remember = $request->has('remember'); // Check if "Remember Me" checkbox is checked
        //    return  $request->all();
        if (Auth::guard('web')->attempt($credentials, $remember)) {
           $user = $request->user();
            if ($user->is_admin) {
             return     redirect()->route('admin.home');
            } else {
                Auth::guard('web')->logout();
                return redirect()->back()->withErrors(['email' => 'Invalid credentials']);
            }
        } else {
            return redirect()->back()->withErrors(['email' => 'Invalid credentials']);
        }
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();
        $request->session()->invalidate();
        return redirect('/admin/login');
    }

    protected function guard()
    {
        return Auth::guard('web');
    }

    protected function username()
    {
        return 'email';
    }
}
