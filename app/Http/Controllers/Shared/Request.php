<?php

namespace App\Http\Controllers\Shared;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

abstract class Request extends FormRequest
{
    protected bool $isJsonResponse = true;

    abstract public function rules(): array;

    protected function failedValidation(Validator $validator): void
    {
        if ($this->isJsonResponse) {
            throw new HttpResponseException(response()->json($validator->errors(), 422));
        } else {
            parent::failedValidation($validator);
        }
    }
}
