<?php

namespace App\Http\Controllers;

use App\Models\Aula;
use App\Models\Bitacora;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AulaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {  
        $aulas = Aula::all();
        return view('admin.aulas.index', compact('aulas'));
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
        $request->validate([
            'numero_create' => 'required|integer|unique:aulas,numero',
            'capacidad_create' => 'required|integer|min:1',
        ]);

        $aula = new Aula();
        $aula->numero = $request->numero_create;
        $aula->capacidad = $request->capacidad_create;
        $aula->save();

        Bitacora::create([
            'usuario' => auth()->user()->name ?? 'Sistema',
            'accion' => 'Creó el aula #' . $aula->id . ' con número ' . $aula->numero,
            'hora' => now('America/La_Paz'),
        ]);

        return redirect()->route('admin.aulas.index')
            ->with('mensaje', 'El aula se ha creado correctamente.')
            ->with('icono', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show(Aula $aula)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Aula $aula)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validate = Validator::make($request->all(), [
            'numero' => 'required|integer|unique:aulas,numero,' . $id,
            'capacidad' => 'required|integer|min:1',
        ]);

        if ($validate->fails()) {
            return redirect()
                ->back()
                ->withErrors($validate)
                ->withInput()
                ->with('modal_id', $id);
        }

        $aula = Aula::find($id);

        $aula->numero = $request->numero;
        $aula->capacidad = $request->capacidad;
        $aula->save();

        Bitacora::create([
            'usuario' => auth()->user()->name ?? 'Sistema',
            'accion' => 'Actualizó el aula #' . $aula->id . ' a número ' . $aula->numero,
            'hora' => now('America/La_Paz'),
        ]);

        return redirect()->route('admin.aulas.index')
            ->with('mensaje', 'El aula se ha actualizado correctamente')
            ->with('icono', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $aula = Aula::find($id);

        $numero = $aula->numero;

        $aula->delete();

        Bitacora::create([
            'usuario' => auth()->user()->name ?? 'Sistema',
            'accion' => 'Eliminó el aula #' . $id . ' con número ' . $numero,
            'hora' => now('America/La_Paz'),
        ]);

        return redirect()->route('admin.aulas.index')
            ->with('mensaje', 'El aula se ha eliminado correctamente')
            ->with('icono', 'success');
    }
}
