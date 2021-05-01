<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request) {
        
        // return $request;
        $login_data = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        
        if (!auth()->attempt($login_data)) {
            return response(['message' => 'Invalid credentials']);
        }

        $accessToken = Auth::user()->createToken('authToken')->accessToken;
        
        return response(['access_token' => $accessToken]);
    }
}
