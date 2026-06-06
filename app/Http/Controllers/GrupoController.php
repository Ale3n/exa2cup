<?php

namespace App\Http\Controllers;

use App\Models\Bitacora;
use App\Models\Grupo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Gestion;

class GrupoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $grupos = Grupo::with('gestion')->get();
        $gestiones = Gestion::all();

        return view('admin.grupos.index', compact('grupos', 'gestiones'));
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
        $validate = Validator::make($request->all(), [
        'gestion_id'  => 'required|exists:gestions,id',
        'codigo'      => 'required|string|max:10|unique:grupos,codigo',
        'dias'        => 'nullable|string|max:20',
        'modalidad'   => 'required|in:presencial,virtual',
        'inscritos'   => 'nullable|integer|min:0',
        ]);

        if ($validate->fails()) {

            return redirect()
                ->back()
                ->withErrors($validate)
                ->withInput();
        }

        $grupo = new Grupo();

        $grupo->gestion_id  = $request->gestion_id;
        $grupo->codigo      = $request->codigo;
        $grupo->dias        = $request->dias;
        $grupo->modalidad   = $request->modalidad;
        $grupo->inscritos   = $request->inscritos ?? 0;

        $grupo->save();

        Bitacora::create([
            'usuario' => auth()->user()->name ?? 'Sistema',
            'accion' => 'Creó el grupo ' . $grupo->codigo . ' en la gestión ' . $grupo->gestion_id,
            'hora' => now('America/La_Paz'),
        ]);

        return redirect()->route('admin.grupos.index')
            ->with('mensaje', 'El grupo se creó correctamente.')
            ->with('icono', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show(Grupo $grupo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Grupo $grupo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Grupo $grupo)
    {
            $validate = Validator::make($request->all(), [
            'gestion_id'  => 'required|exists:gestions,id',
            'codigo'      => 'required|string|max:10|unique:grupos,codigo,' . $grupo->id,
            'dias'        => 'required|string|max:20',
            'modalidad'   => 'required|in:presencial,virtual',
        ]);

        if ($validate->fails()) {
            return redirect()
                ->back()
                ->withErrors($validate)
                ->withInput()
                ->with('modal_id', $grupo->id);
        }

        $grupo->gestion_id  = $request->gestion_id;
        $grupo->codigo      = $request->codigo;
        $grupo->dias        = $request->dias;
        $grupo->modalidad   = $request->modalidad;
        $grupo->save();

        Bitacora::create([
            'usuario' => auth()->user()->name ?? 'Sistema',
            'accion' => 'Actualizó el grupo ' . $grupo->codigo . ' en la gestión ' . $grupo->gestion_id,
            'hora' => now('America/La_Paz'),
        ]);

        return redirect()->route('admin.grupos.index')
            ->with('mensaje', 'El grupo se actualizó correctamente')
            ->with('icono', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Grupo $grupo)
    {
        if ($grupo->inscritos > 0) {//Simple y directo. Primero verifica que el grupo no tenga inscritos antes de 
                                    //eliminar, si tiene lanza el error de vuelta. Si no tiene, elimina y redirige 
                                    //con el mensaje de éxito igual que tu update de gestiones.
        return redirect()
            ->back()
            ->with('mensaje', 'No se puede eliminar el grupo porque tiene postulantes inscritos.')
            ->with('icono', 'error');
        }

        $codigo = $grupo->codigo;
        $gestionId = $grupo->gestion_id;

        $grupo->delete();

        Bitacora::create([
            'usuario' => auth()->user()->name ?? 'Sistema',
            'accion' => 'Eliminó el grupo ' . $codigo . ' de la gestión ' . $gestionId,
            'hora' => now('America/La_Paz'),
        ]);

        return redirect()->route('admin.grupos.index')
            ->with('mensaje', 'El grupo se eliminó correctamente.')
            ->with('icono', 'success');
    }
}
