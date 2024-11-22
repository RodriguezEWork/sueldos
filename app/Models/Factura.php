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
        'vacaciones',
        'osecac',
        'horas_extras_50_nro',	
        'horas_extras_100_nro',	
        'vacaciones_nro',	
        'injustificadas',	
        'justificadas',	
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