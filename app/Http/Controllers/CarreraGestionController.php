<?php

namespace App\Http\Controllers;

use App\Models\CarreraGestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Carrera;
use App\Models\Gestion;

class CarreraGestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $carreraGestiones = CarreraGestion::with(['carrera', 'gestion'])->get();
        $carreras = Carrera::all();
        $gestiones = Gestion::all();
        return view('admin.carrera-gestiones.index', compact('carreraGestiones',
        'carreras',
        'gestiones'));
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
        'carrera_id'   => 'required|exists:carreras,id',
        'gestion_id'   => 'required|exists:gestions,id',
        'cupo_maximo'  => 'required|integer|min:1',
        'admitidos'    => 'nullable|integer|min:0',
        ]);
        if ($validate->fails()) {

                return redirect()
                    ->back()
                    ->withErrors($validate)
                    ->withInput();
            }

        // Verificar que no exista la misma carrera en la misma gestión
        $existe = CarreraGestion::where('carrera_id', $request->carrera_id)
            ->where('gestion_id', $request->gestion_id)
            ->exists();

        if ($existe) {

            return redirect()
                ->back()
                ->withInput()
                ->with('mensaje', 'La carrera ya está registrada en esta gestión.')
                ->with('icono', 'error');
        }
        $carreraGestion = new CarreraGestion();

        $carreraGestion->carrera_id  = $request->carrera_id;
        $carreraGestion->gestion_id  = $request->gestion_id;
        $carreraGestion->cupo_maximo = $request->cupo_maximo;
        $carreraGestion->admitidos   = $request->admitidos ?? 0;

        $carreraGestion->save();

        return redirect()->route('admin.carrera-gestiones.index')
            ->with('mensaje', 'La carrera gestión se creó correctamente.')
            ->with('icono', 'success');

        

    }

    /**
     * Display the specified resource.
     */
    public function show(CarreraGestion $carreraGestion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CarreraGestion $carreraGestion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CarreraGestion $carreraGestion)
    {
        $validate = Validator::make($request->all(), [
        'carrera_id'   => 'required|exists:carreras,id',
        'gestion_id'   => 'required|exists:gestions,id',
        'cupo_maximo'  => 'required|integer|min:1',
        'admitidos'    => 'required|integer|min:0',
        ]);

        if ($validate->fails()) {

            return redirect()
                ->back()
                ->withErrors($validate)
                ->withInput()
                ->with('modal_id', $carreraGestion->id);
        }

        // Evitar duplicados al actualizar
        $existe = CarreraGestion::where('carrera_id', $request->carrera_id)
            ->where('gestion_id', $request->gestion_id)
            ->where('id', '!=', $carreraGestion->id)
            ->exists();

        if ($existe) {

            return redirect()
                ->back()
                ->withInput()
                ->with('modal_id', $carreraGestion->id)
                ->with('mensaje', 'La carrera ya está registrada en esta gestión.')
                ->with('icono', 'error');
        }

        $carreraGestion->carrera_id  = $request->carrera_id;
        $carreraGestion->gestion_id  = $request->gestion_id;
        $carreraGestion->cupo_maximo = $request->cupo_maximo;
        $carreraGestion->admitidos   = $request->admitidos;

        $carreraGestion->save();

        return redirect()->route('admin.carrera-gestiones.index')
            ->with('mensaje', 'La carrera gestión se actualizó correctamente.')
            ->with('icono', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CarreraGestion $carreraGestion)
    {
         // No permitir eliminar si tiene admitidos
        if ($carreraGestion->admitidos > 0) {

            return redirect()
                ->back()
                ->with('mensaje', 'No se puede eliminar porque tiene postulantes admitidos.')
                ->with('icono', 'error');
        }

        $carreraGestion->delete();

        return redirect()->route('admin.carrera-gestiones.index')
            ->with('mensaje', 'La carrera gestión se eliminó correctamente.')
            ->with('icono', 'success');
    }
}
