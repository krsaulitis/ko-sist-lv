<?php

namespace App\Http\Controllers\Submissions;

use App\Http\Controllers\Shared\Controller;
use Illuminate\Contracts\Support\Renderable;

class AuditionSubmissionsController extends Controller
{
    public function index(): Renderable
    {
        return view('submissions/view', ['test' => [['Vārds', 'Uzvārds', 'name.surname@gmail.com', '+123 4567890', 'Pieredzes teksts', 'Motivācijas vēstules teksts'],
                                                    ['Vārds2', 'Uzvārds2', 'name2.surname2@gmail.com', '+123 45678902', 'Pieredzes teksts2', 'Motivācijas vēstules teksts2'],
                                                    ['Vārds3', 'Uzvārds3', 'name3.surname3@gmail.com', '+123 45678903', 'Pieredzes teksts3', 'Motivācijas vēstules teksts3']]]);
    }
    public function create()
    {
        $audition_submission = new Event();
        $audition_submission->name = $request->name;
        $audition_submission->surname = $request->surname;
        if ($request->motivation != NULL) {
            $audition_submission->motivation = $request->motivation;
        }
        $audition_submission->phone_number = $request->phone_number;
        if ($request->experience != NULL) {
            $audition_submission->experience = $request->experience;
        }
        $audition_submission->email = $request->email;

        if (!$audition_submission->save()) {
            return response()->json(['success' => false, 'message' => 'Failed to save the audition_submission']);
        }

        return response()->json(['success' => true, 'data' => $audition_submission->toArray()]);
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
