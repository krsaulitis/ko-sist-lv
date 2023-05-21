<?php

namespace App\Http\Controllers\Resources\Requests;

use App\Http\Controllers\Shared\Request;

/**
 * @property ?string $search
 */
class ResourcesFilterRequest extends Request
{

    public function rules(): array
    {
        return [
            'search' => 'sometimes|string|max:255',
        ];
    }
}
