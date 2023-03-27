<?php

namespace App\Http\Controllers\Shared;

use Illuminate\Foundation\Http\FormRequest;

abstract class Request extends FormRequest
{
    abstract public function rules(): array;
}
