<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $fields = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|confirmed',
        ]);

        $user = User::create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'password' => bcrypt($fields['password']),
        ]);
        // create token
        $token = $user->createToken('myAppToken')->plainTextToken;
        return response()->json([
            'status' => true,
            'data' => $user,
            'token' => $token,
        ], 201);
    }

    public function login(Request $request)
    {
        $fields = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // check email

        $user = User::where('email', $fields['email'])->first();


        // check password

        if (!$user || !Hash::check($fields['password'], $user->password)) {
            return response()->json([
                'status' => false,
                'data' => 'User not found',
            ]);
        } else {
            $token = $user->createToken('myAppToken')->plainTextToken;
            return response()->json([
                'status' => true,
                'token'=>$token,
                'data' => $user,
            ]);
        }
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();
        return response()->json([
            'status' => true,
            'data' => 'logout success',
        ], 200);
    }
}
