<div class="rounded shadow-lg p-3 justify-between flex w-full mb-4 items-center">
    <div class="flex items-center">
        <a href="/profile/{{ $user->id }}"><img class="rounded-full" src="{{ $user->getUserAvatar($user) }}"
                                                alt="Sunset in the mountains" style=" height: 100px; width: 100px;"></a>
        <div class="px-6 py-4">
            <a href="/profile/{{ $user->id }}">
                <div class="font-bold text-xl mb-2">{{ $user->name }}</div>
            </a>
            <p class="text-gray-700 text-base">
                {{ $user->bio }}
            </p>
        </div>
    </div>
    <div>
        @if(auth()->user()->follows()->where('following_user_id', $user->id)->exists())
            <form action="/profile/{{ $user->id }}/unfollow" method="POST">
                @csrf
                <button
                    type="submit"
                    class="rounded-full px-6 py-2 btn btn-block hover:bg-gray-300 border border-gray-400 ml-2">
                    Following
                </button>
            </form>
        @else
            <form action="/profile/{{ $user->id }}/follow" method="POST">
                @csrf
                <button
                    type="submit"
                    class="bg-blue-500 rounded-full px-6 py-2 text-white hover:bg-blue-300 btn btn-block ml-2">
                    Follow Me
                </button>
            </form>
        @endif
    </div>
</div>
