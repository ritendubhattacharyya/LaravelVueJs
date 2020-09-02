@extends('layouts.admin')

@section('content')
    <form action="/admin/add/{{ $product->id }}" method="POST" class="p-5">
        @csrf
        <table class="table-fixed w-full">
            @foreach($category->attributes as $attribute)
                <tr>
                    <td>
                        <label
                            class="col-form-label"
                            for="{{ $attribute->name }}">{{ $attribute->name }}</label>
                    </td>
                    <td>
                        <input
                            type="{{ $attribute->type }}"
                            name="{{ $attribute->name }}"
                            id="{{ $attribute->name }}"
                            step ="0.01"
                            class="input-group border border-gray-600 p-3 w-full mt-3 h-12"
                        >
                    </td>
                </tr>
            @endforeach
            <div class="form-group py-5">
                <button type="submit" class="btn btn-block bg-blue-400 hover:bg-blue-300 rounded-lg text-white px-8 py-2">Add</button>
            </div>
        </table>
    </form>
@endsection


