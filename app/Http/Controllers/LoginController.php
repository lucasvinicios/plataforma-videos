<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function auth(Request $request)
    {
        $credentials = ['email' => $request->header('email'), 'password' => $request->header('password')];

        if(Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('JWT');
            return response()->json($token->plainTextToken, 200);
        }

        return response()->json('Usuário ou senha inválidos', 401);
    }
}
