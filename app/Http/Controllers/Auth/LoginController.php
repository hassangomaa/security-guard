<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/URL-option';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        return view('login');
    }

    protected function validateLogin(Request $request)
    {
        $request->validate([
            $this->username() => 'required|string',
            'password' => 'required|string',
        ]);
    }

    protected function attemptLogin(Request $request)
    {
        return $this->guard()->attempt(
            $this->credentials($request),
            $request->filled('remember')
        );
    }

    public function username()
    {
        return 'email'; // Change this if you're using a different field for login (e.g., 'username')
    }




    public function login(Request $request)
    {

        $this->validateLogin($request);

        if ($this->attemptLogin($request)) {
            // You can customize the action after successful login here
            return $this->sendLoginResponse($request);
        }

        return $this->sendFailedLoginResponse($request);
    }

    //logout
    public function logout(Request $request)
    {
        //        return $request ;
        Auth::logout();
        return redirect('/'); // You can specify the logout redirect path
    }
}
