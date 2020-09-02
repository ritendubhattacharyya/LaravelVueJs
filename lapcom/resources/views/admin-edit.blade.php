@extends('layouts.admin')

@section('content')
    <div class="p-5">
        <h1 class="font-bold text-2xl">Edit product</h1>

        <form action="/admin/edit/next/{{ $product->id }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group py-5">
                <label
                    class="col-form-label"
                    for="name">sku</label>
                <input
                    type="text"
                    name="sku"
                    id="name"
                    value="{{ $product->sku }}"
                    class="input-group border border-gray-600 p-3 w-full mt-3 h-12">

                @error('sku')
                <p class="text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group py-5">
                <label
                    class="col-form-label"
                    for="price">price</label>
                <input
                    type="text"
                    name="price"
                    id="price"
                    value="{{ $product->price }}"
                    class="input-group border border-gray-600 p-3 w-full mt-3 h-12">

                @error('price')
                <p class="text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group py-5">
                <label
                    class="col-form-label"
                    for="offer">offer</label>
                <input
                    type="text"
                    name="offer"
                    id="offer"
                    value="{{ $product->offer }}"
                    class="input-group border border-gray-600 p-3 w-full mt-3 h-12">

                @error('offer')
                <p class="text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group py-5">
                <label
                    class="col-form-label"
                    for="description">description</label>
                <input
                    type="text"
                    name="description"
                    id="description"
                    value="{{ $product->description }}"
                    class="input-group border border-gray-600 p-3 w-full mt-3 h-12">

                @error('description')
                <p class="text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group py-5">
                <label
                    class="col-form-label"
                    for="qty">Quantity</label>
                <input
                    type="text"
                    name="qty"
                    id="qty"
                    value="{{ $product->qty }}"
                    class="input-group border border-gray-600 p-3 w-full mt-3 h-12">

                @error('qty')
                <p class="text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

{{--            <div class="form-group py-5">--}}
{{--                <label--}}
{{--                    class="col-form-label"--}}
{{--                    for="category">Category</label>--}}
{{--                <select name="category_id" id="category">--}}
{{--                    @foreach(App\Category::all() as $category)--}}
{{--                        <option value="{{ $category->id }}">{{ $category->name }}</option>--}}
{{--                    @endforeach--}}
{{--                </select>--}}
{{--            </div>--}}
            <label
                class="col-form-label"
                for="avatar">Avatar</label>
            <div class="form-group py-4">
                <input
                    type="file"
                    name="avatar"
                    id="avatar"
                    class="input-group border border-gray-300 mt-3 h-12"
                    style="opacity: 1">
            </div>

            <div class="form-group py-5">
                <button type="submit" class="btn btn-block bg-blue-400 hover:bg-blue-300 rounded-lg text-white px-8 py-2">Next</button>
            </div>

        </form>
    </div>
@endsection
