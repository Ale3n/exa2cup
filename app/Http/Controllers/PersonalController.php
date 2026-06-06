<?php

namespace App\Http\Controllers;

use App\Models\Personal;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Models\User;
use App\Models\Materia;
use App\Models\Bitacora;
use Illuminate\Support\Facades\Hash;
class PersonalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($tipo)
    {
        $personals = Personal::where('tipo', $tipo)->get();
        return view('admin.personal.index', compact('personals', 'tipo'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($tipo)
    {
        $roles = Role::all();
        $materias = Materia::all();

        // Pasar un objeto Personal vacío con un usuario temporal
        // para evitar errores en la vista al acceder a relaciones
        $personal = new Personal();
        $usuario = new User();
        $usuario->setRelation('roles', collect());
        $personal->setRelation('usuario', $usuario);

        return view('admin.personal.create', compact('tipo', 'roles', 'personal', 'materias'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'rol' => 'required',
            'tipo' => 'required|in:docente,administrativo',

            'nombres' => 'required',
            'apellidos' => 'required',
            'ci' => 'required|unique:personals,ci',

            'fecha_nacimiento' => 'required',
            'telefono' => 'required',
            'direccion' => 'required',
            'profesion' => 'required|exists:materias,nombre',

            'email' => 'required|email|unique:users,email',

            'es_profesional_area' => 'nullable|boolean',
            'tiene_maestria' => 'nullable|boolean',
            'tiene_diplomado_educ_superior' => 'nullable|boolean',
        ]);

        $usuario = new User();
        $usuario->name = $request->apellidos . ' ' . $request->nombres;
        $usuario->email = $request->email;
        $usuario->password = Hash::make($request->ci);
        $usuario->email_verified_at = now();
        $usuario->save();

        $usuario->assignRole($request->rol);

        $personal = new Personal();
        $personal->user_id = $usuario->id;

        $personal->tipo = $request->tipo;

        $personal->nombres = $request->nombres;
        $personal->apellidos = $request->apellidos;
        $personal->ci = $request->ci;

        $personal->fecha_nacimiento = $request->fecha_nacimiento;

        $personal->telefono = $request->telefono;
        $personal->direccion = $request->direccion;
        $personal->profesion = $request->profesion;

        $personal->es_profesional_area = $request->has('es_profesional_area');
        $personal->tiene_maestria = $request->has('tiene_maestria');
        $personal->tiene_diplomado_educ_superior = $request->has('tiene_diplomado_educ_superior');

        $personal->save();

        Bitacora::create([
            'usuario' => auth()->user()->name ?? 'Sistema',
            'accion' => 'Creó el personal ' . $personal->tipo . ' ' . $personal->apellidos . ' ' . $personal->nombres . ' (CI ' . $personal->ci . ')',
            'hora' => now('America/La_Paz'),
        ]);

        return redirect()->route('admin.personal.index', $request->tipo)
            ->with('mensaje', 'El personal se ha creado correctamente')
            ->with('icono', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $personal = Personal::findOrFail($id);

        return view('admin.personal.show', compact('personal'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $personal = Personal::findOrFail($id);
        $roles = Role::all();
        $materias = Materia::all();
        return view('admin.personal.edit', compact('personal', 'roles', 'materias'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $personal = Personal::findOrFail($id);
        $usuario = User::findOrFail($personal->user_id);

        $request->validate([
            'rol' => 'required',
            'tipo' => 'required|in:docente,administrativo',

            'nombres' => 'required',
            'apellidos' => 'required',

            'ci' => 'required|unique:personals,ci,' . $id,

            'fecha_nacimiento' => 'required',
            'telefono' => 'required',
            'direccion' => 'required',
            'profesion' => 'required|exists:materias,nombre',

            'email' => 'required|email|unique:users,email,' . $usuario->id,

            'es_profesional_area' => 'nullable|boolean',
            'tiene_maestria' => 'nullable|boolean',
            'tiene_diplomado_educ_superior' => 'nullable|boolean',
        ]);

        $usuario->name = $request->apellidos . ' ' . $request->nombres;
        $usuario->email = $request->email;
        $usuario->password = Hash::make($request->ci);
        $usuario->save();

        $usuario->syncRoles($request->rol);

        $personal->tipo = $request->tipo;

        $personal->nombres = $request->nombres;
        $personal->apellidos = $request->apellidos;
        $personal->ci = $request->ci;

        $personal->fecha_nacimiento = $request->fecha_nacimiento;

        $personal->telefono = $request->telefono;
        $personal->direccion = $request->direccion;
        $personal->profesion = $request->profesion;

        // No se modifican los campos de requisitos académicos en edición.
        // Se conservan los valores actuales en el registro.

        $personal->save();

        Bitacora::create([
            'usuario' => auth()->user()->name ?? 'Sistema',
            'accion' => 'Actualizó el personal ' . $personal->tipo . ' ' . $personal->apellidos . ' ' . $personal->nombres . ' (CI ' . $personal->ci . ')',
            'hora' => now('America/La_Paz'),
        ]);

        return redirect()->route('admin.personal.index', $personal->tipo)
            ->with('mensaje', 'El personal ' . $personal->tipo . ' se ha actualizado correctamente')
            ->with('icono', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
         $personal = Personal::findOrFail($id);

        $tipo = $personal->tipo;

        $usuario = User::findOrFail($personal->user_id);

        // Por el cascade, al eliminar el usuario
        // también se elimina el registro en personals
        $usuario->delete();

        Bitacora::create([
            'usuario' => auth()->user()->name ?? 'Sistema',
            'accion' => 'Eliminó el personal ' . $tipo . ' ' . $personal->apellidos . ' ' . $personal->nombres . ' (CI ' . $personal->ci . ')',
            'hora' => now('America/La_Paz'),
        ]);

        return redirect()->route('admin.personal.index', $tipo)
            ->with('mensaje', 'El personal ' . $tipo . ' se ha eliminado correctamente')
            ->with('icono', 'success');
    }
}
