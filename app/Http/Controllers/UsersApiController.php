<?php

namespace App\Http\Controllers;

use App\Mail\PasswordResetEmail;
use App\Notifications\PasswordResetNotification;
use App\Role;
use App\Utility;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Validator;
use Illuminate\Foundation\Auth\VerifiesEmails;


class UsersApiController extends Controller
{
    use VerifiesEmails;
    public $successStatus = 200;
    public $customId;
    public $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';


    public function login()
    {
        if (Auth::attempt(['email' => request('email'), 'password' => request('password')])) {
            $user = Auth::user();
            if ($user->email_verified_at !== NULL) {
                $success['message'] = "Login success";
                $success['data'] = $user;
//                $success['token'] = $user->createToken('nfce_client')->accessToken;
                $success['token'] = $user->createToken('MyApp')->accessToken;
                return response()->json($success, $this->successStatus);
            } else {
                return response()->json(['error' => 'Please Verify Email'], 401);
            }
        } else {
            return response()->json([
                'message' => "Login Failure",
                'error' => 'Invalid Credentials'], 401);
        }
    }

    public function uniqueEmail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:users'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Invalid email',
                'error' => $validator->errors()->all()], 401);
        }
        return response()->json([
            'message' => 'Valid email',
        ]);
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'date_of_birth' => 'required',
            'national_id' => 'required',
            'email' => 'required | email|unique:users',
            'password' => 'required',
            'c_password' => 'required | same:password',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Registration fail',
                'error' => $validator->errors()->all()], 401);
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        do {
            $this->customId = rand(000000, 999999);
        } while (User::where('custom_id', $this->customId)->exists());
        $input['custom_id'] = $this->customId;

        $user = User::create([
            'title' => $input['title'],
            'first_name' => $input['first_name'],
            'last_name' => $input['last_name'],
            'national_id' => $input['national_id'],
            'phone' => $input['phone'],
            'date_of_birth' => $input['date_of_birth'],
            'email' => $input['email'],
            'password' => $input['password'],
            'custom_id' => $input['custom_id'],
        ]);

        if (array_key_exists('role', $request->all())) {
            switch ($request['role']) {
                case 1:
                    $user->roles()->attach(Role::where('title', 'Admin')->first());
                    break;
                case 2:
                    $user->roles()->attach(Role::where('title', 'Seller')->first());
                    break;
                default:
                    $user->roles()->attach(Role::where('title', 'User')->first());
                    break;
            }
        } else {
            $user->roles()->attach(Role::where('title', 'User')->first());
        }
        $user->sendApiEmailVerificationNotification();
        $success['message'] = 'Please confirm yourself by clicking on verify user button sent to you on your email';
        return response()->json($success, $this->successStatus);
    }

    public function details()
    {
        $user = Auth::user();
        return response()->json(['message' => 'User fetch success',
            'data' => $user], $this->successStatus);

    }

    public function resetPassword(Request $request)
    {
        $user = User::where('email', $request['email'])->first();
        if (!$user) {
            return response()->json([
                'message' => 'Password reset failure',
                'error' => 'No user found'
            ]);
        }
        $newPassword = $this->generate_string($this->permitted_chars, 20);
        $user->password = bcrypt($newPassword);
        try {
            $user->save();
            $user->notify(new PasswordResetNotification($newPassword));
            return response()->json([
                'message' => 'Password reset success. Please check your email',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Password reset failure',
                'error' => $e->getMessage()
            ]);
        }
    }

    public function updatePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'old_password' => 'required',
            'new_password' => 'required',
            'c_new_password' => 'required | same:new_password',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Registration fail',
                'error' => $validator->errors()->first()], 401);
        }

        $oldPassword = $request['old_password'];
        $newPassword = $request['new_password'];

        $user = Auth::user();
        if (Hash::check($oldPassword, $user->password)) {
            $user->password = bcrypt($newPassword);
            $user->save();
            return response()->json([
                'message' => 'Password reset success',
            ]);
        } else {
            return response()->json([
                'message' => 'Password reset failure',
                'error' => 'Password don\'t match',
            ]);
        }
    }


    function generate_string($input, $strength = 16)
    {
        $input_length = strlen($input);
        $random_string = '';
        for ($i = 0; $i < $strength; $i++) {
            $random_character = $input[mt_rand(0, $input_length - 1)];
            $random_string .= $random_character;
        }
        return $random_string;
    }

    function utility()
    {
        return response()->json([
            'message' => 'success',
            'data' => Utility::take(1)->get()
        ], 200);
    }


    public function setImage(Request $request)
    {
//        return response()->json([
//            'data' => 'we are here'
//        ]);
        //        $validation = $request->validate([
        //            'photo' => 'required | file | image | mimes:jpeg,png,gif,webp | max2048'
        //        ]);
//        $user = Auth::user();
//        dd($user);
        $file = $request->file('photo');
//        $file = $validation['photo'];
        $filename = 'profile - photo - ' . time() . ' . ' . $file->getClientOriginalExtension();
        $path = $file->storeAs(' /public/images', $filename);
        dd($path);
//        $user->image = $path;
//        $user->save();

    }

}
