<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $nameParts = explode(' ', $request->input('name'));
        $firstName = $nameParts[0];
        $lastName = $nameParts[1] ?? null;

        $username = $this->generateUniqueUsername($firstName);

//        $request->validate([
//            'last_name' => ['nullable', 'string', 'max:50'],
//            'username' => ['nullable', 'string', 'max:50', 'unique:users,username'],
//            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
//            'password' => ['required', 'confirmed', Rules\Password::defaults()],
//        ]);

        $user = User::create([
            'first_name' => $firstName,
            'last_name' => $lastName,
            'username' => $username,
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('profile.edit', absolute: false));
    }
    private function generateUniqueUsername($firstName)
    {
        $baseUsername = Str::lower($firstName);
        $username = $baseUsername;

        $counter = 1;
        while (User::where('username', $username)->exists()) {
            $username = $baseUsername . $counter;
            $counter++;
        }

        return $username;
    }
}
