@extends('layouts.admin')

@section('content')
    <form action="/admin/attribute/create/{{ $category->id }}" method="POST" class="p-5">
        @csrf
        <input
            type="text"
            name="name"
            placeholder="write the attributes separated using coma"
            class="input-group border border-gray-600 p-3 w-full mt-3 h-12"
            value="{{ old('name') }}">
        @error('name')
            <p class="text-sm text-red-500">{{ $message }}</p>
        @enderror
        <div class="form-group py-5">
            <button type="submit" class="btn btn-block bg-blue-400 hover:bg-blue-300 rounded-lg text-white px-8 py-2">Add</button>
        </div>
    </form>
@endsection
