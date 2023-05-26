<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UserHasRole
{
    public function handle(Request $request, Closure $next, string $role): Response
    {
        /** @var User|null $user */
        $user = Auth::user();

        if ($user && $user->role === $role) {
            return $next($request);
        }

        abort(404);
    }
}
