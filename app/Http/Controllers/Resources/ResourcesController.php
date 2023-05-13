<?php

namespace App\Http\Controllers\Resources;
use App\Http\Controllers\Shared\Controller;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\JsonResponse;
use App\Models\Resource;
use Illuminate\Http\Request;
use Symfony\Component\Console\Input\Input;

class ResourcesController extends Controller
{
    public function index(): Renderable
    {
        $resources = Resource::query()->get()->all();

        return view('resources/view', ['resources' => $resources]);
    }

    public function createForm()
    {
        return view('resources/resource-upload');
    }

    public function create(ResourceCreateRequest $request): JsonResponse
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

    public function fileUpload(Request $req)
    {
        $req->validate([
            'name' => 'required|string|max:255',
            'file' => 'required|mimes:csv,txt,xlx,xls,pdf|max:2048'
        ]);
        $fileModel = new Resource();
        if($req->file()) {
            $fileName = $req->file->getClientOriginalName();
            $filePath = $req->file('file')->storeAs('uploads', $fileName, 'public');
            $fileModel->name = request('name');
            $fileModel->file_path = '/storage/' . $filePath;
            $fileModel->save();
            return back()
                ->with('success','File has been uploaded.')
                ->with('file', $fileName);
        }
    }
}


