<?php

namespace App\Http\Controllers\Events;

use App\Http\Controllers\Shared\Request;

/**
 * @property string $title
 * @property string $description
 * @property string $datetime_from
 * @property string $datetime_to
 * @property array $resources
 */
class EventDataRequest extends Request
{
    protected bool $isJsonResponse = false;

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:50',
            'description' => 'required|string|max:2000',
            'datetime_from' => 'required|date_format:"Y-m-d H:i:s"',
            'datetime_to' => 'required|date_format:"Y-m-d H:i:s"',
            'resources.*' => 'required|int'
        ];
    }
}
