<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Shared\Controller;
use App\Models\Resource;
use Illuminate\Http\JsonResponse;

class UsersApiController extends Controller
{
    public function delete(string $id): JsonResponse
    {
        if (!Resource::query()->find($id)->delete()) {
            return response()->json(['success' => false, 'message' => 'Failed to delete user']);
        }

        return response()->json(['success' => true]);
    }
}
