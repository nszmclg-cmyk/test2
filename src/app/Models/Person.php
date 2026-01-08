<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Person extends Model
{
    protected $fillable = [
        'name',
        'age',
    ];

    public function greetings(): HasMany
    {
        return $this->hasMany(Greeting::class);
    }
}
