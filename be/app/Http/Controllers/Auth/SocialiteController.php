<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;

class SocialiteController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->stateless()->redirect();
    }

    public function handleGoogleCallback()
    {
        // Google'dan gelen user bilgisi
        $googleUser = Socialite::driver('google')->stateless()->user();

        // Kullanıcı veritabanında var mı kontrol et
        $user = User::where('email', $googleUser->getEmail())->first();

        if (!$user) {
            // Kayıt yoksa yeni kullanıcı oluştur
            $user = User::create([
                'name'      => $googleUser->getName(),
                'email'     => $googleUser->getEmail(),
                'google_id' => $googleUser->getId(),
                'avatar'    => $googleUser->getAvatar(),
                'password'  => bcrypt(Str::random(16)), // Rastgele bir şifre
            ]);
        }

        // Kullanıcı giriş yapsın
        Auth::login($user);

        // Sanctum token oluştur
        $token = $user->createToken('api_token')->plainTextToken;

        // Eğer front-end’e yönlendirecekseniz, redirect ile token’ı bir parametreyle gönderebilirsiniz.
        // Ancak API cevabı olarak JSON dönmek isterseniz:
        return response()->json([
            'message' => 'Google ile giriş başarılı',
            'user'    => $user,
            'token'   => $token,
        ], 200);
    }
}
