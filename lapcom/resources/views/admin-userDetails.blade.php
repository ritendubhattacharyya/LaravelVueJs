@extends('layouts.admin')

@section('content')
    <div class="p-4 bg-white" border-gray-500>
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 mt-5 rounded relative" role="alert">
                <strong class="font-bold">{{ session('success') }}</strong>
            </div>
        @endif
        <h1 class="font-bold text-2xl mb-4">Users</h1>
        <table class="table-auto bg-white">
            <thead>
            <tr>
                <th class="px-4 py-2">id</th>
                <th class="px-4 py-2">Name</th>
                <th class="px-4 py-2">Email</th>
                <th class="px-4 py-2">Created_at</th>
                <th class="px-4 py-2">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <td class="border border-gray-500 px-4 py-2">{{ $user->id }}</td>
                    <td class="border border-gray-500 px-4 py-2">{{ $user->name }}</td>
                    <td class="border border-gray-500 px-4 py-2">{{ $user->email }}</td>
                    <td class="border border-gray-500 px-4 py-2">{{ $user->created_at }}</td>
                    <td class="border border-gray-500 px-4 py-2 flex">
                        <form action="/admin/userDetails/{{ $user->id }}" method="post">
                            @csrf
                            @if($user->roles === 'admin')
                                <button
                                    type="submit"
                                    class="button bg-transparent text-red-500 mr-3 {{ ($user->id === auth()->user()->id) ? 'cursor-not-allowed' : '' }}"
                                    name="action"
                                    value="removeAdmin"
                                    {{ ($user->id === auth()->user()->id) ? 'disabled' : '' }}>
                                    Remove Admin
                                </button>
                            @elseif($user->roles === 'manager')
                                <button
                                    type="submit"
                                    class="button bg-transparent text-blue-500 mr-3 {{ ($user->id === auth()->user()->id) ? 'cursor-not-allowed' : '' }}"
                                    name="action"
                                    value="makeAdmin"
                                    {{ ($user->id === auth()->user()->id) ? 'disabled' : '' }}>
                                    Make Admin
                                </button>
                            @else
                                <button
                                    type="submit"
                                    class="button bg-transparent text-blue-500 mr-3 {{ ($user->id === auth()->user()->id) ? 'cursor-not-allowed' : '' }}"
                                    name="action"
                                    value="makeManager"
                                    {{ ($user->id === auth()->user()->id) ? 'disabled' : '' }}>
                                    Make Manager
                                </button>
                            @endif
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
