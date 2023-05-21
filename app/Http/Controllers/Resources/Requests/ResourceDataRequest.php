<?php

namespace App\Http\Controllers\Resources\Requests;

use App\Http\Controllers\Shared\Request;
use Illuminate\Http\UploadedFile;

/**
 * @property string $title
 * @property UploadedFile $file
 */
class ResourceDataRequest extends Request
{
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'file' => 'required|mimes:jpg,png,pdf|max:2048',
        ];
    }
}
