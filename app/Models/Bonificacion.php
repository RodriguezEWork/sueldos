<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Bonificacion extends Model
{
    protected $table = 'bonificaciones';
    
    protected $fillable = [
        'user_id',
        'tipo',
        'fecha',
        'start_time',
        'end_time'
    ];

    protected $casts = [
        'fecha' => 'date',
        'cantidad' => 'integer'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
} 