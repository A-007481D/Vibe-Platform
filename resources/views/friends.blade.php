<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Friends</title>
    @vite('resources/css/app.css')
</head>
<body>
<div class="container mx-auto mt-10">
    <h1 class="text-3xl">Your Friends</h1>

    <ul class="mt-6">
        @foreach ($friends as $friend)
            <li class="flex items-center mb-4">
                <img src="{{ $friend->profile_photo }}" alt="Profile Photo" class="w-12 h-12 rounded-full mr-4">
                <span class="text-xl">{{ $friend->name }}</span>
            </li>
        @endforeach
    </ul>
</div>
</body>
</html>
