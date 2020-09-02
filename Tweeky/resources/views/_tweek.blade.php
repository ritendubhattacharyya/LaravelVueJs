<div class="{{ $loop->last ? '' : 'border-b border-b-gray-400' }}">
    <div class="flex p-8" >
        <div class="mr-4 flex-shrink-0">
            <a href="/profile/{{ $tweek->user->id }}">
                <img
                    src="{{ $tweek->user->getUserAvatar($tweek->user) }}"
                    alt=""
                    class="rounded-full mr-2"
                    style="height:50px; width:50px"
                >
            </a>
        </div>
        <div>
            <a href="/profile/{{ $tweek->user->id }}">
                <div class="font-bold">{{ $tweek->user->name }}</div>
            </a>

            <div class="text-sm">
                {{ $tweek->body }}
            </div>
        </div>
    </div>
    <div class="flex justify-around">
        <div class="flex">
            <form action="/likes/{{ $tweek->id }}" method="post" class="mr-4">
                @csrf
                <button type="submit" class="{{ $tweek->isLikedBy(auth()->user()) ? 'text-blue-400': 'text-gray-400' }}">Like</button>
            </form>
            <p>({{ $tweek->likes ? $tweek->likes : 0 }})</p>
        </div>
        <div class="flex">
            <form action="/dislikes/{{ $tweek->id }}" method="post" class="mr-4">
                @csrf
                <button type="submit" class="{{ $tweek->isDislikedBy(auth()->user()) ? 'text-blue-400': 'text-gray-400' }}">Dislike</button>
            </form>
            <p>({{ $tweek->dislikes ? $tweek->dislikes  : 0 }})</p>
        </div>
    </div>
</div>
