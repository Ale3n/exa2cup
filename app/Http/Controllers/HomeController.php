<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Anuncio;
use App\Models\Grupo;
use App\Models\InscripcionGrupo;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $anuncio = null;
        $totalInscritos = null;
        $totalAprobados = null;
        $totalReprobados = null;
        $totalGruposHabilitados = null;

        $isAdminOrAdministrativo = auth()->check() && auth()->user()->hasAnyRole(['ADMINISTRADOR', 'ADMINISTRATIVO']);

        if ($isAdminOrAdministrativo) {
            $inscripciones = InscripcionGrupo::all();

            $totalInscritos = $inscripciones->count();
            $totalAprobados = $inscripciones->filter(function ($inscripcion) {
                return $inscripcion->estadoFinal() === 'APROBADO';
            })->count();
            $totalReprobados = $totalInscritos - $totalAprobados;
            $totalGruposHabilitados = Grupo::count();
        }

        if (
            auth()->check() &&
            auth()->user()->hasRole('ESTUDIANTE')
        ) {
            $anuncio = Anuncio::where('rol_destino', 'ESTUDIANTE')
                ->where('activo', true)
                ->whereDoesntHave('usuarios', function ($query) {
                    $query->where('user_id', auth()->id());
                })
                ->latest()
                ->first();
        }

        return view('home', compact(
            'anuncio',
            'totalInscritos',
            'totalAprobados',
            'totalReprobados',
            'totalGruposHabilitados'
        ));
    }
}
