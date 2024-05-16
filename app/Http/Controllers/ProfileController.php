<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    //

    public function showProfile()
    {
        return view('settings');
    }


    //edit-profile
    public function editProfile()
    {
        return view('edit-profile');
    }


    public function updateProfile(Request $request)
    {
        // return $request->all();
        $user = Auth::user();

        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'password' => ['nullable', 'string', 'min:8'],
            'phone' => ['nullable', 'string', 'max:20', 'unique:users,phone,' . $user->id],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user->name = $request->input('name');
        $user->phone = $request->input('phone')?? $user->phone;
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password')) ?? $user->password;
        $user->save();

        return redirect()->route('editProfile')->with('success', 'Profile updated successfully!');
    }
}
