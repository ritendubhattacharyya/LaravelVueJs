<h1 class="font-bold text-2xl">Edit profile</h1>

<form action="/profile/{{ $user->id }}/edit" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="form-group py-5">
        <label
            class="col-form-label"
            for="name">Name</label>
        <input
            type="text"
            name="name"
            id="name"
            value="{{ $user->name }}"
            class="input-group border border-gray-300 w-full mt-3 h-12">
    </div>

    <div class="form-group py-5">
        <label
            class="col-form-label"
            for="email">Email</label>
        <input
            type="email"
            name="email"
            id="email"
            value="{{ $user->email }}"
            class="input-group border border-gray-300 w-full mt-3 h-12">
    </div>

    <div class="form-group py-5">
        <label
            class="col-form-label"
            for="bio">Bio</label>
        <textarea
            name="bio"
            id="bio"
            cols="100"
            rows="100"
            class="input-group border border-gray-300 w-full mt-3 h-12">{{ $user->bio }}</textarea>
    </div>

    <div class="form-group py-5">
        <label
            class="col-form-label"
            for="avatar">Avatar</label>
        <input
            type="file"
            name="avatar"
            id="avatar"
            value="{{ $user->bio }}"
            class="input-group border border-gray-300 w-full mt-3 h-12">
    </div>

    <div class="form-group py-5">
        <button type="submit" class="btn btn-block bg-blue-400 hover:bg-blue-300 rounded-lg text-white px-8 py-2">Update</button>
    </div>

</form>
