<?php

namespace App\Http\Controllers\Resources;

// use Illuminate\Http\Request;


use App\Http\Controllers\Shared\Request;
use Illuminate\Routing\Controller;

/**
 * @property string $name
 *  @property string $file_path
 */
class ResourceCreateRequest extends Controller
{
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'file_path' => 'required|string|max:255'];
    }
}
