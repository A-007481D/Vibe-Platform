@extends('layouts.app')

@section('content')
    <h2 class="text-2xl font-bold">Friend Requests</h2>

    @foreach($requests as $request)
        <div class="p-4 bg-white rounded-lg shadow-md mt-4 flex justify-between items-center">
            <div>
                <h3 class="font-semibold">{{ $request->sender->username }}</h3>
            </div>
            <div>
                <form action="{{ route('friend-request.accept', $request->id) }}" method="POST" class="inline-block">
                    @csrf
                    <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-700">
                        Accept
                    </button>
                </form>
                <form action="{{ route('friend-request.reject', $request->id) }}" method="POST" class="inline-block">
                    @csrf
                    <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-700">
                        Reject
                    </button>
                </form>
            </div>
        </div>
    @endforeach
@endsection
