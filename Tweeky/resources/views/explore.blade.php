@extends('layouts.app')

@section('content')
    <div class="lg:flex lg:justify-between">
        <div class="lg:w-1/6 p-6 bg-blue-100 rounded-md">
            @include ('_sidebar-links')
        </div>

        <div class="lg:flex-1 lg:mx-10">
            @foreach($users as $user)
                @include('_explore-friends')
            @endforeach
        </div>

        <div class="lg:w-1/6 bg-blue-100 p-6 rounded-md">
            @include ('_friends-list')
        </div>
    </div>
@endsection
