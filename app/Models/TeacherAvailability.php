<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TeacherAvailability extends Model
{

    protected $guarded = [];
    protected $primaryKey = 'user_id';
    public $incrementing = false;
    protected $keyType = 'int';
    protected $casts = [
        'M6' => 'boolean',
        'T6' => 'boolean',
        'W6' => 'boolean',
        'R6' => 'boolean',
        'F6' => 'boolean',
        'M7' => 'boolean',
        'T7' => 'boolean',
        'W7' => 'boolean',
        'R7' => 'boolean',
        'F7' => 'boolean',
        'M8' => 'boolean',
        'T8' => 'boolean',
        'W8' => 'boolean',
        'R8' => 'boolean',
        'F8' => 'boolean',
    ];

    public function teacher(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id');
    }
}
