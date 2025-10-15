<?php

namespace SantuAgile\PassportInstaller\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        $tokenResult = $user->createToken('API Token');

        return response()->json([
            'user' => $user,
            'token' => $tokenResult->plainTextToken ?? $tokenResult->accessToken, // string token
        ], 201);
        // $token = $user->createToken('API Token')->accessToken;

        // return response()->json(['user' => $user, 'token' => $token], 201);
    }

    public function login(Request $request)
    {
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        $user = Auth::user();
        $tokenResult = $user->createToken('API Token');

        return response()->json([
            'user' => $user,
            'token' => $tokenResult->plainTextToken ?? $tokenResult->accessToken, // string token
        ]);
        // $token = $user->createToken('API Token')->accessToken;

        // return response()->json(['user' => $user, 'token' => $token]);
    }

    public function user(Request $request)
    {
        return response()->json($request->user());
    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json(['message' => 'Logged out successfully']);
    }
}
