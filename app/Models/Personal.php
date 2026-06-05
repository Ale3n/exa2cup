<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Personal extends Model
{
    protected $fillable = [
        'user_id',
        'tipo',
        'nombres',
        'apellidos',
        'ci',
        'fecha_nacimiento',
        'telefono',
        'direccion',
        'profesion',
        'es_profesional_area',
        'tiene_maestria',
        'tiene_diplomado_educ_superior',
    ];

    protected $casts = [
        'es_profesional_area' => 'boolean',
        'tiene_maestria' => 'boolean',
        'tiene_diplomado_educ_superior' => 'boolean',
        'fecha_nacimiento' => 'date',
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
