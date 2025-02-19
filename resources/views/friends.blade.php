@extends('layouts.app')

@section('content')
@section('search')
    {{$search}}
@endsection

<div class="container mx-auto mt-10">
    <h1 class="text-3xl">Your Friends</h1>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 mt-6">
        @foreach ($friends as $friend)
            <div class="w-full max-w-sm bg-white border border-gray-200 rounded-lg shadow-sm">
                <div class="flex justify-end px-4 pt-4">
                    <button id="dropdownButton" data-dropdown-toggle="dropdown" class="inline-block text-gray-500 hover:bg-gray-100 focus:ring-4 focus:outline-none rounded-lg text-sm p-1.5">
                        <span class="sr-only">Open dropdown</span>
                        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 3">
                            <path d="M2 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm6.041 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM14 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Z"/>
                        </svg>
                    </button>
                </div>
                <div class="flex flex-col items-center pb-10">
                   <img class="w-24 h-24 mb-3 rounded-full shadow-lg" src="/api/placeholder/48/48" alt="User Image"/>
                    <h5 class="mb-1 text-xl font-medium text-gray-900">
                        {{ $friend->sender_id == Auth::user()->id ? $friend->reciever->name : $friend->sender->name }}
                    </h5>
                    <span class="text-sm text-gray-500">Visual Designer</span>
                    <div class="flex mt-4">
                        <a href="#" class="px-4 py-2 text-sm font-medium text-white bg-blue-700 rounded-lg hover:bg-blue-800">
                            Add friend
                        </a>
                        <a href="#" class="py-2 px-4 ms-2 text-sm font-medium text-gray-900 bg-white rounded-lg border border-gray-200 hover:bg-gray-100">
                            Message
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
