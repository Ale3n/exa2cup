<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Calificacion extends Model
{
    public function inscripcionGrupo()
    {
        return $this->belongsTo(InscripcionGrupo::class);
    }
    public function materia()
    {
        return $this->belongsTo(Materia::class);
    }
}
