<?php

namespace App\Http\Controllers\Resources;

// use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Http\Controllers\Shared\Request;

/**
 * @property string $file_path
 * @property string $name
 */

class ResourceListRequest extends Controller
{
    // function pathinfo(
    //     string $path,
    //     int|null $flags = PATHINFO_ALL
    // ): array|string

    // //$ext_type = array('gif','jpg','jpe','jpeg','png');
    // pathinfo(string $path, int $flags = PATHINFO_ALL): array|string
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'file_path' => 'required|string|max:255'];
    }
}
