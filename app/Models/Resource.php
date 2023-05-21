<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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
}
