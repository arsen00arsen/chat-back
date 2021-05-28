<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ForgotRequest;
use App\Http\Requests\ResetRequest;
use App\Mail\ForgotMail;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ForgotController extends Controller
{
    public function forgot(ForgotRequest $request)
    {
        $email = $request->email;

        if (!User::where('email',$email)->first()){
            return response()->json([
                'message' => "User doesn't exists."
            ],404);
        }

        $token = Str::random(10);

        try {
            DB::table('password_resets')->insert([
                'email' => $email,
                'token' => $token
            ]);

            $details = [
                'token' => $token,
                'from' =>'example@domain.com',
                'subject' => 'Reset your password'
            ];

            Mail::to($email)->send(new ForgotMail($details));

            return response()->json([
                'message' => "Check your email."
            ]);
        }catch (\Exception $exception){
            return response()->json([
                'message' => $exception->getMessage()
            ],404);
        }
    }

    public function reset(ResetRequest $request)
    {
        $token = $request->token;

        if (!$passwordReset = DB::table('password_resets')->where('token',$token)->first()){
            return response()->json([
                'message' => "Invalid token."
            ],400);
        }

        if (!$user = User::where('email',$passwordReset->email)->first()){
            return response()->json([
                'message' => "User doesn't exist."
            ],400);
        }

        $user->password = Hash::make($request->password);
        $user->save();
        return response()->json([
            'message' => "Success."
        ],400);
    }
}
