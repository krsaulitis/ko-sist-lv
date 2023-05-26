<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Shared\Controller;
use App\Models\User;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class AuthController extends Controller
{
    public function register(): Renderable
    {
        return view('auth.register');
    }

    public function login(): Renderable
    {
        return view('auth.login');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    public function thanks(): Renderable
    {
        return view('auth.thanks');
    }

    public function confirm(string $hash): Renderable
    {
        $email = Crypt::decrypt($hash);

        /** @var User|null $user */
        $user = User::query()->where('email', $email)->first();
        if (!$user) {
            abort(404);
        }

        if ($user->markEmailAsVerified()) {
            abort(500);
        }

        return view('auth.confirm');
    }

    public function change(): Renderable
    {
        return view('auth.password-change');
    }
}
