<?php

namespace App\Http\Controllers\Resources;

use App\Http\Controllers\Resources\Requests\ResourcesFilterRequest;
use App\Http\Controllers\Shared\Controller;
use App\Models\Resource;
use Illuminate\Contracts\Support\Renderable;

class ResourcesController extends Controller
{
    public function list(ResourcesFilterRequest $request): Renderable
    {
        $query = Resource::query();
        if ($request->search) {
            $query = $query->where('title', 'LIKE', "%$request->search%");
        }

        return view('resources/list', ['resources' => $query->get()->all(), 'search' => $request->search]);
    }

    public function create(): Renderable
    {
        return view('resources/create');
    }

    public function edit(): Renderable
    {
        return view('resources/create');
    }
}
