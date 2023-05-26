<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Shared\Controller;
use App\Http\Controllers\Shared\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class AuthApiController extends Controller
{
    public function login(LoginRequest $request): RedirectResponse
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $request->session()->regenerate();

            return redirect()->route('events-list');
        }

        return back()
            ->withErrors(['general' => 'Lietotāja dati nav atrasti'])
            ->onlyInput('email');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
