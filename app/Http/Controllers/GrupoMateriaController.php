<?php

namespace App\Http\Controllers;

use App\Models\Bitacora;
use App\Models\GrupoMateria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Grupo;
use App\Models\Materia;
use App\Models\Personal;
use App\Models\Aula;

class GrupoMateriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $grupoMaterias = GrupoMateria::with([
            'grupo',
            'materia',
            'personal',
            'aula'
        ])->get();

        $grupos = Grupo::all();
        $materias = Materia::all();
        $personales = Personal::whereHas('usuario', function ($query) {
            $query->whereHas('roles', function ($query) {
                $query->where('name', 'DOCENTE');
            });
        })->get();
        $aulas = Aula::all();

        return view('admin.grupo-materias.index', compact(
            'grupoMaterias',
            'grupos',
            'materias',
            'personales',
            'aulas'
        ));
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

            'grupo_id'      => 'required|exists:grupos,id',
            'materia_id'    => 'required|exists:materias,id',
            'personal_id'   => 'required|exists:personals,id',
            'aula_id'       => 'required|exists:aulas,id',
            'hora_inicio'   => 'required',
            'hora_fin'      => 'required|after:hora_inicio',

        ]);

        if ($validate->fails()) {

            return redirect()
                ->back()
                ->withErrors($validate)
                ->withInput();
        }

        $personal = Personal::find($request->personal_id);
        $materia = Materia::find($request->materia_id);

        if (!$personal || !$materia || trim(strtolower($personal->profesion)) !== trim(strtolower($materia->nombre))) {
            return redirect()
                ->back()
                ->withInput()
                ->with('mensaje', 'El docente sólo puede enseñar la materia de su profesión.')
                ->with('icono', 'error');
        }

        $gruposAsignados = GrupoMateria::where('personal_id', $request->personal_id)
            ->pluck('grupo_id')
            ->unique();

        if (!$gruposAsignados->contains($request->grupo_id) && $gruposAsignados->count() >= 4) {
            return redirect()
                ->back()
                ->withInput()
                ->with('mensaje', 'El docente ya está asignado a 4 grupos distintos.')
                ->with('icono', 'error');
        }

        // Evitar duplicados
        $existe = GrupoMateria::where('grupo_id', $request->grupo_id)
            ->where('materia_id', $request->materia_id)
            ->exists();

        if ($existe) {

            return redirect()
                ->back()
                ->withInput()
                ->with('mensaje', 'La materia ya está asignada a este grupo.')
                ->with('icono', 'error');
        }
        // Evitar choque de horario por aula
        // Ejemplo:
        // Aula 12 de 07:00 a 08:30 no puede volver a usarse de 07:00 a 08:30
        // Tampoco de 07:30 a 09:00 porque se cruza.
        $existeChoqueAula = GrupoMateria::where('aula_id', $request->aula_id)
            ->where('hora_inicio', '<', $request->hora_fin)
            ->where('hora_fin', '>', $request->hora_inicio)
            ->exists();

        if ($existeChoqueAula) {
            return redirect()
                ->back()
                ->withInput()
                ->with('mensaje', 'El aula seleccionada ya está ocupada en ese horario.')
                ->with('icono', 'error');
        }

        // Evitar choque de horario por docente
        // El mismo docente no puede estar en dos grupos al mismo tiempo.
        $existeChoqueDocente = GrupoMateria::where('personal_id', $request->personal_id)
            ->where('hora_inicio', '<', $request->hora_fin)
            ->where('hora_fin', '>', $request->hora_inicio)
            ->exists();

        if ($existeChoqueDocente) {
            return redirect()
                ->back()
                ->withInput()
                ->with('mensaje', 'El docente seleccionado ya tiene una clase en ese horario.')
                ->with('icono', 'error');
        }

        $grupoMateria = new GrupoMateria();

        $grupoMateria->grupo_id     = $request->grupo_id;
        $grupoMateria->materia_id   = $request->materia_id;
        $grupoMateria->personal_id  = $request->personal_id;
        $grupoMateria->aula_id      = $request->aula_id;
        $grupoMateria->hora_inicio  = $request->hora_inicio;
        $grupoMateria->hora_fin     = $request->hora_fin;

        $grupoMateria->save();

        Bitacora::create([
            'usuario' => auth()->user()->name ?? 'Sistema',
            'accion' => 'Creó la asignación de materia ' . $materia->nombre . ' al grupo ' . $request->grupo_id . ' con docente ' . $personal->nombre,
            'hora' => now('America/La_Paz'),
        ]);

        return redirect()->route('admin.grupo-materias.index')
            ->with('mensaje', 'La asignación se creó correctamente.')
            ->with('icono', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show(GrupoMateria $grupoMateria)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(GrupoMateria $grupoMateria)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, GrupoMateria $grupoMateria)
    {
        $validate = Validator::make($request->all(), [

            'grupo_id'      => 'required|exists:grupos,id',
            'materia_id'    => 'required|exists:materias,id',
            'personal_id'   => 'required|exists:personals,id',
            'aula_id'       => 'required|exists:aulas,id',
            'hora_inicio'   => 'required',
            'hora_fin'      => 'required|after:hora_inicio',

        ]);

        if ($validate->fails()) {

            return redirect()
                ->back()
                ->withErrors($validate)
                ->withInput()
                ->with('modal_id', $grupoMateria->id);
        }

        $personal = Personal::find($request->personal_id);
        $materia = Materia::find($request->materia_id);

        if (!$personal || !$materia || trim(strtolower($personal->profesion)) !== trim(strtolower($materia->nombre))) {
            return redirect()
                ->back()
                ->withInput()
                ->with('modal_id', $grupoMateria->id)
                ->with('mensaje', 'El docente sólo puede enseñar la materia de su profesión.')
                ->with('icono', 'error');
        }

        $gruposAsignados = GrupoMateria::where('personal_id', $request->personal_id)
            ->where('id', '!=', $grupoMateria->id)
            ->pluck('grupo_id')
            ->unique();

        if (!$gruposAsignados->contains($request->grupo_id) && $gruposAsignados->count() >= 4) {
            return redirect()
                ->back()
                ->withInput()
                ->with('modal_id', $grupoMateria->id)
                ->with('mensaje', 'El docente ya está asignado a 4 grupos distintos.')
                ->with('icono', 'error');
        }

        // Evitar duplicados
        $existe = GrupoMateria::where('grupo_id', $request->grupo_id)
            ->where('materia_id', $request->materia_id)
            ->where('id', '!=', $grupoMateria->id)
            ->exists();

        if ($existe) {

            return redirect()
                ->back()
                ->withInput()
                ->with('modal_id', $grupoMateria->id)
                ->with('mensaje', 'La materia ya está asignada a este grupo.')
                ->with('icono', 'error');
        }
        // Evitar choque de horario por aula
        // Excluye el registro actual para que no choque consigo mismo al editar
        $existeChoqueAula = GrupoMateria::where('aula_id', $request->aula_id)
            ->where('id', '!=', $grupoMateria->id)
            ->where('hora_inicio', '<', $request->hora_fin)
            ->where('hora_fin', '>', $request->hora_inicio)
            ->exists();

        if ($existeChoqueAula) {
            return redirect()
                ->back()
                ->withInput()
                ->with('modal_id', $grupoMateria->id)
                ->with('mensaje', 'El aula seleccionada ya está ocupada en ese horario.')
                ->with('icono', 'error');
        }

        // Evitar choque de horario por docente
        // El mismo docente no puede estar asignado a dos clases al mismo tiempo
        $existeChoqueDocente = GrupoMateria::where('personal_id', $request->personal_id)
            ->where('id', '!=', $grupoMateria->id)
            ->where('hora_inicio', '<', $request->hora_fin)
            ->where('hora_fin', '>', $request->hora_inicio)
            ->exists();

        if ($existeChoqueDocente) {
            return redirect()
                ->back()
                ->withInput()
                ->with('modal_id', $grupoMateria->id)
                ->with('mensaje', 'El docente seleccionado ya tiene una clase en ese horario.')
                ->with('icono', 'error');
        }

        $grupoMateria->grupo_id     = $request->grupo_id;
        $grupoMateria->materia_id   = $request->materia_id;
        $grupoMateria->personal_id  = $request->personal_id;
        $grupoMateria->aula_id      = $request->aula_id;
        $grupoMateria->hora_inicio  = $request->hora_inicio;
        $grupoMateria->hora_fin     = $request->hora_fin;

        $grupoMateria->save();

        Bitacora::create([
            'usuario' => auth()->user()->name ?? 'Sistema',
            'accion' => 'Actualizó la asignación de materia ' . $materia->nombre . ' al grupo ' . $request->grupo_id . ' con docente ' . $personal->nombre,
            'hora' => now('America/La_Paz'),
        ]);

        return redirect()->route('admin.grupo-materias.index')
            ->with('mensaje', 'La asignación se actualizó correctamente.')
            ->with('icono', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(GrupoMateria $grupoMateria)
    {
        $materia = Materia::find($grupoMateria->materia_id);
        $personal = Personal::find($grupoMateria->personal_id);

        $grupoMateria->delete();

        Bitacora::create([
            'usuario' => auth()->user()->name ?? 'Sistema',
            'accion' => 'Eliminó la asignación de materia ' . ($materia->nombre ?? $grupoMateria->materia_id) . ' del grupo ' . $grupoMateria->grupo_id . ' con docente ' . ($personal->nombre ?? $grupoMateria->personal_id),
            'hora' => now('America/La_Paz'),
        ]);

        return redirect()->route('admin.grupo-materias.index')
            ->with('mensaje', 'La asignación se eliminó correctamente.')
            ->with('icono', 'success');
    }
}
