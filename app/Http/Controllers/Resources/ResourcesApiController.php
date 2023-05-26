<?php

namespace App\Http\Controllers\Resources;

use App\Http\Controllers\Resources\Requests\ResourceDataRequest;
use App\Http\Controllers\Shared\Controller;
use App\Models\Resource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;

class ResourcesApiController extends Controller
{
    public function create(ResourceDataRequest $request): RedirectResponse
    {
        $resource = Resource::fromRequestData($request);
        if (!$resource->save()) {
            return back()->withErrors(['general' => 'Kaut kas nogāja greizi. Lūdzu mēģini vēlāk.']);
        }

        return redirect()->route('resources-list');
    }

    public function update(string $id, ResourceDataRequest $request): RedirectResponse
    {
        $resource = Resource::fromRequestData($request);
        if (!$resource->update()) {
            return back()->withErrors(['general' => 'Kaut kas nogāja greizi. Lūdzu mēģini vēlāk.']);
        }

        return redirect()->route('resources-list');
    }

    public function delete(string $id): JsonResponse
    {
        if (!Resource::query()->find($id)->delete()) {
            return response()->json(['success' => false, 'message' => 'Failed to delete resource']);
        }

        return response()->json(['success' => true]);
    }
}
