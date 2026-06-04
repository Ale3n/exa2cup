<?php

namespace App\Http\Controllers;

use App\Models\Postulante;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Carrera;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class PostulanteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $postulantes = Postulante::with([
            'usuario',
            'carreraPrimera',
            'carreraSegunda'
        ])->get();

        return view('admin.postulantes.index', compact('postulantes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();
        $carreras = Carrera::all();

        return view('admin.postulantes.create', compact(
            'roles',
            'carreras'
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([

            'rol'                           => 'required',

            'nombres'                      => 'required|string|max:100',
            'apellidos'                    => 'required|string|max:100',

            'ci'                           => 'required|unique:postulantes,ci',

            'fecha_nacimiento'             => 'required|date',

            'telefono'                     => 'required|string|max:20',

            'direccion'                    => 'required|string|max:255',

            'genero'                       => 'required|in:masculino,femenino,otro',

            'email'                        => 'required|email|unique:users,email',

            'carrera_primera_id'           => 'required|exists:carreras,id',

            'carrera_segunda_id'           => 'nullable|exists:carreras,id',

            'tiene_bachiller'              => 'required|boolean',

            'entrego_libreta_notas'        => 'required|boolean',

            'entrego_ci'                   => 'required|boolean',

            'entrego_formulario_preinscripcion'
                                             => 'required|boolean',

            'entrego_comprobante_pago'
                                             => 'required|boolean',
        ]);

        // VALIDAR DOCUMENTACIÓN COMPLETA
        $documentacionCompleta =

            $request->tiene_bachiller &&
            $request->entrego_libreta_notas &&
            $request->entrego_ci &&
            $request->entrego_formulario_preinscripcion &&
            $request->entrego_comprobante_pago;

        if (!$documentacionCompleta) {

            return redirect()->back()
                ->withInput()
                ->with('mensaje', 'El postulante no cumple con toda la documentación requerida.')
                ->with('icono', 'error');
        }

        // CREAR USUARIO
        $usuario = new User();

        $usuario->name =
            $request->apellidos . ' ' . $request->nombres;

        $usuario->email = strtolower(trim($request->email));

        // Contraseña inicial: usamos la cédula de identidad para poder iniciar sesión.
        // El campo password está casteado como hashed en User.php,
        // por lo que se guardará correctamente encriptado.
        $usuario->password = $request->ci;

        $usuario->email_verified_at = now();

        $usuario->save();

        // ASIGNAR ROL
        $usuario->assignRole($request->rol);

        // CREAR POSTULANTE
        $postulante = new Postulante();

        $postulante->usuario_id = $usuario->id;

        $postulante->carrera_primera_id =
            $request->carrera_primera_id;

        $postulante->carrera_segunda_id =
            $request->carrera_segunda_id;

        $postulante->nombres = $request->nombres;

        $postulante->apellidos = $request->apellidos;

        $postulante->ci = $request->ci;

        $postulante->fecha_nacimiento =
            $request->fecha_nacimiento;

        $postulante->telefono = $request->telefono;

        $postulante->direccion = $request->direccion;

        $postulante->genero = strtolower($request->genero);

        $postulante->estado = 'aprobado';

        // DOCUMENTOS
        $postulante->tiene_bachiller =
            $request->tiene_bachiller;

        $postulante->entrego_libreta_notas =
            $request->entrego_libreta_notas;

        $postulante->entrego_ci =
            $request->entrego_ci;

        $postulante->entrego_formulario_preinscripcion =
            $request->entrego_formulario_preinscripcion;

        $postulante->entrego_comprobante_pago =
            $request->entrego_comprobante_pago;

        $postulante->save();

        return redirect()
            ->route('admin.postulantes.index')
            ->with('mensaje', 'El postulante se registró correctamente. La contraseña inicial es su cédula de identidad.')
            ->with('icono', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
         $postulante = Postulante::with([
            'usuario',
            'carreraPrimera',
            'carreraSegunda'
        ])->findOrFail($id);

        return view(
            'admin.postulantes.show',
            compact('postulante')
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $postulante = Postulante::with([
            'usuario',
            'carreraPrimera',
            'carreraSegunda'
        ])->findOrFail($id);

        $roles = Role::all();

        $carreras = Carrera::all();

        return view(
            'admin.postulantes.edit',
            compact(
                'postulante',
                'roles',
                'carreras'
            )
        );

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        $postulante = Postulante::findOrFail($id);

        $usuario = User::findOrFail(
            $postulante->usuario_id
        );

        $request->validate([

            'rol'                           => 'required',

            'nombres'                      => 'required|string|max:100',

            'apellidos'                    => 'required|string|max:100',

            'ci'                           =>
                'required|unique:postulantes,ci,' . $id,

            'fecha_nacimiento'             => 'required|date',

            'telefono'                     => 'required|string|max:20',

            'direccion'                    => 'required|string|max:255',

            'genero'                       => 'required|in:masculino,femenino,otro',

            'email'                        =>
                'required|email|unique:users,email,' . $usuario->id,

            'carrera_primera_id'           =>
                'required|exists:carreras,id',

            'carrera_segunda_id'           =>
                'nullable|exists:carreras,id',
        ]);

        // ACTUALIZAR USUARIO
        $usuario->name =
            $request->apellidos . ' ' . $request->nombres;

        $usuario->email = strtolower(trim($request->email));

        $usuario->password = $request->ci;

        $usuario->save();

        $usuario->syncRoles($request->rol);

        // ACTUALIZAR POSTULANTE
        $postulante->carrera_primera_id =
            $request->carrera_primera_id;

        $postulante->carrera_segunda_id =
            $request->carrera_segunda_id;

        $postulante->nombres = $request->nombres;

        $postulante->apellidos = $request->apellidos;

        $postulante->ci = $request->ci;

        $postulante->fecha_nacimiento =
            $request->fecha_nacimiento;

        $postulante->telefono = $request->telefono;

        $postulante->direccion = $request->direccion;

        $postulante->genero = strtolower($request->genero);

        $postulante->save();

        return redirect()
            ->route('admin.postulantes.index')
            ->with('mensaje', 'El postulante se actualizó correctamente.')
            ->with('icono', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $postulante = Postulante::findOrFail($id);

        $usuario = User::findOrFail(
            $postulante->usuario_id
        );

        $usuario->delete();

        $postulante->delete();

        return redirect()
            ->route('admin.postulantes.index')
            ->with('mensaje', 'El postulante se eliminó correctamente.')
            ->with('icono', 'success');
    }
}
