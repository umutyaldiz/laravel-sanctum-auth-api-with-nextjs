<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\Request;

class VerifyEmailController extends Controller
{
    public function verify(Request $request)
    {
        // $request->route('id') => Kullanıcı ID'si
        // $request->route('hash') => Hash verisi

        if ($request->user()->hasVerifiedEmail()) {
            return response()->json(['message' => 'E-posta zaten doğrulanmış.'], 200);
        }

        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
        }

        return response()->json(['message' => 'E-posta doğrulandı.'], 200);
    }

    public function resendVerificationEmail(Request $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return response()->json(['message' => 'E-posta zaten doğrulanmış.'], 200);
        }

        $request->user()->sendEmailVerificationNotification();

        return response()->json(['message' => 'Doğrulama e-postası yeniden gönderildi.'], 200);
    }
}
