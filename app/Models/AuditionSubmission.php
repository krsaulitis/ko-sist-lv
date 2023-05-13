<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
