<?php

namespace App\Http\Controllers\Events;

use App\Http\Controllers\Shared\Request;

/**
 * @property string $title
 * @property string $description
 * @property array $dates
 * @property array $resources
 */
class EventDataRequest extends Request
{
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:50',
            'description' => 'required|string|max:2000',
            'dates' => 'required',
            'dates.from' => 'required|date_format:"Y-m-d H:i:s"',
            'dates.to' => 'required|date_format:"Y-m-d H:i:s"',
            'resources.*' => 'required|int'
        ];
    }
}
