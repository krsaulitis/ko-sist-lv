<?php

namespace App\Http\Controllers\Auth\Requests;

use App\Http\Controllers\Shared\Request;

/**
 * @property string $current_password
 * @property string $password
 */
class PasswordChangeRequest extends Request
{
    protected bool $isJsonResponse = false;

    public function rules(): array
    {
        return [
            'current_password' => 'required',
            'password' => 'required|confirmed|min:8',
        ];
    }
}
