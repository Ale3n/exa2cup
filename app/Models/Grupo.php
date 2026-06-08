<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Postulante;

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

    public const CAPACITY = 70;

    public function maxCapacity()
    {
        return self::CAPACITY;
    }

    public function isFull()
    {
        return $this->inscritos >= self::CAPACITY;
    }

    public static function generarCodigoGrupo(int $index): string
    {
        $letters = range('X', 'Z');

        if ($index < count($letters)) {
            return 'S' . $letters[$index];
        }

        return 'S' . ($index + 1);
    }

    public static function crearGruposAutomaticos(int $cantidadPostulantes, int $gestionId, string $modalidad = 'presencial', ?string $dias = null): array
    {
        $capacidad = self::CAPACITY;
        $gruposNecesarios = (int) ceil($cantidadPostulantes / $capacidad);
        $gruposCreados = [];

        for ($i = 0; $i < $gruposNecesarios; $i++) {
            $codigo = self::generarCodigoGrupo($i);
            $originalCodigo = $codigo;
            $suffix = 1;

            while (self::where('codigo', $codigo)->exists()) {
                $codigo = $originalCodigo . '_' . $suffix;
                $suffix++;
            }

            $grupo = self::create([
                'gestion_id' => $gestionId,
                'codigo' => $codigo,
                'dias' => $dias,
                'modalidad' => $modalidad,
                'inscritos' => 0,
            ]);

            $gruposCreados[] = $grupo;
        }

        return $gruposCreados;
    }

    public static function crearGruposAutomaticosPorPostulantes(int $gestionId, string $modalidad = 'presencial', ?string $dias = null): array
    {
        $cantidadPostulantes = Postulante::count();

        if ($cantidadPostulantes <= 0) {
            return [];
        }

        return self::crearGruposAutomaticos($cantidadPostulantes, $gestionId, $modalidad, $dias);
    }
    public static function buscarOCrearGrupoDisponible(Grupo $grupoBase): Grupo
{
    // Buscar un grupo de la misma gestión, mismos días y misma modalidad que tenga cupo
    $grupoDisponible = self::where('gestion_id', $grupoBase->gestion_id)
        ->where('dias', $grupoBase->dias)
        ->where('modalidad', $grupoBase->modalidad)
        ->where('inscritos', '<', self::CAPACITY)
        ->orderBy('id')
        ->first();

    if ($grupoDisponible) {
        return $grupoDisponible;
    }

    // Si no existe grupo con cupo, crear uno nuevo automáticamente
    $codigoBase = preg_replace('/-\d+$/', '', $grupoBase->codigo);

    // Para que no pase de 10 caracteres, porque en la BD codigo es string(10)
    $codigoBase = substr($codigoBase, 0, 7);

    $numero = 2;

    do {
        $codigoNuevo = $codigoBase . '-' . $numero;
        $numero++;
    } while (self::where('codigo', $codigoNuevo)->exists());

    return self::create([
        'gestion_id' => $grupoBase->gestion_id,
        'codigo' => $codigoNuevo,
        'dias' => $grupoBase->dias,
        'modalidad' => $grupoBase->modalidad,
        'inscritos' => 0,
    ]);
    ///////RAMA_Alex
}
}
