@extends('layouts.app')

@section('title', 'Register - Vibe')

@section('content')
    <div class="sm:mx-auto sm:w-full sm:max-w-md">
        <h2 class="text-2xl font-bold text-center text-indigo-600">Vibe</h2>
        <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">Create your account</h2>
        <p class="mt-2 text-center text-sm text-gray-600">
            Already have an account? <a href="{{ route('login') }}" class="font-medium text-indigo-600 hover:text-indigo-500">Sign in</a>
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

            <form method="POST" action="{{ route('register') }}" class="space-y-6">
                @csrf
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Full Name</label>
                    <input id="name" name="name" type="text" value="{{ old('name') }}" required
                        class="w-full px-3 py-2 border rounded-md shadow-sm @error('name') border-red-500 @enderror">
                    @error('name')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

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

                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
                    <input id="password_confirmation" name="password_confirmation" type="password" required
                        class="w-full px-3 py-2 border rounded-md shadow-sm">
                </div>

                <button type="submit" class="w-full py-2 bg-indigo-600 text-white rounded-md">Sign up</button>
            </form>
        </div>
    </div>
@endsection
