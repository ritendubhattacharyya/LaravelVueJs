@extends('layouts.app')

@section('content')
{{--    {{ $product->qty }}--}}
    @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
            <strong class="font-bold">{{ session('error') }}</strong>
        </div>
    @endif
    <div class="container mx-auto pt-8">
        <div class="flex items-center">
            <div class="flex-1 p-8" style="">
                <img class="w-full" src="{{ $product->getAvatarPath() }}" alt="product">
                <div class="flex my-4">
                    @if($product->qty === 0)
                        <button class="border border-red-500 bg-transparent text-red-700 font-bold py-2 px-4 rounded opacity-50 cursor-not-allowed flex-1 h-16">
                            Out Of Stock
                        </button>
                    @else
                        <form action="/cart/{{ $product->id }}" method="GET" class="flex-1">
                            <button
                                type="submit"
                                class="bg-red-500 h-16 hover:bg-red-700 text-white font-bold py-2 px-4 rounded"
                                style="width: 98%">
                                Buy Now
                            </button>
                        </form>
                        <form action="/product/{{ $product->id }}/cart" method="GET" class="flex-1 text-right">
                            <button
                                type="submit"
                                class="bg-yellow-500 h-16 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded"
                                style="width: 98%">
                                Add to Cart
                            </button>
                        </form>
                    @endif
                </div>
            </div>
            <div class="flex-1 p-8">
                <h1 class="text-4xl font-bold text">{{ $product->details->filter(function($detail){return $detail->attribute_name === 'name';})->first()->attribute_value}}</h1>
                <p class="text-sm text-blue-600 mb-6">
                    By {{ $product->details->filter(function($detail){return $detail->attribute_name === 'brand';})->first()->attribute_value}}
                </p>
                <p class="text-sm text-gray-500" style="text-decoration: line-through;">&#8377 {{ $product->price }}</p>
                <p class="text-4xl font-bold text">&#8377 {{ $product->offer }}</p>
                <p class="text-sm text-green-500 mb-5">Best Price</p>
                <p class="font-bold text-gray-500">Offers</p>
                <ul class="list-disc px-4">
                    <li>Lorem ipsum dolor sit amet, consectetur adipisicing elit. A amet dolor et modi mollitia nemo quidem
                        quo rem sit ullam!
                    </li>
                    <li>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ea, eveniet, impedit. Ea, neque, nobis.
                    </li>
                    <li>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores blanditiis dolorem, et iste
                        necessitatibus
                    </li>
                    <li>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Facere, minus?</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="container mx-auto py-8">
        <div>
            <h1 class="text-4xl font-bold text">Product Details</h1>
            <p>{{ $product->description }}</p>
        </div>
        <div class="mt-6">
            <h1 class="text-4xl font-bold text">Specifications</h1>
            @foreach($product->details as $detail)
                <p>{{ $detail->attribute_name }}: {{ $detail->attribute_value }}</p>
            @endforeach
        </div>

        @if(sizeOf($variants) > 0)
            @forelse($variants as $variant)
                @if($product->details->pluck('attribute_name')->contains($variant))
                    <h1 class="text-xl text-bold">{{ $variant }}</h1>
                    <div class="flex">
                        @forelse($similarProducts as $product)
                            <a href="/product/{{ $product->id }}" class="button bg-transparent border border-blue-400 hover:bg-blue-400 hover:text-white rounded-md py-3 px-6 mr-3">
                                {{  $product->details->pluck('attribute_value', 'attribute_name')[$variant] }}
                            </a>
                        @empty
                            <p></p>
                        @endforelse
                    </div>
                @endif
            @empty
                <p></p>
            @endforelse
        @endif


        <div class="my-16">
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
    </div>
@endsection
