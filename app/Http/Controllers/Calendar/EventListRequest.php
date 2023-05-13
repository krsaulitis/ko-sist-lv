<?php

namespace App\Http\Controllers\Calendar;

use App\Http\Controllers\Shared\Request;
use DateTimeInterface;

/**
 * @property string $start
 * @property string $end
 */
class EventListRequest extends Request
{
    public function rules(): array
    {
        $datetimeFormat = DateTimeInterface::ATOM;

        return [
            'start' => "required|date_format:$datetimeFormat",
            'end' => "required|date_format:$datetimeFormat",
        ];
    }

}
