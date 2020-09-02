<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App;

class ProductController extends Controller
{
    public function index() {
        $products = App\Product::latest()->get();
        $categories = App\Category::all();
        return view('product', [
            'products' => $products,
            'categories' => $categories
        ]);
    }

    public function search() {
        request()->validate(['product' => 'required']);
        $categories = App\Category::all();
        $products = App\Product::where('sku', 'LIKE', '%'.request('product').'%')
            ->latest()
            ->get();
        return view('product', [
            'products' => $products,
            'categories' => $categories
        ]);
    }

    public function sort($category_id) {
        $products = App\Category::find($category_id)->products;
        $categories = App\Category::all();
        return view('product', [
            'products' => $products,
            'categories' => $categories
        ]);
    }

    public function show($id) {
        $product = App\Product::find($id);
        $latest_product = App\Product::latest()->take(5)->get();
        $offer_product = App\Product::get()->filter(function($item){return $item->offer !== null;})->take(5);
        $variants = (($product->variants) != NULL) ? explode('-', $product->variants): [];
//        if(sizeOf($variants)>0) {
//            return 'not empty';
//        } else {
//            return 'yes empty';
//        }

        $similarProducts = App\Product::where('name', $product->name)->get();

        return view('show-product', [
            'product' => $product,
            'latest_product' => $latest_product,
            'offer_product' => $offer_product,
            'variants' => $variants,
            'similarProducts' => $similarProducts
        ]);
    }
}
