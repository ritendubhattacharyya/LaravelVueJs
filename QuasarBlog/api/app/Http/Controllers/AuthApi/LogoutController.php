<?php

namespace App\Http\Controllers\authapi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LogoutController extends Controller
{
    public function __construct() {

        $this->middleware('auth:api', ['except' => ['login']]);
    }

    public function logout() {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }
}
