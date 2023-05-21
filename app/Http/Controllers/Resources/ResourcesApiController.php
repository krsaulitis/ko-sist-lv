<?php

namespace App\Http\Controllers\Resources;

use App\Http\Controllers\Events\EventDataRequest;
use App\Http\Controllers\Resources\Requests\ResourceDataRequest;
use App\Http\Controllers\Shared\Controller;
use App\Models\Resource;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;

class ResourcesApiController extends Controller
{
    public function create(ResourceDataRequest $request): JsonResponse
    {
        $fileExtension = $request->file->extension();
        $fileName = time() . '_' . Str::slug($request->title, '_');

        $filePath = $request
            ->file('file')
            ->storeAs('uploads/resources', "$fileName.$fileExtension", 'public');

        $resource = new Resource();
        $resource->title = $request->title;
        $resource->path = $filePath;
        if (!$resource->save()) {
            return response()->json(['success' => false, 'message' => 'Failed to save resource']);
        }

        return response()->json(['success' => true, 'data' => $resource]);
    }

    public function update(string $id, EventDataRequest $request): JsonResponse
    {
        /** @var Resource $resource */
        $resource = Resource::query()->find($id);
        $resource->title = $request->title;
        $resource->save();

        return response()->json(['success' => true, 'data' => $resource]);
    }

    public function delete(string $id, EventDataRequest $request): JsonResponse
    {
        if (!Resource::query()->find($id)->delete()) {
            return response()->json(['success' => false, 'message' => 'Failed to delete resource']);
        }

        return response()->json(['success' => true]);
    }
}
