<?php

namespace App\Http\Controllers\Calendar;

use App\Http\Controllers\Shared\Request;

/**
 * @property string $title
 */
class EventCreateRequest extends Request
{
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
        ];
    }
}
