<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cargo extends Model
{
    protected $fillable = [
        'nombre',
        'sueldo_base'
    ];

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }
} 