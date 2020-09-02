<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App;

class ExploreController extends Controller
{
    public function index() {
        $users = App\User::latest()->get()->filter(function($user) { return $user->id !== auth()->user()->id;});
        return view('explore', compact('users'));
    }
}
