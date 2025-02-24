@extends('layouts.app')

@section('content')
    <div class="container mx-auto mt-10">
        <h1 class="text-3xl">Search Results for "{{ request('search') }}"</h1>

        @if($users->isEmpty())
            <p>No users found.</p>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 mt-6">
                @foreach ($users as $user)
                    <div class="w-full max-w-sm bg-white border border-gray-200 rounded-lg shadow-sm p-4">
                        <div class="flex flex-col items-center pb-4">
                            <img class="w-24 h-24 mb-3 rounded-full shadow-lg"
                                 src="{{ $user->profile_picture ?? '/default-avatar.png' }}"
                                 alt="{{ $user->name }}"/>
                            <h5 class="mb-1 text-xl font-medium text-gray-900">{{ $user->username }}</h5>
                            <span class="text-sm text-gray-500">{{ $user->bio ?? 'No bio available' }}</span>

                            <div class="flex mt-4">
                                @if ($user->id !== auth()->id())
                                    <form action="{{ route('friend-request.send', $user->id) }}" method="POST">
                                        @csrf
                                        <button type="submit"
                                                class="px-4 py-2 text-sm font-medium text-white bg-blue-700 rounded-lg hover:bg-blue-800">
                                            Add Friend
                                        </button>
                                    </form>
                                @endif
                                <a href="#" class="py-2 px-4 ms-2 text-sm font-medium text-gray-900 bg-white rounded-lg border border-gray-200 hover:bg-gray-100">
                                    Message
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
