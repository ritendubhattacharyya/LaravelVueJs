<?php

namespace App\Http\Controllers\authapi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MeController extends Controller
{
    public function __construct() {
        $this->middleware(['auth:api']);
    }

    public function me() {
        // return response()->json('working');
        // $user = auth()->user();
        // $user->permissions = [
        //     'ShowBlog' => true,
        //     'About' => false
        // ];
        return response()->json(auth()->user());
    }
}
