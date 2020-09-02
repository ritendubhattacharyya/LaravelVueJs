<h3 class="font-bold text-xl mb-4">Friends</h3>

<ul>
    @forelse(auth()->user()->follows as $index)
        <li class="mb-4">
            <a href="/profile/{{ $index->id }}">
                <div class="flex items-center">
                    <img
                        src="{{ $index->getUserAvatar($index) }}"
                        alt=""
                        class="rounded-full mr-2"
                        style="height: 50px; width: 50px"
                    >

                    {{ $index->name }}
                </div>
            </a>
        </li>
    @empty
        <li class="mb-4">
            <p>No friends yet!!</p>
        </li>
    @endforelse
</ul>
