<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string',
        ]);

        

        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'message' => 'Geçersiz kimlik bilgileri'
            ], 401);
        }

        $user = Auth::user();
        $token = $user->createToken(
            'token',
            expiresAt: now()->addMinutes(10)
        )->plainTextToken;

        return response()->json([
            'message' => 'Giriş başarılı',
            'user'    => $user,
            'token'   => $token,
        ], 200);
    }
}
