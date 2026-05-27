<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CarreraGestion extends Model
{
    protected $fillable = [
        'carrera_id',
        'gestion_id',
        'cupo_maximo',
        'admitidos',
    ];

    public function carrera()
    {
        return $this->belongsTo(Carrera::class);
    }

    public function gestion()
    {
        return $this->belongsTo(Gestion::class);
    }
}
