<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $title
 * @property string $comment
 * @property string $start
 * @property string $end
 * @property string $created_at
 * @property string $updated_at
 */
class Event extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'comment', 'start', 'end'];
}
