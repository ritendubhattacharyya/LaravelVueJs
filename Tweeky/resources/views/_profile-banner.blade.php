<header class="relative">
    <img
        src="/img/101325.jpg"
        alt="cover"
        class="w-full h-64 rounded-lg mb-3">

    <div class="flex justify-between items-center mb-3">
        <div>
            <p class="font-bold text-2xl" style="max-width: 270px;">{{ $user->name }}</p>
            <p class="text-sm">Joined on {{ $user->created_at }}</p>
        </div>
        <div class="flex">
            @can('edit', $user)
                <a
                    href="/profile/{{ $user->id }}/edit"
                    class="rounded-full px-6 py-2 btn btn-block hover:bg-gray-300 border border-gray-400">
                    Edit Profile
                </a>
            @endcan
            @if($user->id !== auth()->user()->id)
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
            @endif

        </div>
    </div>
    <img
        src="{{ $user->getUserAvatar($user) }}"
        alt="avatar"
        class="rounded-full mr-2 absolute "
        style="left: 40%; top: 46%; height: 150px; width: 140px"
    >
    <p
        class="text-sm"
    >
        {{ $user->bio }}
    </p>


</header>
<hr class="my-3 mb-2">

