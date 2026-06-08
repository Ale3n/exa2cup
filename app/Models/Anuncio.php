<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Anuncio extends Model
{
    protected $fillable = [
        'titulo',
        'mensaje',
        'rol_destino',
        'activo'
    ];

    public function usuarios()
    {
        return $this->belongsToMany(User::class);
    }
}
