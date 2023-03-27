<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Shared\Controller;
use Illuminate\Contracts\Support\Renderable;

class UsersController extends Controller
{
    public function index(): Renderable
    {
        return view('users/view');
    }
}
