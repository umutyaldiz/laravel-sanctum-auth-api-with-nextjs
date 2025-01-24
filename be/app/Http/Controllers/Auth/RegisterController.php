<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // E-posta doğrulama kullanılıyorsa event tetiklenebilir
        event(new Registered($user));

        // Token oluşturma (Sanctum)
        $token = $user->createToken('api_token')->plainTextToken;
        
        return response()->json([
            'message' => 'Kayıt işlemi başarılı',
            'user'    => $user,
            'token'   => $token,
        ], 200);
    }
}
