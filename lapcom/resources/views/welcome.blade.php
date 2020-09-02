@extends('layouts.app')

@section('content')
    {{--       banner section--}}
    <div class="banner">
        <img
            src="/img/banner.jpg"
            alt="banner"
            style="width: 100%; height: 60vh;">
    </div>
    {{--       !banner section--}}
    {{--       main section--}}
    <div class="container mx-auto h-6 py-16" style="height: fit-content">
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
    </div>
    {{--       !main section--}}
@endsection

