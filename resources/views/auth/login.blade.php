@extends('layouts.app')

@section('title', 'Login - Vibe')

@section('content')
    <div class="sm:mx-auto sm:w-full sm:max-w-md">
        <h2 class="text-2xl font-bold text-center text-indigo-600">Vibe</h2>
        <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">Sign in to your account</h2>
        <p class="mt-2 text-center text-sm text-gray-600">
            Or <a href="{{ route('register') }}" class="font-medium text-indigo-600 hover:text-indigo-500">create a new account</a>
        </p>
    </div>

    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
        <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
            @if ($errors->any())
                <div class="mb-4 p-3 bg-red-100 text-red-700 rounded-md">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li class="text-sm">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email address</label>
                    <input id="email" name="email" type="email" value="{{ old('email') }}" required
                           class="w-full px-3 py-2 border rounded-md shadow-sm @error('email') border-red-500 @enderror">
                    @error('email')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input id="password" name="password" type="password" required
                           class="w-full px-3 py-2 border rounded-md shadow-sm @error('password') border-red-500 @enderror">
                    @error('password')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-between">
                    <label class="flex items-center">
                        <input type="checkbox" name="remember" class="mr-2"> Remember me
                    </label>
                    <a href="{{ route('password.request') }}" class="text-sm text-indigo-600">Forgot your password?</a>
                </div>

                <button type="submit" class="w-full py-2 bg-indigo-600 text-white rounded-md">Sign in</button>
            </form>
        </div>
    </div>
@endsection
