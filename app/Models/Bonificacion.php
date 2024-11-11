<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Bonificacion extends Model
{
    protected $table = 'bonificaciones';
    
    protected $fillable = [
        'tipo_id',
        'fecha',
        'user_id',
        'cantidad'
    ];

    protected $casts = [
        'fecha' => 'date',
        'cantidad' => 'integer'
    ];

    public function tipo(): BelongsTo
    {
        return $this->belongsTo(Tipo::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
} 