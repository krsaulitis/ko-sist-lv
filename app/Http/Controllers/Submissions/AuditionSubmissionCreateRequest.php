<?php

namespace App\Http\Controllers\Submissions;

use App\Http\Controllers\Shared\Request;

/**
 * @property string $name
 * @property string $surname
 * @property string $motivation
 * @property string $phone_number
 * @property string $experience
 * @property string $email
 */
class AuditionSubmissionCreateRequest extends Request
{
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:50',
            'surname' => 'required|string|max:50',
            'motivation' => 'required|string|max:1000',
            'phone_number' => 'required|string|max:12',
            'experience' => 'required|string|max:1000',
            'email' => 'required|email',
        ];
    }
}
