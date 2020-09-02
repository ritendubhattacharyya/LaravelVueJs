<ul>
    <li>
        <a
            href="/tweeks"
            class="font-bold text-lg mb-4 block">
            Home
        </a>
    </li>
    <li>
        <a
            href="/explore"
            class="font-bold text-lg mb-4 block">
            Explore
        </a>
    </li>
    <li>
        <a
            href="#"
            class="font-bold text-lg mb-4 block">
            Notifications
        </a>
    </li>
    <li>
        <a
            href="/profile/{{ auth()->user()->id }}"
            class="font-bold text-lg mb-4 block">
            Profile
        </a>
    </li>
    <li>
        <form action="/logout" method="POST">
            @csrf
            <button
                type="submit"
                class="font-bold text-lg mb-4 block">
                Logout
            </button>
        </form>
    </li>
</ul>
