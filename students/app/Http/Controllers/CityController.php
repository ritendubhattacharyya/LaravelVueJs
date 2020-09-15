<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\City;

class CityController extends Controller
{
    public function index() {
        $states = City::all();
        return view('dynamic-dropdown', compact('states'));
    }

    public function show($state) {
        return json_encode(City::where('id', $state)->get());
    }
}
