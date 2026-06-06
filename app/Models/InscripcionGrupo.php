<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InscripcionGrupo extends Model
{
    public function postulante()
{
    return $this->belongsTo(Postulante::class);
}

public function grupo()
{
    return $this->belongsTo(Grupo::class);
}
}
