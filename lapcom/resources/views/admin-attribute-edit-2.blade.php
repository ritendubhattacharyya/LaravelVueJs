@extends('layouts.admin')

@section('content')
    <form action="/admin/attribute/update/{{ $category->id }}" method="POST" class="p-5">
        @csrf
        @method('put')
        <table class="table-fixed w-full">
            @foreach($attributes as $attribute)
                <tr>
                    <td>
                        <label
                            class="col-form-label"
                            for="{{ $attribute->name }}">{{ $attribute->id }}</label>
                    </td>
                    <td>
                        <input
                            type="text"
                            name="{{ $attribute->id }}"
                            id="{{ $attribute->name }}"
                            step ="0.01"
                            value="{{ $attribute->name }}"
                            class="input-group border border-gray-600 p-3 w-full mt-3 h-12"
                        >
                    </td>
                </tr>
            @endforeach
            <div class="form-group py-5">
                <button type="submit" class="btn btn-block bg-blue-400 hover:bg-blue-300 rounded-lg text-white px-8 py-2">Update</button>
            </div>
        </table>
    </form>
@endsection
