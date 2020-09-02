@extends('layouts.app')

@section('content')
    <div class="container mx-auto py-16">
        @if(session('cart_error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 mt-5 rounded relative" role="alert">
                <strong class="font-bold">{{ session('cart_error') }}</strong>
            </div>
        @endif
{{--        cart--}}
        <div class="flex border border-gray-400 p-8">
            <div class="flex-1">
                <h1 class="font-bold text-black text-2xl py-4">Cart</h1>
                <hr class="mb-8 text-black-500">
                @forelse($products as $product)
                    @include('_cart-item')
                @empty
                    <p class="p-8 text-gray-500 text-xl border border-gray-300">Cart is empty!!</p>
                @endforelse
            </div>
            <div class="flex-1 p-8">
                <p class="font-bold text-2xl">Total Price: </p>
                <p class="text-2xl">&#8377 {{ $sum }}</p>
                <form action="/cart" method="POST">
                    @csrf
                    <button type="submit"
                            class="btn btn-block bg-yellow-500 px-16 py-6 text-white font-bold uppercase mt-8">
                        Place Order
                    </button>
                </form>
            </div>
        </div>
{{--        !cart--}}
        <hr class="py-8">
{{--        welcome import--}}
        <div class="mb-16">
            <h1 class="font-bold text-2xl mb-8 font-sans">Latest</h1>
            <div class="flex justify-evenly">
                @foreach($latest_product as $product)
                    @include("_latest-product")
                @endforeach
            </div>
        </div>
        <div class="mb-16">
            <h1 class="font-bold text-2xl mb-8 font-sans">Best Offer</h1>
            <div class="flex justify-evenly">
                @foreach($offer_product as $product)
                    @include("_best-offer-product")
                @endforeach
            </div>
        </div>
        <div class="flex" style="width: 100%; height: 30vh">
            <img src="/img/adone.jpg" alt="Advertisement" style="width: 50%; height: 100%">
            <img src="/img/adtwo.jpg" alt="Advertisement" style="width: 50%; height: 100%">
        </div>
{{--        !welcome import--}}
    </div>
@endsection

