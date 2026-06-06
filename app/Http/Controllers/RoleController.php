<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class RoleController extends Controller
{
      public function index()
    {
        $roles = Role::all();
        return view('admin.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.roles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        /*$datos= request()->all();
        return response()->json($datos);
*/
        $request->validate([
            'name' => 'required|max:255|unique:roles',
        ]);
        $rol = new Role();
        $rol->name = $request->name;
        $rol->guard_name = 'web';
        $rol->save();
        return redirect()->route('admin.roles.index')
            ->with('mensaje', 'El rol se ha creado correctamente')
            ->with('icono', 'success');
    }


    public function permisos($id)
    {
        $rol = Role::findOrFail($id);

        $allowedModules = ['carreras', 'grupos', 'gestiones', 'carrera-gestiones', 'carreragestiones', 'postulantes', 'personal', 'aulas', 
        'materias',
        'calificaciones',
        'grupo-materias',
        'inscripcion-grupos'];
        $allowedActions = ['index', 'create', 'store', 'show', 'edit', 'update', 'destroy'];

        $permisos = Permission::all()
            ->filter(function ($permiso) use ($rol, $allowedModules, $allowedActions) {
                if ($rol->name === 'ADMINISTRADOR') {
                    return true;
                }

                if (preg_match('/^admin\.([^.]+)\.([^\.]+)$/', $permiso->name, $matches)) {
                    $module = $matches[1];
                    $action = $matches[2];

                    if ($module === 'roles') {
                        return true;
                    }

                    return in_array($module, $allowedModules, true)
                        && in_array($action, $allowedActions, true);
                }

                return false;
            })
            ->groupBy(function ($permiso) {
                if (preg_match('/^admin\.([^.]+)\./', $permiso->name, $matches)) {
                    $module = $matches[1];

                    if ($module === 'configuracion') {
                        return 'Configuración del sistema';
                    }
                    if ($module === 'niveles') {
                        return 'Niveles';
                    }
                    if ($module === 'grados') {
                        return 'Grados';
                    }
                    if ($module === 'grupos') {
                        return 'Grupos';
                    }
                    if ($module === 'carrera-gestiones' || $module === 'carreragestiones') {
                        return 'Carrera-Gestiones';
                    }
                    if ($module === 'carreras') {
                        return 'Carreras';
                    }
                    if ($module === 'gestiones') {
                        return 'Gestiones';
                    }
                    if ($module === 'turnos') {
                        return 'Turnos';
                    }
                    if ($module === 'idiomas') {
                        return 'Idiomas';
                    }
                    if ($module === 'roles') {
                        return 'Roles';
                    }
                    if ($module === 'personal') {
                        return 'Personal docente y administrativo';
                    }
                    if ($module === 'estudiantes') {
                        return 'Estudiantes';
                    }
                    if ($module === 'postulantes') {
                        return 'Postulantes';
                    }
                    if ($module === 'aulas') {
                        return 'Aulas';
                    }
                    if ($module === 'materias') {
                        return 'Materias';
                    }
                    if ($module === 'calificaciones') {
                        return 'Calificaciones';
                    }
                    if ($module === 'grupo-materias') {
                        return 'Grupo-Materias';
                    }
                    if ($module === 'inscripcion-grupos') {
                        return 'Inscripción-Grupos';
                    }
                }

                return 'Otros permisos';
            });

        return view('admin.roles.permisos', compact('rol', 'permisos'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $rol = Role::findOrFail($id);
        return view('admin.roles.edit', compact('rol'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        $request->validate([
            'name' => 'required|max:255|unique:roles,name,' . $id,
        ]);
        $rol = Role::findOrFail($id);
        $rol->name = $request->name;
        $rol->guard_name = 'web';
        $rol->save();
        return redirect()->route('admin.roles.index')
            ->with('mensaje', 'El rol se ha actualizado correctamente')
            ->with('icono', 'success');
    }

    public function update_permisos(Request $request, $id)
    {
        $rol = Role::findOrFail($id);
        $rol->permissions()->sync($request->input('permisos', []));

        app(PermissionRegistrar::class)->forgetCachedPermissions();

        return redirect()->route('admin.roles.index')
            ->with('mensaje', 'Los permisos se han actualizado correctamente')
            ->with('icono', 'success');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $rol = Role::findOrFail($id);
        $rol->delete();
        return redirect()->route('admin.roles.index')
            ->with('mensaje', 'El rol se ha eliminado correctamente')
            ->with('icono', 'success');
    }
}
