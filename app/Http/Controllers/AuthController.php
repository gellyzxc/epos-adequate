<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\VerificationToken;
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

        if (in_array($request->role, ['system_admin', 'local_admin'])) {
            return response()->json(['message' => 'Регистрация доступна только для пользователей с типами: ["teacher", "pupil", "parent"]']);
        }

        $user = new User();

        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->middle_name = $request->middle_name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role = $request->role;

        $user->save();

        $result = [];

        if ($request->role == 'teacher') {
            $notification = VerificationToken::create([
                'user' => $user->id,
                'token' => strtoupper(\Str::random(2)).str(mt_rand(10000000, 99999998)),
                'type' => 'teacher_school_add',
                'class' => null,
            ]);
            $result['teacher'] = $notification->token;
        }

        $user['api_token'] = $user->createToken('master')->accessToken;

        $result['user'] = $user;

        return response()->json($result);
    }
}
