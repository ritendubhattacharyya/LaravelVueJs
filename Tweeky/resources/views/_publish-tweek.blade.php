<form action="/tweeks" method="POST">
    @csrf
    <textarea
        name="body"
        id=""
        placeholder="Whats up?"
        class="w-full"
    >{{ old('body') }}</textarea>

    <hr class="my-4">

    <div class="flex justify-between">
        <img
            src="{{ auth()->user()->getUserAvatar(auth()->user()) }}"
            alt="avatar"
            class="rounded-full"
            style="height: 50px; width: 40px"
        >
        <button
            type="submit"
            class="bg-blue-500 rounded-lg px-6 py-3 text-white hover:bg-blue-300">
            Tweet
        </button>
    </div>
    @error('body')
        <p class="text-red-500 text-sm mt-5">{{ $message }}</p>
    @enderror
</form>
