<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;

class CartController extends Controller
{
    public function show($id) {
        $product = App\Product::find($id);
        if($product->qty === 0) {
            return back()->with('error', 'currently out of stock');
        } else {
            $cart = new App\Cart;
            $cart->product_id = $id;
            $cart->user_id = auth()->user()->id;
            if($existing_cart = App\Cart::where('user_id', auth()->user()->id)->where('product_id', $id)->first()) {
                if($existing_cart->qty >= $product->qty) {
                    return back()->with('error', 'currently out of stock');
                } else if($existing_cart->qty < $product->qty) {
                    $existing_cart->qty = $existing_cart->qty + 1;
                    $existing_cart->update();
                }
            } else {
                $cart->qty = 1;
                $cart->save();
            }
        }

        return redirect('/cart');
    }

    public function store($id) {
        $product = App\Product::find($id);
        if($product->qty === 0) {
            return back()->with('error', 'currently out of stock');
        } else {
            $cart = new App\Cart;
            $cart->product_id = $id;
            $cart->user_id = auth()->user()->id;
            if($existing_cart = App\Cart::where('user_id', auth()->user()->id)->where('product_id', $id)->first()) {
                if($existing_cart->qty >= $product->qty) {
                    return back()->with('error', 'currently out of stock');
                } else if($existing_cart->qty < $product->qty) {
                    $existing_cart->qty = $existing_cart->qty + 1;
                    $existing_cart->update();
                }
            } else {
                $cart->qty = 1;
                $cart->save();
            }
        }

        return back();
    }

    public function index() {
        $products = App\Product::withCartQty()->where('user_id', auth()->user()->id)->get();

        $latest_product = App\Product::latest()->take(5)->get();
        $offer_product = App\Product::get()->filter(function($item){return $item->offer !== null;})->take(5);

        $price = $products->map(function($item){return ($item->offer)?$item->offer:$item->mrp;});
        $qty = $products->pluck('cartQty');
        $sum = $this->calcTotal($price,$qty);

        return view('cart', [
            'products' => $products,
            'sum' => $sum,
            'latest_product' => $latest_product,
            'offer_product' => $offer_product
        ]);
    }

    public function calcTotal($price, $qty) {
        $sum = 0;
        for($i=0; $i<sizeOf($price); $i++) {
            $sum = $sum + ($price[$i] * $qty[$i]);
        }

        return $sum;
    }

    public function destroy($id) {
        $cart = App\Cart::find($id);
        $cart->delete();
        return redirect('cart');
    }

    public function increment($id) {
        $cart = App\Cart::find($id);
        $cartQty = $cart->qty;
        $productId = $cart->product_id;
        $product = App\Product::find($productId);
        if($product->qty <= $cartQty) {
            return back()->with('cart_error', 'not enough product');
        } else {
            $cartQty = $cartQty + 1;
            $cart->qty = $cartQty;
            $cart->update();
            return back();
        }
    }

    public function decrement($id) {
        $cart = App\Cart::find($id);
        $cartQty = $cart->qty;
        $productId = $cart->product_id;
        $product = App\Product::find($productId);
        if($cartQty <= 1) {
            return back()->with('cart_error', 'Sorry!! something went wrong');
        } else {
            $cartQty = $cartQty - 1;
            $cart->qty = $cartQty;
            $cart->update();
            return back();
        }
    }
}
