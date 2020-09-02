<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $latest_product = App\Product::latest()->take(5)->get();
        $offer_product = App\Product::get()->filter(function($item){return $item->offer !== null;})->take(5);
        return view('welcome', [
            'latest_product' => $latest_product,
            'offer_product' => $offer_product
        ]);
    }
}
