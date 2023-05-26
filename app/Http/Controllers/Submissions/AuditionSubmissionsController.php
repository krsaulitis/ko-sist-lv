<?php

namespace App\Http\Controllers\Submissions;

use App\Http\Controllers\Shared\Controller;
use App\Models\AuditionSubmission;
use Illuminate\Contracts\Support\Renderable;

class AuditionSubmissionsController extends Controller
{
    public function list(): Renderable
    {
        return view(
            'submissions/list',
            [
                'submissions' => AuditionSubmission::all()
                    ->where('status', AuditionSubmission::STATUS_PENDING)
                    ->all(),
            ],
        );
    }
}
