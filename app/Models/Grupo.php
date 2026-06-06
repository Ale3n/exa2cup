<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{
    protected $fillable = [
        'gestion_id',
        'codigo',
        'dias',
        'modalidad',
        'cupo_maximo',
        'inscritos',
    ];

    public function gestion()
    {
        return $this->belongsTo(Gestion::class);
    }
    public function inscripcionGrupos()
    {
        return $this->hasMany(InscripcionGrupo::class);
    }
}
