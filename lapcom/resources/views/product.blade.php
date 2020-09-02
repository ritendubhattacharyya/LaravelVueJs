@extends('layouts.app')

@section('content')
    <div class="container py-16 mx-auto">
        <form action="/product" method="POST" class="flex items-center justify-evenly mb-16">
            @csrf
            <input
                class="w-full h-16 px-3 rounded focus:outline-none focus:shadow-outline text-xl px-8 shadow-lg"
                type="text"
                placeholder="Search..."
                name="product">
            <button type="submit" class="ml-6 w-32 bg-transparent h-16 hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded">
                Search
            </button>
        </form>
        @error('product')
            <p class="mb-12 text-sm text-red-500">{{ $message }}</p>
        @enderror
        <div class="flex mr-4 py-6">
            <a href="/product" class="button bg-transparent text-blue-500 mr-3">All</a>
            @foreach($categories as $category)
                <form action="/product/category/{{ $category->id }}" method="get">
                        <button
                            type="submit"
                            class="button bg-transparent text-blue-500 mr-3"
                        >
                            {{ $category->name }}
                        </button>
                </form>
            @endforeach
        </div>
        <div class="grid grid-cols-4 gap-4">
            @foreach($products as $product)
                @include('_item-product')
            @endforeach
        </div>
    </div>
@endsection
