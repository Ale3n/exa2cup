<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Carrera;

class Postulante extends Model
{
    /**
     * Fillable attributes (optional)
     */
    protected $fillable = [
        'usuario_id',
        'carrera_primera_id',
        'carrera_segunda_id',
        'nombres',
        'apellidos',
        'ci',
        'fecha_nacimiento',
        'telefono',
        'direccion',
        'genero',
        'estado',
        'tiene_bachiller',
        'entrego_libreta_notas',
        'entrego_ci',
        'entrego_formulario_preinscripcion',
        'entrego_comprobante_pago',
    ];

    /**
     * Usuario relacionado (belongsTo User)
     */
    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }

    /**
     * Primera carrera (belongsTo Carrera)
     */
    public function carreraPrimera()
    {
        return $this->belongsTo(Carrera::class, 'carrera_primera_id');
    }

    /**
     * Segunda carrera (belongsTo Carrera)
     */
    public function carreraSegunda()
    {
        return $this->belongsTo(Carrera::class, 'carrera_segunda_id');
    }
}
