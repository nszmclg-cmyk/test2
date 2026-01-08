<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Greeting extends Model
{
    protected $fillable = [
        'person_id',
        'message',
    ];

    public function person(): BelongsTo
    {
        return $this->belongsTo(Person::class);
    }
}
