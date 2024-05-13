<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\YourModelResource;
use Illuminate\Support\Facades\Validator;
use App\Models\UserStatus;

// This PHP class defines controller methods for user authentication, including user registration and login, with validation and response handling in a Laravel application.

class AuthController extends Controller
{


    public function updateUser(Request $request){
        $data = $request->all();
        $validator = validator::make($data, [
            'pin' => ['required', 'digits:4', 'confirmed'],
            'cnic' => ['required', 'string', 'max:14', 'min:14', 'unique:users'],
            'full_name' => ['required', 'string', 'max:255'],
            'date_of_birth' => ['required', 'date', 'before_or_equal:' . now()->subYears(18)->format('Y-m-d')],
            'address' => ['required', 'string'],
        ]);
        if ($validator->fails()) {
            $resource = YourModelResource::makeWithCodeAndData('Validation Error', 422, $validator->errors());
            return $resource->response();
        } else {
            $user=Auth::user();
            $user->update($data);
            $resource = YourModelResource::makeWithCodeAndData('User Updated', 200, $user);
            return $resource->response();
        }
    }
    public function load(){
        $user = Auth::user();
        $resource = YourModelResource::makeWithCodeAndData('User Fetched', 200, $user);
        return $resource->response();
    }
    public function store(Request $request)
    {
        $data = $request->all();
        $validator = validator::make($data, [
            'pin' => ['required', 'digits:4', 'confirmed'],
            'cnic' => ['required', 'string', 'max:14', 'min:14', 'unique:users'],
            'full_name' => ['required', 'string', 'max:255'],
            'date_of_birth' => ['required', 'date', 'before_or_equal:' . now()->subYears(18)->format('Y-m-d')],
            'address' => ['required', 'string'],
        ]);
        if ($validator->fails()) {
            $resource = YourModelResource::makeWithCodeAndData('Validation Error', 422, $validator->errors());
            return $resource->response();
        } else {
            $user = User::create([
                'pin' => Hash::make($data['pin']),
                'cnic' => $data['cnic'],
                'full_name' => $data['full_name'],
                'date_of_birth' => $data['date_of_birth'],
                'address' => $data['address'],
            ]);
            UserStatus::create([
                'user_id'=>$user->id,
            ]);
            $resource = YourModelResource::makeWithCodeAndData('Success', 200, $user);
            return $resource->response();
        }
    }

    public function login(Request $request)
    {
        $data = $request->all();
        $validator = validator::make($data, [
            'pin' => ['required', 'digits:4'],
            'cnic' => ['required', 'string', 'max:14', 'min:14', 'exists:users,cnic']
        ]);
        if ($validator->fails()) {
            $resource = YourModelResource::makeWithCodeAndData('Validation Error', 422, $validator->errors());
            return $resource->response();
        } else {
            $user = User::where('cnic', $data['cnic'])->first();

            if ($user && Hash::check($data['pin'], $user->pin)) {
                $token = $user->createToken('authToken')->plainTextToken;
                Auth::login($user);
                $resource = YourModelResource::makeWithCodeAndData('Logged in Successfully', 200, ['token' => $token, 'user' => $user]);
                return $resource->response();
            } else {
                $resource = YourModelResource::makeWithCodeAndData('Invalid Credentials', 401, null);
                return $resource->response();
            }
        }
    }
}
