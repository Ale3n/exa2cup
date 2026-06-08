<?php

namespace App\Http\Controllers;

use App\Models\Bitacora;
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

    // Grupo que el usuario seleccionó en el formulario
    $grupoSolicitado = Grupo::findOrFail($request->grupo_id);

    // Si el grupo seleccionado está lleno, buscar o crear otro grupo automáticamente
    if ($grupoSolicitado->isFull()) {
        $grupo = Grupo::buscarOCrearGrupoDisponible($grupoSolicitado);
    } else {
        $grupo = $grupoSolicitado;
    }

    // Evitar inscripción duplicada en el grupo final asignado
    $existe = InscripcionGrupo::where('postulante_id', $request->postulante_id)
        ->where('grupo_id', $grupo->id)
        ->exists();

    if ($existe) {
        return redirect()
            ->back()
            ->withInput()
            ->with('mensaje', 'El postulante ya está inscrito en este grupo.')
            ->with('icono', 'error');
    }

    $inscripcionGrupo = new InscripcionGrupo();

    $inscripcionGrupo->postulante_id = $request->postulante_id;
    $inscripcionGrupo->grupo_id = $grupo->id;
    $inscripcionGrupo->fecha_eleccion = $request->fecha_eleccion;

    $inscripcionGrupo->save();

    // Actualizar contador de inscritos del grupo donde realmente se inscribió
    $grupo->increment('inscritos');

    $postulante = Postulante::find($request->postulante_id);

    $nombrePostulante = trim(
        ($postulante->nombres ?? '') . ' ' . ($postulante->apellidos ?? '')
    );

    if ($nombrePostulante === '') {
        $nombrePostulante = 'ID ' . $request->postulante_id;
    }

    if ($grupoSolicitado->id !== $grupo->id) {
        $accion = 'El grupo ' . $grupoSolicitado->codigo . ' estaba lleno. '
            . 'Se registró automáticamente la inscripción del postulante '
            . $nombrePostulante . ' en el nuevo grupo ' . $grupo->codigo;
    } else {
        $accion = 'Registró la inscripción del postulante '
            . $nombrePostulante . ' en el grupo ' . $grupo->codigo;
    }

    Bitacora::create([
        'usuario' => auth()->user()->name ?? 'Sistema',
        'accion' => $accion,
        'hora' => now('America/La_Paz'),
    ]);

    return redirect()
        ->route('admin.inscripcion-grupos.index')
        ->with('mensaje', 'La inscripción fue registrada correctamente en el grupo ' . $grupo->codigo . '.')
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

        $postulante = Postulante::find($request->postulante_id);
        $grupo = Grupo::find($request->grupo_id);

        Bitacora::create([
            'usuario' => auth()->user()->name ?? 'Sistema',
            'accion' => 'Actualizó la inscripción del postulante ' . ($postulante->nombre ?? 'ID ' . $request->postulante_id) . ' al grupo ' . ($grupo->codigo ?? 'ID ' . $request->grupo_id),
            'hora' => now('America/La_Paz'),
        ]);

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
        $postulante = $inscripcionGrupo->postulante;

        $inscripcionGrupo->delete();

        if ($grupo && $grupo->inscritos > 0) {
            $grupo->decrement('inscritos');
        }

        Bitacora::create([
            'usuario' => auth()->user()->name ?? 'Sistema',
            'accion' => 'Eliminó la inscripción del postulante ' . ($postulante->nombre ?? 'ID ' . $inscripcionGrupo->postulante_id) . ' del grupo ' . ($grupo->codigo ?? 'ID ' . $inscripcionGrupo->grupo_id),
            'hora' => now('America/La_Paz'),
        ]);

        return redirect()
            ->route('admin.inscripcion-grupos.index')
            ->with('mensaje', 'La inscripción se eliminó correctamente.')
            ->with('icono', 'success');
    }
}
