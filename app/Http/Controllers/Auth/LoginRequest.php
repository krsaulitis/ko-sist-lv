<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Shared\Request;

/**
 * @property string $email
 * @property string $password
 */
class LoginRequest extends Request
{
    protected bool $isJsonResponse = false;

    public function rules(): array
    {
        return [
            'email' => 'required|email',
            'password' => 'required',
        ];
    }
}
