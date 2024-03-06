<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $this->validate($request, [
            'name' => ['required'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'min:6']
        ]);

        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);

        return response()->json([
            'message' => 'User Register Success',
            'user' => $user,
        ], 201);
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => ['required'],
            'password' => ['required'],
        ]);

        $user = User::whereEmail($request['email'])->first();

        if (!$user) {
            return response()->json([
                'message' => 'Email has not been registered'
            ], 404);
        }

        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'message' => 'Invalid Credentials'
            ], 401);
        }

        $user = auth()->user();
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'User Login Success',
            'token' => $token,
            'user' => $user
        ], 200);
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();

        return response()->json([
            'message' => 'User Logout Success'
        ], 200);
    }
}
