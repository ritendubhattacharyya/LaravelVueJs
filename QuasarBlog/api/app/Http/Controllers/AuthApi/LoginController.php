<?php

namespace App\Http\Controllers\authapi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login() {
        // sleep(5);
        $credentials = request(['email', 'password']);
        // return response()->json($credentials);

        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return response()->json($token);
    }
}
