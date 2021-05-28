<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        try {
            if (Auth::attempt($request->only('email', 'password'))) {
                $user = Auth::user();
                $token = $user->createToken('api-application')->accessToken;

                return response()->json([
                    'message' => 'success',
                    'token' => $token,
                    'user' => $user
                ], 200);
            }
        }catch (\Exception $exception){
            return response()->json([
                'message' => $exception->getMessage()
            ],400);
        }

        return response()->json(['error' => "Unauthorized access."], 203);
    }
}
