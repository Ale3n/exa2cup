<?php

namespace App\Http\Controllers;

use App\Models\InscripcionGrupo;
use Illuminate\Http\Request;
use App\Models\Postulante;
use App\Models\Grupo;
use Illuminate\Support\Facades\Validator;

class InscripcionGrupoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $inscripcionGrupos = InscripcionGrupo::with([
            'postulante',
            'grupo'
        ])->get();

        $postulantes = Postulante::all();
        $grupos = Grupo::all();

        return view('admin.inscripcion-grupos.index', compact(
            'inscripcionGrupos',
            'postulantes',
            'grupos'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'postulante_id'  => 'required|exists:postulantes,id',
            'grupo_id'       => 'required|exists:grupos,id',
            'fecha_eleccion' => 'required|date',
        ]);

        if ($validate->fails()) {

            return redirect()
                ->back()
                ->withErrors($validate)
                ->withInput();
        }

        // Evitar inscripción duplicada
        $existe = InscripcionGrupo::where('postulante_id', $request->postulante_id)
            ->where('grupo_id', $request->grupo_id)
            ->exists();

        if ($existe) {

            return redirect()
                ->back()
                ->withInput()
                ->with('mensaje', 'El postulante ya está inscrito en este grupo.')
                ->with('icono', 'error');
        }

        // Validar capacidad máxima del grupo
        $grupo = Grupo::find($request->grupo_id);

        if ($grupo->inscripcionGrupos()->count() >= 60) {

            return redirect()
                ->back()
                ->withInput()
                ->with('mensaje', 'El grupo ya alcanzó el máximo de 60 inscritos.')
                ->with('icono', 'error');
        }

        $inscripcionGrupo = new InscripcionGrupo();

        $inscripcionGrupo->postulante_id = $request->postulante_id;
        $inscripcionGrupo->grupo_id = $request->grupo_id;
        $inscripcionGrupo->fecha_eleccion = $request->fecha_eleccion;

        $inscripcionGrupo->save();

        // Actualizar contador de inscritos
        $grupo->increment('inscritos');

        return redirect()
            ->route('admin.inscripcion-grupos.index')
            ->with('mensaje', 'La inscripción fue registrada correctamente.')
            ->with('icono', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show(InscripcionGrupo $inscripcionGrupo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(InscripcionGrupo $inscripcionGrupo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, InscripcionGrupo $inscripcionGrupo)
    {
        $validate = Validator::make($request->all(), [
            'postulante_id'  => 'required|exists:postulantes,id',
            'grupo_id'       => 'required|exists:grupos,id',
            'fecha_eleccion' => 'required|date',
        ]);

        if ($validate->fails()) {

            return redirect()
                ->back()
                ->withErrors($validate)
                ->withInput()
                ->with('modal_id', $inscripcionGrupo->id);
        }

        // Evitar duplicados al editar
        $existe = InscripcionGrupo::where('postulante_id', $request->postulante_id)
            ->where('grupo_id', $request->grupo_id)
            ->where('id', '!=', $inscripcionGrupo->id)
            ->exists();

        if ($existe) {

            return redirect()
                ->back()
                ->withInput()
                ->with('modal_id', $inscripcionGrupo->id)
                ->with('mensaje', 'El postulante ya está inscrito en este grupo.')
                ->with('icono', 'error');
        }

        $inscripcionGrupo->postulante_id = $request->postulante_id;
        $inscripcionGrupo->grupo_id = $request->grupo_id;
        $inscripcionGrupo->fecha_eleccion = $request->fecha_eleccion;

        $inscripcionGrupo->save();

        return redirect()
            ->route('admin.inscripcion-grupos.index')
            ->with('mensaje', 'La inscripción se actualizó correctamente.')
            ->with('icono', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(InscripcionGrupo $inscripcionGrupo)
    {
        $grupo = $inscripcionGrupo->grupo;

        $inscripcionGrupo->delete();

        if ($grupo && $grupo->inscritos > 0) {
            $grupo->decrement('inscritos');
        }

        return redirect()
            ->route('admin.inscripcion-grupos.index')
            ->with('mensaje', 'La inscripción se eliminó correctamente.')
            ->with('icono', 'success');
    }
}
