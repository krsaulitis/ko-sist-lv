<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $is
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
    public const STATUS_PENDING = 'pending';
    public const STATUS_APPROVED = 'approved';
    public const STATUS_REJECTED = 'rejected';

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

    public function fullName(): string
    {
        return "$this->name $this->surname";
    }

    public function approve(): bool
    {
        $this->status = self::STATUS_APPROVED;

        return $this->save();
    }

    public function reject(): bool
    {
        $this->status = self::STATUS_REJECTED;

        return $this->save();
    }
}
