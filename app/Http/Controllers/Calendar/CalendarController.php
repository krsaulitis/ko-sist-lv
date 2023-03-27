<?php

namespace App\Http\Controllers\Calendar;

use App\Http\Controllers\Shared\Controller;
use Illuminate\Contracts\Support\Renderable;

class CalendarController extends Controller
{
    public function index(): Renderable
    {
        return view('calendar/view', ['test' => ['a', 'b']]);
    }

    public function create(CreateRequest $request): void
    {
        echo $request->title;
    }

    public function edit(): void
    {

    }
}
