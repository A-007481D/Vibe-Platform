<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vibe - Platform </title>
    <script src="https://cdn.tailwindcss.com"></script>

</head>
<body>

    <div class="min-h-screen bg-gray-50 flex flex-col items-center justify-center px-4">
        <div class="text-center max-w-3xl">
            <h1 class="text-4xl font-bold text-gray-900 sm:text-5xl lg:text-6xl">Welcome to Vibe</h1>
            <p class="mt-4 text-lg text-gray-600">Connect, socialize, and find your people effortlessly.</p>
            <div class="mt-6">
                <a href="{{ route('register') }}" class="px-6 py-3 bg-indigo-600 text-white rounded-lg text-lg font-semibold shadow-md hover:bg-indigo-700">Get Started</a>
                <a href="{{ route('login') }}" class="ml-4 px-6 py-3 border border-gray-300 rounded-lg text-lg font-semibold text-gray-700 hover:bg-gray-200">Log In</a>
            </div>
        </div>
        <div class="mt-16 grid grid-cols-1 md:grid-cols-3 gap-6 max-w-5xl">
            <div class="bg-white p-6 rounded-lg shadow-md text-center">
                <h3 class="text-xl font-semibold text-gray-900">Custom Profiles</h3>
                <p class="text-gray-600 mt-2">Create a personalized profile with pictures and bios.</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-md text-center">
                <h3 class="text-xl font-semibold text-gray-900">Friend System</h3>
                <p class="text-gray-600 mt-2">Send requests, chat, and connect with your friends.</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-md text-center">
                <h3 class="text-xl font-semibold text-gray-900">Advanced Search</h3>
                <p class="text-gray-600 mt-2">Find users by nickname, email, or shared interests.</p>
            </div>
        </div>
        <div class="mt-12 text-center">
            <h2 class="text-2xl font-bold text-gray-900">Join Vibe Today</h2>
            <p class="text-gray-600 mt-2">Start making connections and exploring communities.</p>
            <div class="mt-4">
                <a href="{{ route('register') }}" class="px-6 py-3 bg-indigo-600 text-white rounded-lg text-lg font-semibold shadow-md hover:bg-indigo-700">Sign Up Free</a>
            </div>
        </div>
    </div>

    </body>
</html>

