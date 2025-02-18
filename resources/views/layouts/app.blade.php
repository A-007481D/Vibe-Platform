<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Vibe')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">

<!-- Main Navigation -->
<nav class="bg-white shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center">
                    <a href="{{url('/')}}" class="text-2xl font-bold text-indigo-600">Vibe</a>
                </div>
                <!-- Navigation Links -->
                <div class="hidden sm:ml-6 sm:flex sm:space-x-8">
                    <a href="{{ url('/') }}" class="border-indigo-500 text-gray-900 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                        Home
                    </a>
                    <a href="{{ route('profile.edit')}}" class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                        Profile
                    </a>
                    <a href="" class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                        Friends
                    </a>
                </div>
            </div>

            <!-- Search -->
            <div class="flex space-x-2 items-center">
                @if (@auth()->check())

                <div class="relative">
                    <input type="text" placeholder="Search users..." class="w-72 rounded-full bg-gray-100 px-4 py-2 text-sm border-0 focus:ring-2 focus:ring-indigo-500">
                </div>

                <!-- User Menu -->
                <div class="ml-4 relative flex items-center space-x-4">
                    <!-- Notifications -->
                    <div class="relative">
                        <button class="p-1 rounded-full text-gray-400 hover:text-gray-500">
                            <span class="sr-only">View notifications</span>
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                            </svg>
                            <!-- Notification badge -->
                            <span class="absolute top-0 right-0 block h-2 w-2 rounded-full bg-red-400 ring-2 ring-white"></span>
                        </button>
                    </div>

                    <!-- Profile dropdown -->
                    <div class="relative flex items-center space-x-4">
                        <button class="flex items-center space-x-2 text-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 rounded-full">
                            <img class="h-8 w-8 rounded-full" src="/api/placeholder/32/32" alt="Profile">
                            <span class="hidden md:block">{{ auth()->user()->username }}</span>
                        </button>
                            @csrf
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="rounded border-2 border-red-500 hover:bg-red-500 px-2 hover:scale-95 duration-200">Logout</button>
                            </form>
                            @else
                                <a href="{{ route('login') }}" class="rounded border-2 border-blue-500 hover:bg-blue-400 px-2 hover:scale-95 duration-200">Login</a>
                                <a href="{{ route('register') }}" class="rounded border-2 border-blue-500 hover:bg-blue-400 px-2 hover:scale-95 duration-200">Register</a>
                            @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>
<div class="min-h-screen flex flex-col justify-center py-12 sm:px-6 lg:px-8">
    @yield('content')
</div>
</body>
</html>
