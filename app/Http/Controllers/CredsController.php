<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Response;
use Illuminate\Support\Facades\Auth;

class CredsController extends Controller
{
    // Login api
    public function login()
    {
        if (Auth::attempt(['email' => request('email'), 'password' => request('password')])) {
            $user = Auth::user();
            $success['token'] =  $user->createToken('MyApp')-> accessToken;
            return response()->json(['status_code' => '200', 'message' => 'Success, You are now logged in.', 'token' => $success['token']], 200);
        } else {
            return response()->json(['error'=>'Unauthorised'], 401);
        }
    }

    // Registration api
    public function register(Request $request)
    {
        $new_user = $request->all();
        $new_user['password'] = bcrypt($new_user['password']);
        $user = User::create($new_user);
        $success['token'] =  $user->createToken('MyApp')-> accessToken;
        $success['name'] =  $user->name;
        return response()->json(['status_code' => '200', 'success'=> $success], 200);
    }
}
