<?php

namespace App\Http\Controllers;

use App\Models\Carrera;
use App\Models\Bitacora;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CarreraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $carreras = Carrera::all();
        return view('admin.carreras.index', compact('carreras'));
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
        'nombre_create' => 'required|max:255',
        'codigo_create' => 'required|max:50|unique:carreras,codigo',
        'capacidad_create' => 'required|integer|min:1',
        'estado_create' => 'required',
        ]);

        $carrera = new Carrera();

        $carrera->nombre = $request->nombre_create;
        $carrera->codigo = $request->codigo_create;
        $carrera->capacidad = $request->capacidad_create;
        $carrera->estado = $request->estado_create;

        $carrera->save();

        Bitacora::create([
            'usuario' => auth()->user()->name ?? 'Sistema',
            'accion' => 'Creó la carrera ' . $carrera->nombre . ' (' . $carrera->codigo . ')',
            'hora' => now('America/La_Paz'),
        ]);

        return redirect()->route('admin.carreras.index')
        ->with('mensaje', 'La carrera se creó correctamente.')
        ->with('icono', 'success');


    }

    /**
     * Display the specified resource.
     */
    public function show(Carrera $carrera)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Carrera $carrera)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Carrera $carrera)
    {
        // Validación
        $validate = Validator::make($request->all(), [
            'nombre' => 'required|max:255',
            'codigo' => 'required|max:50|unique:carreras,codigo,' . $carrera->id,
            'capacidad' => 'required|integer|min:1',
            'estado' => 'required|in:activo,cerrado',
        ]);

        // Si falla la validación
        if ($validate->fails()) {
            return redirect()
                ->back()
                ->withErrors($validate)
                ->withInput()
                ->with('modal_id', $carrera->id);
        }

        // Actualizar datos
        $carrera->nombre = $request->nombre;
        $carrera->codigo = $request->codigo;
        $carrera->capacidad = $request->capacidad;
        $carrera->estado = $request->estado;

        $carrera->save();

        Bitacora::create([
            'usuario' => auth()->user()->name ?? 'Sistema',
            'accion' => 'Actualizó la carrera ' . $carrera->nombre . ' (' . $carrera->codigo . ')',
            'hora' => now('America/La_Paz'),
        ]);

        return redirect()->route('admin.carreras.index')
        ->with('mensaje', 'La carrera se actualizó correctamente')
        ->with('icono', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Carrera $carrera)
    {
        //$carrera = Carrera::findOrFail($id);

        //$nombre = $carrera->nombre;

        $nombre = $carrera->nombre;
        $codigo = $carrera->codigo;

        $carrera->delete();

        Bitacora::create([
            'usuario' => auth()->user()->name ?? 'Sistema',
            'accion' => 'Eliminó la carrera ' . $nombre . ' (' . $codigo . ')',
            'hora' => now('America/La_Paz'),
        ]);

        return redirect()->route('admin.carreras.index')
        ->with('mensaje', 'La carrera se eliminó correctamente')
        ->with('icono', 'success');
        
    }
}
