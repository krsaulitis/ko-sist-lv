<?php

namespace App\Http\Controllers\Submissions;

use App\Http\Controllers\Shared\Controller;
use App\Mail\AuditionSubmissionApproved;
use App\Mail\AuditionSubmissionRejected;
use App\Models\AuditionSubmission;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AuditionSubmissionsApiController extends Controller
{
    public function create(AuditionSubmissionCreateRequest $request): RedirectResponse
    {
        $audition_submission = new AuditionSubmission();
        $audition_submission->name = $request->name;
        $audition_submission->surname = $request->surname;
        $audition_submission->motivation = $request->motivation;
        $audition_submission->phone_number = $request->phone_number;
        $audition_submission->experience = $request->experience;
        $audition_submission->email = $request->email;
        $audition_submission->status = AuditionSubmission::STATUS_PENDING;

        if (!$audition_submission->save()) {
            return back()->withErrors(['general' => 'Kaut kas nogāja greizi. Lūdzu mēģini vēlāk.']);
        }

        return redirect()->route('thanks');
    }

    public function reject(string $id): JsonResponse
    {
        DB::beginTransaction();

        /** @var AuditionSubmission $submission */
        $submission = AuditionSubmission::query()->find($id);

        if (!$submission->reject()->save()) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => 'Failed to approve submission']);
        }

        if (Mail::to($submission->email)->send(new AuditionSubmissionRejected())) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => 'Failed to send email']);
        }

        DB::commit();

        return response()->json(['success' => true]);
    }

    public function approve(string $id): JsonResponse
    {
        DB::beginTransaction();

        /** @var AuditionSubmission $submission */
        $submission = AuditionSubmission::query()->find($id);
        if (!$submission->approve()->save()) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => 'Failed to approve submission']);
        }

        $plainPassword = Str::password(8, symbols: false);

        $user = new User();
        $user->name = "$submission->name $submission->surname";
        $user->email = $submission->email;
        $user->phone = $submission->phone_number;
        $user->password = Hash::make($plainPassword);

        if (!$user->save()) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => 'Failed to save user']);
        }

        if (Mail::to($user->email)->send(new AuditionSubmissionApproved($plainPassword))) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => 'Failed to send email']);
        }

        DB::commit();

        return response()->json(['success' => true]);
    }
}
