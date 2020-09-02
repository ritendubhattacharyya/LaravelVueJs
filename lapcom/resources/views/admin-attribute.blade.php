@extends('layouts.admin')

@section('content')
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 mt-5 rounded relative" role="alert">
            <strong class="font-bold">{{ session('success') }}</strong>
        </div>
    @endif
    <h1 class="font-bold text-2xl mb-4">Attributes</h1>
    <form action="/admin/attribute/create" method="get">
        @csrf
        <button type="submit" class="btn btn-block bg-blue-400 hover:bg-blue-300 rounded-lg text-white px-12 py-3">Add</button>
    </form>

    <table class="table-auto bg-white w-full">
        <thead>
        <tr>
            <th class="px-4 py-2">id</th>
            <th class="px-4 py-2">Name</th>
            <th class="px-4 py-2">Created_at</th>
            <th class="px-4 py-2">Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($attributes as $attribute)
            <tr>
                <td class="border border-gray-500 px-4 py-2">{{ $attribute->id }}</td>
                <td class="border border-gray-500 px-4 py-2">{{ $attribute->name }}</td>
                <td class="border border-gray-500 px-4 py-2">{{ $attribute->created_at }}</td>
                <td class="border border-gray-500 px-4 py-2 flex justify-center">
                    <form action="/admin/attribute/{{ $attribute->id }}" method="post">
                        @csrf
                        @method('delete')
                        <button type="submit" class="button bg-transparent text-blue-500">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach

        </tbody>
    </table>
@endsection
