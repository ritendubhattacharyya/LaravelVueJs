<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Lapcom') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
</head>
<body>
    <nav style="height: 10vh; width: 100%; background-color: #ebebeb" class="flex items-center justify-between text-black">
        <div>
            <a href="/">
                <img
                    src="/img/logo.png"
                    alt="logo"
                    height="90"
                    width="90"
                    class="ml-4">
            </a>
        </div>
        <ul class="mr-4 flex text-black-50">
            <li class="mr-4 font-sans uppercase text-sm font-bold">
                <a href="/">
                    Home
                </a>
            </li>
            <li class="mr-4 font-sans uppercase text-sm font-bold">
                <a href="/product">
                    Product
                </a>
            </li>
            @auth
                <li class="mr-4 font-sans uppercase text-sm font-bold">
                    <a href="/cart">
                        Cart
                    </a>
                </li>
                <li class="mr-4 font-sans uppercase text-sm font-bold">
                    <a href="/notifications">
                        Notifications ({{ App\User::find(auth()->user()->id)->unreadNotifications->count() }})
                    </a>
                </li>
                @can('can-open', auth()->user())
                    <li class="mr-4 font-sans uppercase text-sm font-bold">
                        <a href="/admin">
                            Admin
                        </a>
                    </li>
                @endcan
                <li class="font-sans uppercase text-sm font-bold">
                    <form action="/logout" method="POST">
                        @csrf
                        <button type="submit" class="uppercase font-bold">
                            Logout
                        </button>
                    </form>
                </li>
            @else
                <li class="mr-4 font-sans uppercase text-sm font-bold">
                    <a href="{{ route('login') }}">
                        Login
                    </a>
                </li>
                <li class="font-sans uppercase text-sm font-bold">
                    <a href="{{ route('register') }}">
                        Register
                    </a>
                </li>
            @endauth
        </ul>
    </nav>
    <main style="background-color: #f2f2f2">
        @yield('content')
    </main>
    <footer class="flex justify-center items-center" style="width: 100%; height: 30vh; background-color: #525252">
        <p class="text-white text-sm">&copy Lorem ipsum dolor sit amet.</p>
    </footer>
</body>
</html>
