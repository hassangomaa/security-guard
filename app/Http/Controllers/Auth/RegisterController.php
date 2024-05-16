<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request; // Import the Request class


class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showRegistrationForm()
    {
        return view('signup');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['nullable', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8' ],
        ]);
    }

    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'phone' => $data['phone'] ?? null,
            'email_verified_at' => now(),
        ]);
    }


    public function register(Request $request)
    {
        // return $request->all();
        // Validate the request data
        $validator = $this->validator($request->all());
        if ($validator->fails()) {
            // Return JSON response with validation errors
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = $this->create($request->all());

        $this->guard()->login($user);

        // You can customize the action after successful registration here
        return redirect($this->redirectPath());
    }
}
