<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    public function forgotPassword(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        if ($status === Password::RESET_LINK_SENT) {
            return response()->json([
                'message' => 'Şifre sıfırlama bağlantısı e-posta adresinize gönderildi.'
            ], 200);
        }

        return response()->json([
            'message' => 'Şifre sıfırlama bağlantısı gönderilemedi.'
        ], 400);
    }
}
