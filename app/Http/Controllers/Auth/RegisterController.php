<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'confirm_password' => 'required|same:password',
        ]);

        if ($validation->fails()) {
            return response()->json($validation->errors(), 202);
        }

        $data = $request->all();
        $data['password'] = Hash::make($request->password);

        $user = User::create($data);

        $res = [];
        $res['token'] = $user->createToken('api-application')->accessToken;
        $res['name'] = $user->name;

        return response()->json($res, 200);
    }
}
