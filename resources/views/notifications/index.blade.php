@extends('layouts.app')

@section('content')
<h1 class="text-lg font-bold">Notifications</h1>

@if ($notifications->isEmpty())
<p>No notifications found.</p>
@else
<ul>
    @foreach ($notifications as $notification)
    <li class="border p-4 mb-2">
        {{ $notification->data['message'] ?? 'No message' }}
        <span class="text-gray-500 text-sm">{{ $notification->created_at->diffForHumans() }}</span>
    </li>
    @endforeach
</ul>
@endif
@endsection
