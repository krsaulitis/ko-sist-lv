<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Shared\Controller;
use Illuminate\Contracts\Support\Renderable;

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

    public function thanks(): Renderable
    {
        return view('auth.thanks');
    }
}
