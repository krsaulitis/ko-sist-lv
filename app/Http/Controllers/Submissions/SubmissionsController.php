<?php

namespace App\Http\Controllers\Submissions;

use App\Http\Controllers\Shared\Controller;
use Illuminate\Contracts\Support\Renderable;

class SubmissionsController extends Controller
{
    public function index(): Renderable
    {
        return view('submissions/view');
    }
}
