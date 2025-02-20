@extends('layouts.app')

@section('title', 'Forgot Password - Vibe')

@section('content')
    <div class="sm:mx-auto sm:w-full sm:max-w-md">
        <h2 class="text-2xl font-bold text-center text-indigo-600">Vibe</h2>
        <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">Forgot Password?</h2>
        <p class="mt-2 text-center text-sm text-gray-600">
            Enter your email address, and we’ll send you a link to reset your password.
        </p>
    </div>

    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
        <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
            @if (session('status'))
                <div class="mb-4 p-3 bg-green-100 text-green-700 rounded-md">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
                @csrf
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email address</label>
                    <input id="email" name="email" type="email" value="{{ old('email') }}" required
                           class="w-full px-3 py-2 border rounded-md shadow-sm @error('email') border-red-500 @enderror">
                    @error('email')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit" class="w-full py-2 bg-indigo-600 text-white rounded-md">
                    Send Password Reset Link
                </button>
            </form>
        </div>
    </div>
@endsection
