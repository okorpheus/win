<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TeacherAvailability extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $primaryKey = 'user_id';
    public $incrementing = false;
    protected $keyType = 'int';

    public function teacher(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id');
    }
}
