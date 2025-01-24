<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LogoutController extends Controller
{
    public function logout(Request $request)
    {
        try {
            if ($request->user()) {
                $request->user()->currentAccessToken()->delete();
            }

            return response()->json([
                'message' => 'Çıkış yapıldı'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Çıkış yapılırken bir hata oluştu'
            ], 500);
        }
    }
}
