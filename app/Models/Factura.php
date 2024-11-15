<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Factura extends Model
{
    protected $fillable = [
        'user_id',
        'mes',
        'año',
        'antiguedad',	
        'presentismo',
        'horas_extras_50',	
        'horas_extras_100',	
        'jubilacion',
        'ley_19032',
        'obra_social',	
        'sec_art_100',	
        'faecys_art_100',	
        'sec_art_101',
        'osecac'	
    ];

    protected $casts = [
        'mes' => 'integer',
        'año' => 'integer'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
} 