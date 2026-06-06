<?php

namespace App\Http\Controllers;

use App\Models\Calificacion;
use Illuminate\Http\Request;
use App\Models\InscripcionGrupo;
use App\Models\Materia;
use Illuminate\Support\Facades\Validator;
use App\Models\Bitacora;

class CalificacionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $calificaciones = Calificacion::with([
            'inscripcionGrupo.postulante',
            'inscripcionGrupo.grupo',
            'materia'
        ])->get();

        $inscripciones = InscripcionGrupo::with(['postulante', 'grupo'])->get();
        $materias = Materia::all();

        return view(
            'admin.calificaciones.index',
            compact('calificaciones', 'inscripciones', 'materias')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'inscripcion_grupo_id_create' => 'required|exists:inscripcion_grupos,id',
            'materia_id_create' => 'required|exists:materias,id',
            'numero_examen_create' => 'required|integer|min:1|max:3',
            'nota_create' => 'required|numeric|min:0|max:100',
        ]);

        $existe = Calificacion::where('inscripcion_grupo_id', $request->inscripcion_grupo_id_create)
            ->where('materia_id', $request->materia_id_create)
            ->where('numero_examen', $request->numero_examen_create)
            ->exists();

        if ($existe) {
            return redirect()->back()
                ->withErrors([
                    'numero_examen_create' => 'Ya existe una calificación para este examen.'
                ])
                ->withInput();
        }

        $calificacion = new Calificacion();

        $calificacion->inscripcion_grupo_id = $request->inscripcion_grupo_id_create;
        $calificacion->materia_id = $request->materia_id_create;
        $calificacion->numero_examen = $request->numero_examen_create;
        $calificacion->nota = $request->nota_create;

        $calificacion->save();

        Bitacora::create([
            'usuario' => auth()->user()->name ?? 'Sistema',
            'accion' => 'Registró calificación #' . $calificacion->id . ' para inscripción ' . $calificacion->inscripcion_grupo_id . ' y materia ' . $calificacion->materia_id,
            'hora' => now('America/La_Paz'),
        ]);

        return redirect()->route('admin.calificaciones.index')
            ->with('mensaje', 'La calificación se ha registrado correctamente.')
            ->with('icono', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show(Calificacion $calificacion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Calificacion $calificacion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validate = Validator::make($request->all(), [
            'inscripcion_grupo_id' => 'required|exists:inscripcion_grupos,id',
            'materia_id' => 'required|exists:materias,id',
            'numero_examen' => 'required|integer|min:1|max:3',
            'nota' => 'required|numeric|min:0|max:100',
        ]);

        if ($validate->fails()) {
            return redirect()
                ->back()
                ->withErrors($validate)
                ->withInput()
                ->with('modal_id', $id);
        }

        $existe = Calificacion::where('inscripcion_grupo_id', $request->inscripcion_grupo_id)
            ->where('materia_id', $request->materia_id)
            ->where('numero_examen', $request->numero_examen)
            ->where('id', '!=', $id)
            ->exists();

        if ($existe) {
            return redirect()
                ->back()
                ->withErrors([
                    'numero_examen' => 'Ya existe una calificación para este examen.'
                ])
                ->withInput()
                ->with('modal_id', $id);
        }

        $calificacion = Calificacion::findOrFail($id);

        $calificacion->inscripcion_grupo_id = $request->inscripcion_grupo_id;
        $calificacion->materia_id = $request->materia_id;
        $calificacion->numero_examen = $request->numero_examen;
        $calificacion->nota = $request->nota;

        $calificacion->save();

        Bitacora::create([
            'usuario' => auth()->user()->name ?? 'Sistema',
            'accion' => 'Actualizó calificación #' . $calificacion->id . ' al examen ' . $calificacion->numero_examen . ' con nota ' . $calificacion->nota,
            'hora' => now('America/La_Paz'),
        ]);

        return redirect()->route('admin.calificaciones.index')
            ->with('mensaje', 'La calificación se ha actualizado correctamente.')
            ->with('icono', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $calificacion = Calificacion::findOrFail($id);

        $calificacion->delete();

        Bitacora::create([
            'usuario' => auth()->user()->name ?? 'Sistema',
            'accion' => 'Eliminó calificación #' . $calificacion->id . ' / inscripción ' . $calificacion->inscripcion_grupo_id . ' / materia ' . $calificacion->materia_id,
            'hora' => now('America/La_Paz'),
        ]);

        return redirect()->route('admin.calificaciones.index')
            ->with('mensaje', 'La calificación se ha eliminado correctamente.')
            ->with('icono', 'success');
    }
}
