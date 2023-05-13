<?php

namespace App\Http\Controllers\Resources;

use App\Http\Controllers\Shared\Request;

/**
 * @property string $name
 *  @property string $file_path
*/
class ResourceCreateRequest extends Request
{
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'file_path' => 'required|mimes:csv,txt,xlx,xls,pdf|max:2048'];
    }

}
