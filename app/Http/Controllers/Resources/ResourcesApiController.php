<?php

namespace App\Http\Controllers\Resources;

use App\Http\Controllers\Resources\Requests\ResourceDataRequest;
use App\Http\Controllers\Shared\Controller;
use App\Models\Resource;
use Illuminate\Http\JsonResponse;

class ResourcesApiController extends Controller
{
    public function create(ResourceDataRequest $request): JsonResponse
    {
        $resource = Resource::fromRequestData($request);
        if (!$resource->save()) {
            return response()->json(['success' => false, 'message' => 'Failed to save resource']);
        }

        return response()->json(['success' => true, 'data' => $resource]);
    }

    public function update(string $id, ResourceDataRequest $request): JsonResponse
    {
        $resource = Resource::fromRequestData($request);
        if (!$resource->update()) {
            return response()->json(['success' => false, 'message' => 'Failed to update resource']);
        }

        return response()->json(['success' => true, 'data' => $resource]);
    }

    public function delete(string $id): JsonResponse
    {
        if (!Resource::query()->find($id)->delete()) {
            return response()->json(['success' => false, 'message' => 'Failed to delete resource']);
        }

        return response()->json(['success' => true]);
    }
}
