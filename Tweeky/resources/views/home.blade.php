@extends('layouts.app')

@section('content')
    <div class="lg:flex lg:justify-between">
        <div class="lg:w-1/6 p-6 bg-blue-100 rounded-md">
            @include ('_sidebar-links')
        </div>
        <div class="lg:flex-1 lg:mx-10">
            <div class="border border-blue-400 rounded-lg px-8 py-5">
                @include('_publish-tweek')
            </div>
            <div class="border border-gray-300 rounded-lg mt-6">
                @forelse($tweeks as $tweek)
                    @include('_tweek')
                @empty
                    <div class="flex p-8 border-b border-b-gray-400">
                        <p>No Post Yet!!</p>
                    </div>
                @endforelse
            </div>
        </div>
        <div class="lg:w-1/6 bg-blue-100 p-6 rounded-md">
            @include ('_friends-list')
        </div>
    </div>
@endsection
