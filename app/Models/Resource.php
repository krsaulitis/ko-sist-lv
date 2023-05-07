<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $created_at
 * @property string $updated_at
 * @property string $name
 * @property string $file_path
 *
 * @see https://laravel.com/docs/10.x/eloquent
 */
class Resource extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'file_path'
    ];
    // public function user()
    // {
    //   return $this->belongsTo(User::class);
    // }
}
