<?php

namespace App\Http\Controllers\Resources;

use App\Http\Controllers\Shared\Controller;
use Illuminate\Contracts\Support\Renderable;
// use Symfony\Component\HttpFoundation\JsonResponse;
// use Symfony\Component\HttpFoundation\Request;
use Illuminate\Http\JsonResponse;
use App\Models\Resource;

class ResourcesController extends Controller
{
    public function index(): Renderable
    {
        $resources = Resource::query()->get()->all();

        return view('resources/view', ['resource'=> $resources]);
    }
    public function store(Request $request)
    {
        $resource = new Resource();
        $resource->name = $request->name;
        $resource->file_path = $request->file_path;

        if (!$resource->save()) {
            return response()->json(['success' => false, 'message' => 'Failed to upload the file']);
        }

        return response()->json(['success' => true, 'data' => $resource->toArray()]);
    }

    public function list(Request $request)
    {
        $name = $request->name;
        $file_path = $request->file_path;

        $resources = Resource::query()
            ->where('name', '>=', $name)
            ->where('file_path', '<=', $file_path)
            ->get()
            ->all();

        return response()->json($resources);
    }

    public function delete(int $id)
    {
        $resource = Resource::query()->find($id);

        if (!$resource->delete()) {
            return response()->json(['success' => false, 'message' => 'Failed to delete the resource']);
        }

        return response()->json(['success' => true]);
    }



    public function update(Request $request, int $id)
    {
        $resource = Resource::query()->find($id);

        $resource->name = $request->name;
        $resource->file_path = $request->file_path;

        if (!$resource->save()) {
            return response()->json(['success' => false, 'message' => 'Failed to update the resource']);
        }

        return response()->json(['success' => true, 'data' => $resource->toArray()]);
    }
}


