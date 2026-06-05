<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Grupo;
use App\Models\Materia;
use App\Models\Personal;
use App\Models\Aula;

class GrupoMateria extends Model
{
    protected $fillable = [
        'grupo_id',
        'materia_id',
        'personal_id',
        'aula_id',
        'hora_inicio',
        'hora_fin',
    ];

    public function grupo()
    {
        return $this->belongsTo(Grupo::class, 'grupo_id');
    }

    public function materia()
    {
        return $this->belongsTo(Materia::class, 'materia_id');
    }

    public function personal()
    {
        return $this->belongsTo(Personal::class, 'personal_id');
    }

    public function aula()
    {
        return $this->belongsTo(Aula::class, 'aula_id');
    }
}
