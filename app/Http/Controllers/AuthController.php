<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request) {

        $user = null;

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
        } else {
            return response()->json(['message' => 'invalid credentials'], 401);
        }

        $user['api_token'] = $user->createToken('master')->accessToken;

        return response()->json($user);
    }

    public function register(Request $request) {

        $user = new User();

        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->middle_name = $request->middle_name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role = 'admin';

        $user->save();

        $user['api_token'] = $user->createToken('master')->accessToken;

        return response()->json($user);
    }
}
