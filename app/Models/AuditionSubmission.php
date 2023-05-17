<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $name
 * @property string $surname
 * @property string $motivation
 * @property string $phone_number
 * @property string $status
 * @property string $experience
 * @property string $email
 * @property string $created_at
 * @property string $updated_at
 */
class AuditionSubmission extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'surname',
        'motivation',
        'phone_number',
        'status',
        'experience',
        'email'
    ];

    protected $table = 'audition_submissions';
}
