<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Shared\Controller;
use App\Models\User;
use Illuminate\Contracts\Support\Renderable;

class UsersController extends Controller
{
    public function index(): Renderable
    {
        return view('users/view');
    }

    public function list(): Renderable
    {
        return view('users/list', ['users' => User::all()]);
    }
}
