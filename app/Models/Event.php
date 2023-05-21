<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property int $id
 * @property string $title
 * @property string $description
 * @property string $datetime_from
 * @property string $datetime_to
 * @property string $created_at
 * @property string $updated_at
 * @property Collection $resources
 */
class Event extends Model
{
    public function resources(): BelongsToMany
    {
        return $this->belongsToMany(Resource::class, 'events_resources');
    }

    public function hasResourceById(int $id): bool
    {
        return $this->resources->contains(fn(Resource $resource) => $resource->id === $id);
    }
}
