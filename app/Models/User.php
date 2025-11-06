<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable, TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'last_name',
        'first_name',
        'email',
        'password',
        'role',
        'homeroom',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'two_factor_secret',
        'two_factor_recovery_codes',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password'          => 'hashed',
        ];
    }

    public function initials(): string
    {
        $initial1 = substr($this->first_name, 0, 1);
        $initial2 = substr($this->last_name, 0, 1);
        return $initial1.$initial2;
    }

    public function homeroomTeacher(): BelongsTo|null
    {
        return $this->belongsTo(User::class, 'homeroom');
    }

    public function homeroomStudents(): HasMany|null
    {
        return $this->hasMany(User::class, 'homeroom');
    }

    public function availability(): HasOne|null
    {
        return $this->hasOne(TeacherAvailability::class);
    }

    public function assignments(): HasMany
    {
        return $this->hasMany(Assignment::class, 'student');
    }

    public function assigned_students(): MorphMany
    {
        return $this->morphMany(Assignment::class, 'assignable');
    }
}
