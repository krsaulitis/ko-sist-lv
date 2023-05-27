<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as BaseUser;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

/**
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $email_verified_at
 * @property string $phone
 * @property string $password
 * @property string $role
 * @property string $created_at
 * @property string $updated_at
 */
class User extends BaseUser
{
    public const ROLE_ADMIN = 'admin';
    public const ROLE_MEMBER = 'member';

    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function setPassword(string $password): void
    {
        $this->password = Hash::make($password);
    }

    public function displayRole(): string
    {
        return match ($this->role) {
            self::ROLE_ADMIN => 'Administrators',
            self::ROLE_MEMBER => 'Dalībnieks',
        };
    }
}
