<?php

namespace App\Http\Controllers;

use App\Models\Bitacora;
use App\Models\Gestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $gestiones = Gestion::all();
        return view('admin.gestiones.index', compact('gestiones'));
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
        //
        $request->validate([
            'año_create' => 'required|integer',
            'periodo_create' => 'required|in:1,2',
            'descripcion_create' => 'required|max:50',
            'estado_create' => 'required|in:activo,cerrado',
        ]);
        $gestion = new Gestion();
        $gestion->año = $request->año_create;
        $gestion->periodo = $request->periodo_create;
        $gestion->descripcion = $request->descripcion_create;
        $gestion->estado = $request->estado_create;
        $gestion->save();

        Bitacora::create([
            'usuario' => auth()->user()->name ?? 'Sistema',
            'accion' => 'Creó la gestión ' . $gestion->año . ' - ' . $gestion->periodo . ' (' . $gestion->descripcion . ')',
            'hora' => now('America/La_Paz'),
        ]);

        return redirect()->route('admin.gestiones.index')
            ->with('mensaje', 'La gestión se creó correctamente.')
            ->with('icono', 'success');


    }

    /**
     * Display the specified resource.
     */
    public function show(Gestion $gestion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Gestion $gestion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Gestion $gestion)
    {
        $validate = Validator::make($request->all(), [
        'año' => 'required|integer',
        'periodo' => 'required|in:1,2',
        'descripcion' => 'required|max:50',
        'estado' => 'required|in:activo,inactivo',
        ]);

        // Si falla la validación
        if ($validate->fails()) {
            return redirect()
                ->back()
                ->withErrors($validate)
                ->withInput()
                ->with('modal_id', $gestion->id);

        }
        // Actualizar datos
        $gestion->año = $request->año;
        $gestion->periodo = $request->periodo;
        $gestion->descripcion = $request->descripcion;
        $gestion->estado = $request->estado;
        $gestion->save();

        Bitacora::create([
            'usuario' => auth()->user()->name ?? 'Sistema',
            'accion' => 'Actualizó la gestión ' . $gestion->año . ' - ' . $gestion->periodo . ' (' . $gestion->descripcion . ')',
            'hora' => now('America/La_Paz'),
        ]);

        return redirect()->route('admin.gestiones.index')
            ->with('mensaje', 'La gestión se actualizó correctamente')
            ->with('icono', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Gestion $gestion)
    {
        //
        $gestion->delete();

        Bitacora::create([
            'usuario' => auth()->user()->name ?? 'Sistema',
            'accion' => 'Eliminó la gestión ' . $gestion->año . ' - ' . $gestion->periodo . ' (' . $gestion->descripcion . ')',
            'hora' => now('America/La_Paz'),
        ]);

        return redirect()->route('admin.gestiones.index')
            ->with('mensaje', 'La gestión se eliminó correctamente')
            ->with('icono', 'success');
    }
}
