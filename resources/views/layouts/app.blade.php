<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Vibe')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
<nav class="bg-indigo-600 p-4">
    <div class="max-w-7xl mx-auto flex items-center justify-between">
        <div class="flex items-center">
            <a href="{{ url('/') }}" class="text-white text-lg font-bold">Vibe</a>
            <div class="ml-10 space-x-4">
                <a href="{{ route('profile.edit') }}" class="text-white">Profile</a>
            </div>
        </div>
        <div class="flex items-center space-x-4">
            @if (auth()->check())
                <span class="text-white">Hello, {{ auth()->user()->username }}</span>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="text-white">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="text-white">Login</a>
                <a href="{{ route('register') }}" class="text-white">Register</a>
            @endif
        </div>
    </div>
</nav>
<div class="min-h-screen flex flex-col justify-center py-12 sm:px-6 lg:px-8">
    @yield('content')
</div>
</body>
</html>
