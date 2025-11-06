<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class SpecialAssignment extends Model
{
    public function assigned_students(): MorphMany
    {
        return $this->morphMany(Assignment::class, 'assignable');
    }
}
