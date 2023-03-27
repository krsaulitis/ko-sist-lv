<?php

namespace App\Http\Controllers\Resources;

use App\Http\Controllers\Shared\Controller;
use Illuminate\Contracts\Support\Renderable;

class ResourcesController extends Controller
{
    public function index(): Renderable
    {
        return view('resources/view');
    }
}
