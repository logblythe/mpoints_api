<?php

namespace App\Http\Controllers;

use App\Role;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Validator;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Auth\Events\Verified;


class UsersApiController extends Controller
{
    use VerifiesEmails;

    public $successStatus = 200;
    public $customId;

    public function login()
    {
        if (Auth::attempt(['email' => request('email'), 'password' => request('password')])) {
            $user = Auth::user();
            if ($user->email_verified_at !== NULL) {
                $success['message'] = "Login successfull";
                $success['data'] = $user;
//                $success['token'] = $user->createToken('nfce_client')->accessToken;
                $success['token'] = $user->createToken('MyApp')->accessToken;
                return response()->json($success, $this->successStatus);
            } else {
                return response()->json(['error' => 'Please Verify Email'], 401);
            }
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }

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
            return response()->json(['error' => $validator->errors()], 401);
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
        return response()->json([$success], $this->successStatus);

    }

    /**
     * details api
     *
     * @return \Illuminate\Http\Response
     */

    public function details()
    {
        $user = Auth::user();
        return response()->json(['success' => $user], $this->successStatus);

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
