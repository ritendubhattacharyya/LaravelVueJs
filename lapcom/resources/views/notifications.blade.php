@extends('layouts.app')

@section('content')
    <div class="p-6">
        <h1 class="text-2xl font-bold">Your Notifications</h1>


        <h1 class="text-xl font-bold">unread Notifications</h1>
        <ul class="list-disc p-3">
            @forelse($unreadNotifications as $notification)
                @if($notification->type === 'App\Notifications\OrderNotification')
                    <li>Order placed successfully</li>
                @endif
            @empty
                <li>No Unread notifications</li>
            @endforelse
        </ul>

        <h1 class="text-xl font-bold">read Notifications</h1>
        <ul class="list-disc p-3">
            @forelse($readNotifications as $notification)
                @if($notification->type === 'App\Notifications\OrderNotification')
                    <li>Order placed successfully</li>
                @endif
            @empty
                <li>No Unread notifications</li>
            @endforelse
        </ul>
    </div>


@endsection
