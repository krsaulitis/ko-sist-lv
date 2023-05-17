<?php

namespace App\Http\Controllers\Submissions;

use App\Http\Controllers\Shared\Controller;
use Illuminate\Contracts\Support\Renderable;
use App\Models\AuditionSubmission;
use DB;

class AuditionSubmissionsController extends Controller
{
    public function index(): Renderable
    {
        $audition_submissions =  AuditionSubmission::all();
        return view('submissions/view',['audition_submissions'=>$audition_submissions]);
    }
    public function create()
    {
        $audition_submission = new AuditionSubmission();
        $audition_submission->name = $_POST['name'];
        $audition_submission->surname = $_POST['surname'];
        //if ($_POST['motivation'] != NULL) {
        $audition_submission->motivation = $_POST['motivation'];
        //}
        $audition_submission->phone_number = $_POST['phone_number'];
        //if ($_POST['experience'] != NULL) {
        $audition_submission->experience = $_POST['experience'];
        //}
        $audition_submission->email = $_POST['email'];
        $audition_submission->status = NULL;

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
