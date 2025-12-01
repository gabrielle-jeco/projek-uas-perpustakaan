<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    //
    public function register(Request $request){
        $validate = Validator::make($request->all(), [
            'username' => 'required',
            'email' => 'required',
            'password' => 'required'
        ]);

        if($validate->fails()){
            return APIUtil::sendError('Register failed!', $validate->errors());
        }

        $newUser = User::where('email', $request->email)->first();
        if($newUser){
            return APIUtil::sendError('Register failed!', 'Email already exist');
        }
        $newUser = User::create([
            'name'=>$request->username,
            'email'=>$request->email,
            'password'=>bcrypt($request->password)
        ]);
        $token = $newUser->createToken('auth_token')->plainTextToken;
        return APIUtil::sendResponse($token, 'Registered successfully');
    }

    public function login(Request $request){
        $validate = Validator::make($request->all(), [
            'email'=>'required',
            'password'=>'required'
        ]);

        if($validate->fails()){
            return APIUtil::sendError('Login failed!', $validate->errors());
        }

        if(!User::where('email', $request->email)->exists()){
            return APIUtil::sendError('Login failed!', 'Not registered');
        }

        if(Auth::attempt(['email'=>$request->email, 'password'=>$request->password])){
            $user = Auth::user();
            $token = $user->createToken('auth_token')->plainTextToken;
            return APIUtil::sendResponse($token, 'Login successful');
        }
        return APIUtil::sendError('Login failed!', 'Incorrect email/password');
    }

    public function logout(){
        $user = Auth::user();
        if($user){
            $user->currentAccessToken()->delete();
            return APIUtil::sendResponse('Logout successful', 'null');
        }
        return APIUtil::sendError('Logout failed', 'Not logged in');
    }
}
