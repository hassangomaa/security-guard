<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Mail\OTPMail;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Storage;
use Exception; // Import Exception for error handling
use Illuminate\Validation\Rule;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        // Validation
        $validator = Validator::make($request->all(), [

            "name" => "required|string|max:255",
            "email" => "required|string|max:255|unique:users",
            "password" => "required|string|min:6",
            // "user_type" => "required|string|max:255",

        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        try {
            // Start a database transaction
            DB::beginTransaction();
            $token = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);

            $user = User::create([
                "name" => $request->name,
                "email" => $request->email,
                //phone
                "phone" => $request->phone,
                //lang
                "lang" => $request->lang ?? 'en',
                // country code
                "country_code" => $request->country_code ?? '+20',
                "password" => bcrypt($request->password),
                'email_verification_token' => $token,
            ]);
            #return the created user with a token
            //            $token = JWTAuth::fromUser($user);
            //
            //            return response()->json(
            //                [
            //                    'token' => $token,
            //                    'user' => $user,
            //                ]);

            //send email verification
            $this->sendEmail($user->email, $token, $request->name);
            //            auth('web')->login($user);
            //            $token = JWTAuth::fromUser($user);

            // Commit the transaction
            DB::commit();


            //            return $this->respondWithToken($token);
            //check your email to verify your account
            return response()->json([
                'message' => 'check your email to verify your account'
                //                , 'token' => $token
            ], 200);

            //             return response()->json([
            //                 'message' => 'Customer successfully registered',
            //                 'user' => $user
            //             ], 201);


        } catch (\Exception $e) {
            // An error occurred, so rollback the transaction and return an error response
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 500);
        }
        // Create and save user

    }

    public static function sendEmail($email, $token, $userName)
    {

        Mail::to($email)->send(new OTPMail($token, $userName, $email));
    }

    #update user
    public function update(Request $request)
    {
        $id = $request->user()->id;
        // Validation
        $validator = Validator::make($request->all(), [

            "name" => "required|string|max:255",
            #unique email excet the current user
            "email" => "required|string|email|max:255|unique:users,email," . $id,
            "password" => "required|string|min:6",
            //                "user_type" => "required|string|max:255",

        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        // Create and save user
        $user = User::findOrFail($id);
        $user->update([

            "name" => $request->name,
            "email" => $request->email,
            "password" => bcrypt($request->password),
            "user_type" => $request->user_type,
        ]);
        // return the updated user with a token
        $token = JWTAuth::fromUser($user);

        return response()->json(
            [
                'token' => $token,
                'user' => $user,
            ]
        );
    }

    //updateMyProfile

    public function updateMyProfile(Request $request)
    {
        // Validation rules
        $validator = Validator::make($request->all(), [
            "name" => "required|string|max:255",
            "email" => "nullable|string|email|max:255|unique:users,email," . auth()->id(),
            "lang" => "nullable|string|max:255",
            "country_code" => "required|string|max:255",
            "phone" => "required|string|max:255|unique:users,phone," . auth()->id(),
            "password" => "nullable|string|min:6", // Allow nullable password
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        try {
            // Begin a database transaction
            DB::beginTransaction();

            // Retrieve the authenticated user
            $user = Auth::user();

            // Update user's name
            $user->name = $request->name;

            // Update email if provided and not the same as current email
            if ($request->filled('email') && $request->email !== $user->email) {
                $user->email = $request->email;

                // Reset email verification fields
                $user->email_verified_at = null;
                $user->email_verification_token = null;
                $token = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
                $name = $user->name;
                // Send email verification
                // Assuming you have a method sendEmailVerificationEmail to send verification email
                $this->sendEmail($request->email, $token, $name);
                //logout the user
                Auth::logout();
                return
                    response()->json([
                        'message' => 'check your email to verify your account'
                    ]);
            }

            // Update country code if provided
            if ($request->filled('country_code')) {
                $user->country_code = $request->country_code;
            }

            // Update phone if provided
            if ($request->filled('phone')) {
                $user->phone = $request->phone;
            }

            // Update password if provided
            if ($request->filled('password')) {
                $user->password = bcrypt($request->password);
            }

            // Save the updated user
            $user->save();

            // Commit the transaction
            DB::commit();

            return response()->json([
                'message' => 'Profile updated successfully',
                'user' => $user,
            ]);
        } catch (\Exception $e) {
            // Rollback the transaction if an error occurs
            DB::rollback();
            return response()->json([
                'status' => 500,
                'message' => 'Something went wrong.',
                'error' => $e->getMessage(),
            ]);
        }
    }



    public function login(Request $request)
    {
        // Validate the request parameters
        $validator = Validator::make($request->all(), [
            'emailOrPhone' => 'required|string',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Check if the input is in email format
        $isEmail = filter_var($request->input('emailOrPhone'), FILTER_VALIDATE_EMAIL);

        // Determine the field name to search based on the input type
        $fieldName = $isEmail ? 'email' : 'phone';

        // Attempt to authenticate the user based on email or phone number
        if (!Auth::attempt([$fieldName => $request->input('emailOrPhone'), 'password' => $request->input('password')])) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $user = auth()->user();
        if ($user->email_verified_at == null) {
            return response()->json([
                'status' => 'error',
                'message' => 'Account not verified'
            ]);
        }

        // Generate a new JWT token for the user
        // $token = Auth::user()->createToken('API Token')->plainTextToken;
        // $token = JWTAuth::fromUser($user);
        $token = $authToken = $user->createToken('auth-token')->plainTextToken;

        return response()->json([
            'token' => $token,
            'user' => $user
        ]);
    }

    // public function login(Request $request)
    // {
    //     // Validation
    //     $credentials = $request->only('email', 'password');

    //     if (! $token = JWTAuth::attempt($credentials)) {
    //         return response()->json(['error' => 'Invalid credentials'], 401);
    //     }

    //     return response()->json(
    //         [
    //             'token' => $token,
    //             'user' => Auth::user(),
    //         ]);
    // }

    #profile
    public function profile()
    {
        return response()->json(Auth::user());
    }

    public function logout()
    {
        // Get the user's token
        // $token = JWTAuth::getToken();

        // // Set the expiration time of the token to now
        // JWTAuth::setToken($token)->invalidate();

        // Auth::logout();
        auth()->user()->tokens()->delete();

        return response()->json(['message' => 'Logged out successfully']);
    }

    ##public avatar

    public function uploadAvatar(Request $request)
    {
        // Validate the uploaded file
        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust file type and size as needed
        ]);

        // Store the uploaded file to the public directory
        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $avatarName = 'avatar_' . auth()->id() . '.' . $avatar->getClientOriginalExtension();
            $avatar->move(public_path('avatars'), $avatarName);

            // Construct the avatar URL
            $avatarUrl = url('avatars/' . $avatarName);
            // Update the user's avatar field in the database
            auth()->user()->update(['avatar' => $avatarUrl]);



            // Return the user's profile with the avatar URL
            return response()->json([
                'message' => 'Avatar uploaded successfully',
                'avatar' => $avatarName,
                'avatar_url' => $avatarUrl,
                'user' => auth()->user(),
            ]);
        }

        return response()->json(['error' => 'No file uploaded'], 400);
    }

    public function verifyEmail($token, $email)
    {
        try {
            $code =  $token;
            $user = \App\Models\User::where('email', $email)->first();



            //if nor user found with this email
            if (!$user)
                return  response()->json(
                    [
                        'message' => 'Invalid email address. Please try again.',
                    ],
                    422
                );

            ($user->email_verification_token === $code) ?? 0;

            if ($user->email_verification_token === $code) {
                $user->email_verified_at = now();
                //set token null
                $user->email_verification_token = null;
                $user->save();
                // $token = JWTAuth::fromUser($user);
                $token = $authToken = $user->createToken('auth-token')->plainTextToken;
                return  response()->json(
                    [
                        'message' => 'You have successfully verified your email address.',
                        'access_token' => $token,
                        'token_type' => 'bearer',
                        'expires_in' => 'Token will expire in 60 minutes (1 hour)',
                        'user' => new UserResource($user)
                    ],
                    200
                );
            } else
                return response()->json(
                    [
                        'message' => 'Invalid code. Please try again.',
                    ],
                    422
                );
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Email verification failed',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    protected function createNewToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->guard('customer')->factory()->getTTL(), // 1 week in minutes
            'user' =>  new CustomerResource(auth()->guard('customer')->user())
        ]);
    }


    //resetPassword
    public function resetPassword(Request $request)
    {
        $rules = [
            'email' => 'required|email',
            'token' => 'required|string',
            'password' => 'required|string|min:6',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            // Validation failed, return the validation errors
            return response()->json(['errors' => $validator->errors()], 422);
        }

        //        return $request->all();

        try {

            DB::beginTransaction(); // Start a database transaction
            $user = User::where('email', $request->email)
                ->where('email_verification_token', $request->token)
                ->first();

            if (!$user) {
                return response()->json(['error' => 'User not found'], 404);
            }

            //        return $user;
            $user->email_verification_token = null;
            $user->update([
                'password' => bcrypt($request->password),
            ]);

            $user->save();

            //        $token = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
            //        $user->update([
            //            'email_verification_token' => $token,
            ////            'password_reset_token_expires_at' => now()->addMinutes(60),
            //        ]);
            //        $this->sendEmailResetPassword($user->email, $token, $user->name);

            DB::commit(); // Commit the transaction

            return response()->json([
                'status' => 'success',
                'message' => 'Password reset successfully',
                'user' => new UserResource($user),
            ]);
        } catch (Exception $e) {
            // An error occurred, so rollback the transaction and return an error response
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => 'Token will expire in 60 minutes (1 hour)',
            'user' => new UserResource(auth()->user())
        ]);
    }

    public function verifyEmailByGet($token, $email)
    {
        try {
            $code =  $token;
            $user = \App\Models\User::where('email', $email)->first();

            ($user->email_verification_token === $code) ?? 0;


            //if nor user found with this email
            if (!$user)
                response()->json(
                    [
                        'message' => 'Invalid email address. Please try again.',
                    ],
                    422
                );


            if ($user->email_verification_token === $code) {
                $user->email_verified_at = now();
                $user->email_verification_token = null;
                $user->save();
                $token = JWTAuth::fromUser($user);
                return response()->json(
                    [
                        'message' => 'You have successfully verified your email address, please login. ',
                        //                        'access_token' => $token,
                        //                        'token_type' => 'bearer',
                        //                        'expires_in' => 'Token will expire in 60 minutes (1 hour)',
                        //                        'user' => new UserResource($user)
                    ],
                    200
                );
            } else
                return response()->json(
                    [
                        'message' => 'Invalid code. Please try again.',
                    ],
                    422
                );
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Email verification failed',
                'message' => $e->getMessage()
            ], 500);
        }
    }


    //resend-otp
    public function resendOTP($email)
    {
        $email;

        //        $rules = [
        //            'email' => 'required|email',
        //        ] ;
        //        $validator = Validator::make($request->all(), $rules);

        //        if ($validator->fails()) {
        //            // Validation failed, return the validation errors
        //            return response()->json(['errors' => $validator->errors()], 422);
        //        }
        try {

            // Start a database transaction
            DB::beginTransaction();

            // Get the authenticated user
            $user = \App\Models\User::where('email', $email)->first();
            //if nor user found with this email
            if (!$user)
                return     response()->json(
                    [
                        'message' => ' if you have an account, you will receive an email with a code to verify your account',
                    ],
                    422
                );

            $token = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);


            // Update the user's profile with the validated data
            $user->update(['email_verification_token' =>  $token]);
            $authController = new AuthController();
            $name = app()->getLocale() == 'ar' ? $user->name_ar : $user->name_en;
            $authController->sendEmail($user->email, $token, $name);

            // Commit the transaction
            DB::commit();

            // Return a success JSON response
            return response()->json([
                'message' => ' if you have an account, you will receive an email with a code to verify your account',
                //                'email' => $email,
                //                'user' => new UserResource( $user )
            ]);
        } catch (\Exception $e) {
            // An error occurred, so rollback the transaction and return an error response
            DB::rollBack();
            return response()->json([
                'error' => 'OTP code sent failed',
                'message' => $e->getMessage()

            ], 500);
        }
    }
}
