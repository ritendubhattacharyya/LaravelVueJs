@extends('layouts.admin')

@section('content')
    <form action="/admin/edit/{{ $product->id }}" method="POST" class="p-5">
        @csrf
        @method('PUT')
        <table class="table-fixed w-full">
            @foreach($product->details as $detail)
                <tr>
                    <td>
                        <label
                            class="col-form-label"
                            for="{{ $detail->attribute_name }}attribute_">{{ $detail->attribute_name }}</label>
                    </td>
                    <td>
                        <input
                            type="text"
                            name="{{ $detail->attribute_name }}"
                            id="{{ $detail->attribute_name }}"
                            step ="0.01"
                            value="{{ $detail->attribute_value }}"
                            class="input-group border border-gray-600 p-3 w-full mt-3 h-12"
                        >
                    </td>
                </tr>
            @endforeach
            <div class="form-group py-5">
                <button type="submit" class="btn btn-block bg-blue-400 hover:bg-blue-300 rounded-lg text-white px-8 py-2">Save</button>
            </div>
        </table>
    </form>
@endsection
