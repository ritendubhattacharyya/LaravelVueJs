@extends('layouts.admin')

@section('content')
    <div class="p-5">
        <h1 class="font-bold text-2xl">Create new</h1>

        <form action="/admin/next" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group py-5">
                <label
                    class="col-form-label"
                    for="name">sku</label>
                <input
                type="text"
                name="sku"
                id="name"
                value="{{ old('sku') }}"
                class="input-group border border-gray-600 p-3 w-full mt-3 h-12">

                @error('sku')
                    <p class="text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group py-5">
                <label
                    class="col-form-label"
                    for="name">Name</label>
                <input
                    type="text"
                    name="name"
                    id="name"
                    value="{{ old('name') }}"
                    class="input-group border border-gray-600 p-3 w-full mt-3 h-12">

                @error('name')
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
                    value="{{ old('price') }}"
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
                    value="{{ old('offer') }}"
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
                    value="{{ old('description') }}"
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
                    value="{{ old('qty') }}"
                    class="input-group border border-gray-600 p-3 w-full mt-3 h-12">

                @error('qty')
                <p class="text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group py-5">
                <label
                    class="col-form-label"
                    for="variants">Variants (write the variants with '-')</label>
                <input
                    type="text"
                    name="variants"
                    id="variants"
                    value="{{ old('variants') }}"
                    class="input-group border border-gray-600 p-3 w-full mt-3 h-12">

                @error('variants')
                <p class="text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group py-5">
                <label
                    class="col-form-label"
                    for="category">Category</label>
                <select name="category_id" id="category">
                    <option value="0">select category</option>
                    @foreach(App\Category::all() as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

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

{{--            category --}}
            <table class="table-fixed w-full" id="categoryTable">

            </table>

{{--            !category--}}


            <div class="form-group py-5">
                <button type="submit" class="btn btn-block bg-blue-400 hover:bg-blue-300 rounded-lg text-white px-8 py-2">Save</button>
            </div>

        </form>
    </div>
@endsection

@section('custom-js')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#category').on('change', function() {
                // console.log('working');
                let id = $(this).val();
                let categoryTable = $('#categoryTable');

                categoryTable.empty();

                $.ajax({
                    type: 'GET',
                    url: '/getCategory/' + id,
                    success: function(res) {
                        let category = JSON.parse(res);
                        category.forEach( attribute => {
                            categoryTable.append(`
                                <tr>
                                    <td>
                                        <label class="col-form-label" for="${ attribute.name }">
                                            ${ attribute.name }
                                        </label>
                                    </td>
                                    <td>
                                        <input
                                            type="${ attribute.type }"
                                            required
                                            name="${ attribute.name }"
                                            id="${ attribute.name }"
                                            step ="0.01"
                                            class="input-group border border-gray-600 p-3 w-full mt-3 h-12">
                                    </td>
                                </tr>`);
                        })
                    },
                    error: function(err) {

                    }
                })
            })
        });
    </script>
@endsection
