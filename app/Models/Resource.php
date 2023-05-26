<?php

namespace App\Models;

use App\Http\Controllers\Resources\Requests\ResourceDataRequest;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;

/**
 * @property int $id
 * @property string $title
 * @property string $path
 * @property int $user_id
 * @property string $created_at
 * @property string $updated_at
 */
class Resource extends Model
{
    public function events(): BelongsToMany
    {
        return $this->belongsToMany(Event::class, 'events_resources');
    }

    public static function fromRequestData(ResourceDataRequest $request): static
    {
        $resource = $request->id ? static::query()->find($request->id) : new static();
        $resource->title = $request->title;

        if ($request->file) {
            $filePath = $request
                ->file('file')
                ->storeAs(
                    path: 'uploads/resources',
                    name: static::generateFileName($request->title, $request->file->extension()),
                    options: 'public',
                );

            $resource->path = $filePath;
        }

        return $resource;
    }

    public static function generateFileName(string $title, string $extension): string
    {
        return time() . '_' . Str::slug($title, '_') . ".$extension";
    }
}
