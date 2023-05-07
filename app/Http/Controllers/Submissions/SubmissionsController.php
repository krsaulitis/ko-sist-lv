<?php

namespace App\Http\Controllers\Submissions;

use App\Http\Controllers\Shared\Controller;
use Illuminate\Contracts\Support\Renderable;

class SubmissionsController extends Controller
{
    public function index(): Renderable
    {
        return view('submissions/view', ['test' => [['Vārds', 'Uzvārds', 'name.surname@gmail.com', '+123 4567890', 'Pieredzes teksts', 'Motivācijas vēstules teksts'],
                                                    ['Vārds2', 'Uzvārds2', 'name2.surname2@gmail.com', '+123 45678902', 'Pieredzes teksts2', 'Motivācijas vēstules teksts2'],
                                                    ['Vārds3', 'Uzvārds3', 'name3.surname3@gmail.com', '+123 45678903', 'Pieredzes teksts3', 'Motivācijas vēstules teksts3']]]);
    }
    public function create()
    {
        return view('submissions/view', ['test' => ['a', 'b']]);
    }
    public function edit()
    {
        return view('submissions/view', ['test' => ['a', 'b']]);
    }
    public function delete()
    {
        return view('submissions/view', ['test' => ['a', 'b']]);
    }
    public function approve()
    {
        return view('submissions/view', ['test' => ['a', 'b']]);
    }
}
