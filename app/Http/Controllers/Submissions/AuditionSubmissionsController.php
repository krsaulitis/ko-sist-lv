<?php

namespace App\Http\Controllers\Submissions;

use App\Http\Controllers\Shared\Controller;
use App\Models\AuditionSubmission;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\JsonResponse;

class AuditionSubmissionsController extends Controller
{
    public function index(): Renderable
    {
        $audition_submissions = AuditionSubmission::all();
        return view('submissions/view', ['audition_submissions' => $audition_submissions]);
    }

    public function create(AuditionSubmissionCreateRequest $request): JsonResponse
    {
        $audition_submission = new AuditionSubmission();
        $audition_submission->name = $request->name;
        $audition_submission->surname = $request->surname;
        $audition_submission->motivation = $request->motivation;
        $audition_submission->phone_number = $request->phone_number;
        $audition_submission->experience = $request->experience;
        $audition_submission->email = $request->email;
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
