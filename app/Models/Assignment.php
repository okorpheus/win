<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Assignment extends Model
{
    protected $fillable = [
        'date',
        'student',
        'assignable_id',
        'assignable_type',
    ];
    public function student()
    {
        return $this->belongsTo(User::class, 'student');
    }
    public function assignment(): MorphTo
    {
        return $this->morphTo();
    }
}
