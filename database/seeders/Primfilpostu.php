<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Carrera;
use App\Models\Postulante;
use App\Models\User;
use Illuminate\Support\Str;

class Primfilpostu extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Usuario y postulante
        $postulanteUser = User::firstOrCreate(
            ['email' => 'ana.postulante@example.com'],
            [
                'name' => 'Ana Postulante',
                'password' => Hash::make('Postulante123!'),
                'email_verified_at' => now('America/La_Paz'),
            ]
        );
        $postulanteUser->assignRole('ESTUDIANTE');

        $carreraPrimera = Carrera::where('codigo', '187-4')->first();
        $carreraSegunda = Carrera::where('codigo', '187-3')->first();

        Postulante::firstOrCreate(
            ['usuario_id' => $postulanteUser->id],
            [
                'carrera_primera_id' => $carreraPrimera->id,
                'carrera_segunda_id' => $carreraSegunda->id,
                'nombres' => 'Ana',
                'apellidos' => 'Gomez',
                'ci' => '7654321',
                'fecha_nacimiento' => '2004-08-25',
                'telefono' => '71234567',
                'direccion' => 'Calle Falsa 456',
                'genero' => 'femenino',
                'estado' => 'aprobado',
                'tiene_bachiller' => true,
                'entrego_libreta_notas' => true,
                'entrego_ci' => true,
                'entrego_formulario_preinscripcion' => true,
                'entrego_comprobante_pago' => true,
            ]
        );

        // 1. Postulante Juan
        $postulanteUser1 = User::firstOrCreate(
            ['email' => 'juan.perez@example.com'],
            [
                'name' => 'Juan Perez',
                'password' => Hash::make('Postulante123!'),
                'email_verified_at' => now('America/La_Paz'),
            ]
        );
        $postulanteUser1->assignRole('ESTUDIANTE');

        Postulante::firstOrCreate(
            ['usuario_id' => $postulanteUser1->id],
            [
                'carrera_primera_id' => $carreraPrimera->id,
                'carrera_segunda_id' => $carreraSegunda->id,
                'nombres' => 'Juan',
                'apellidos' => 'Perez',
                'ci' => '8765432',
                'fecha_nacimiento' => '2005-01-15',
                'telefono' => '72345678',
                'direccion' => 'Av. San Martin 123',
                'genero' => 'masculino',
                'estado' => 'aprobado',
                'tiene_bachiller' => true,
                'entrego_libreta_notas' => true,
                'entrego_ci' => true,
                'entrego_formulario_preinscripcion' => true,
                'entrego_comprobante_pago' => true,
            ]
        );

        // 2. Postulante Maria
        $postulanteUser2 = User::firstOrCreate(
            ['email' => 'maria.lopez@example.com'],
            [
                'name' => 'Maria Lopez',
                'password' => Hash::make('Postulante123!'),
                'email_verified_at' => now('America/La_Paz'),
            ]
        );
        $postulanteUser2->assignRole('ESTUDIANTE');

        Postulante::firstOrCreate(
            ['usuario_id' => $postulanteUser2->id],
            [
                'carrera_primera_id' => $carreraPrimera->id,
                'carrera_segunda_id' => $carreraSegunda->id,
                'nombres' => 'Maria',
                'apellidos' => 'Lopez',
                'ci' => '9876543',
                'fecha_nacimiento' => '2004-11-22',
                'telefono' => '73456789',
                'direccion' => 'Calle Murillo 789',
                'genero' => 'femenino',
                'estado' => 'aprobado',
                'tiene_bachiller' => true,
                'entrego_libreta_notas' => true,
                'entrego_ci' => true,
                'entrego_formulario_preinscripcion' => true,
                'entrego_comprobante_pago' => true,
            ]
        );

        // 3. Postulante Carlos
        $postulanteUser3 = User::firstOrCreate(
            ['email' => 'carlos.mendoza@example.com'],
            [
                'name' => 'Carlos Mendoza',
                'password' => Hash::make('Postulante123!'),
                'email_verified_at' => now('America/La_Paz'),
            ]
        );
        $postulanteUser3->assignRole('ESTUDIANTE');

        Postulante::firstOrCreate(
            ['usuario_id' => $postulanteUser3->id],
            [
                'carrera_primera_id' => $carreraPrimera->id,
                'carrera_segunda_id' => $carreraSegunda->id,
                'nombres' => 'Carlos',
                'apellidos' => 'Mendoza',
                'ci' => '1023456',
                'fecha_nacimiento' => '2005-03-05',
                'telefono' => '74567890',
                'direccion' => 'Av. Bush 456',
                'genero' => 'masculino',
                'estado' => 'aprobado',
                'tiene_bachiller' => true,
                'entrego_libreta_notas' => true,
                'entrego_ci' => true,
                'entrego_formulario_preinscripcion' => true,
                'entrego_comprobante_pago' => true,
            ]
        );

        // 4. Postulante Laura
        $postulanteUser4 = User::firstOrCreate(
            ['email' => 'laura.silva@example.com'],
            [
                'name' => 'Laura Silva',
                'password' => Hash::make('Postulante123!'),
                'email_verified_at' => now('America/La_Paz'),
            ]
        );
        $postulanteUser4->assignRole('ESTUDIANTE');

        Postulante::firstOrCreate(
            ['usuario_id' => $postulanteUser4->id],
            [
                'carrera_primera_id' => $carreraPrimera->id,
                'carrera_segunda_id' => $carreraSegunda->id,
                'nombres' => 'Laura',
                'apellidos' => 'Silva',
                'ci' => '2134567',
                'fecha_nacimiento' => '2004-05-18',
                'telefono' => '75678901',
                'direccion' => 'Calle Linares 234',
                'genero' => 'femenino',
                'estado' => 'aprobado',
                'tiene_bachiller' => true,
                'entrego_libreta_notas' => true,
                'entrego_ci' => true,
                'entrego_formulario_preinscripcion' => true,
                'entrego_comprobante_pago' => true,
            ]
        );

        // 5. Postulante Luis
        $postulanteUser5 = User::firstOrCreate(
            ['email' => 'luis.fernandez@example.com'],
            [
                'name' => 'Luis Fernandez',
                'password' => Hash::make('Postulante123!'),
                'email_verified_at' => now('America/La_Paz'),
            ]
        );
        $postulanteUser5->assignRole('ESTUDIANTE');

        Postulante::firstOrCreate(
            ['usuario_id' => $postulanteUser5->id],
            [
                'carrera_primera_id' => $carreraPrimera->id,
                'carrera_segunda_id' => $carreraSegunda->id,
                'nombres' => 'Luis',
                'apellidos' => 'Fernandez',
                'ci' => '3245678',
                'fecha_nacimiento' => '2005-07-30',
                'telefono' => '76789012',
                'direccion' => 'Av. Arce 987',
                'genero' => 'masculino',
                'estado' => 'aprobado',
                'tiene_bachiller' => true,
                'entrego_libreta_notas' => true,
                'entrego_ci' => true,
                'entrego_formulario_preinscripcion' => true,
                'entrego_comprobante_pago' => true,
            ]
        );

        // 6. Postulante Elena
        $postulanteUser6 = User::firstOrCreate(
            ['email' => 'elena.torres@example.com'],
            [
                'name' => 'Elena Torres',
                'password' => Hash::make('Postulante123!'),
                'email_verified_at' => now('America/La_Paz'),
            ]
        );
        $postulanteUser6->assignRole('ESTUDIANTE');

        Postulante::firstOrCreate(
            ['usuario_id' => $postulanteUser6->id],
            [
                'carrera_primera_id' => $carreraPrimera->id,
                'carrera_segunda_id' => $carreraSegunda->id,
                'nombres' => 'Elena',
                'apellidos' => 'Torres',
                'ci' => '4356789',
                'fecha_nacimiento' => '2004-09-12',
                'telefono' => '77890123',
                'direccion' => 'Calle Sucre 543',
                'genero' => 'femenino',
                'estado' => 'aprobado',
                'tiene_bachiller' => true,
                'entrego_libreta_notas' => true,
                'entrego_ci' => true,
                'entrego_formulario_preinscripcion' => true,
                'entrego_comprobante_pago' => true,
            ]
        );

        // 7. Postulante Pedro
        $postulanteUser7 = User::firstOrCreate(
            ['email' => 'pedro.ramirez@example.com'],
            [
                'name' => 'Pedro Ramirez',
                'password' => Hash::make('Postulante123!'),
                'email_verified_at' => now('America/La_Paz'),
            ]
        );
        $postulanteUser7->assignRole('ESTUDIANTE');

        Postulante::firstOrCreate(
            ['usuario_id' => $postulanteUser7->id],
            [
                'carrera_primera_id' => $carreraPrimera->id,
                'carrera_segunda_id' => $carreraSegunda->id,
                'nombres' => 'Pedro',
                'apellidos' => 'Ramirez',
                'ci' => '5467890',
                'fecha_nacimiento' => '2005-02-20',
                'telefono' => '78901234',
                'direccion' => 'Av. America 852',
                'genero' => 'masculino',
                'estado' => 'aprobado',
                'tiene_bachiller' => true,
                'entrego_libreta_notas' => true,
                'entrego_ci' => true,
                'entrego_formulario_preinscripcion' => true,
                'entrego_comprobante_pago' => true,
            ]
        );

        // 8. Postulante Sofia
        $postulanteUser8 = User::firstOrCreate(
            ['email' => 'sofia.castro@example.com'],
            [
                'name' => 'Sofia Castro',
                'password' => Hash::make('Postulante123!'),
                'email_verified_at' => now('America/La_Paz'),
            ]
        );
        $postulanteUser8->assignRole('ESTUDIANTE');

        Postulante::firstOrCreate(
            ['usuario_id' => $postulanteUser8->id],
            [
                'carrera_primera_id' => $carreraPrimera->id,
                'carrera_segunda_id' => $carreraSegunda->id,
                'nombres' => 'Sofia',
                'apellidos' => 'Castro',
                'ci' => '6578901',
                'fecha_nacimiento' => '2004-12-05',
                'telefono' => '79012345',
                'direccion' => 'Calle Bolivar 159',
                'genero' => 'femenino',
                'estado' => 'aprobado',
                'tiene_bachiller' => true,
                'entrego_libreta_notas' => true,
                'entrego_ci' => true,
                'entrego_formulario_preinscripcion' => true,
                'entrego_comprobante_pago' => true,
            ]
        );

        // 9. Postulante Diego
        $postulanteUser9 = User::firstOrCreate(
            ['email' => 'diego.flores@example.com'],
            [
                'name' => 'Diego Flores',
                'password' => Hash::make('Postulante123!'),
                'email_verified_at' => now('America/La_Paz'),
            ]
        );
        $postulanteUser9->assignRole('ESTUDIANTE');

        Postulante::firstOrCreate(
            ['usuario_id' => $postulanteUser9->id],
            [
                'carrera_primera_id' => $carreraPrimera->id,
                'carrera_segunda_id' => $carreraSegunda->id,
                'nombres' => 'Diego',
                'apellidos' => 'Flores',
                'ci' => '7689012',
                'fecha_nacimiento' => '2005-04-14',
                'telefono' => '70123456',
                'direccion' => 'Av. Villazon 357',
                'genero' => 'masculino',
                'estado' => 'aprobado',
                'tiene_bachiller' => true,
                'entrego_libreta_notas' => true,
                'entrego_ci' => true,
                'entrego_formulario_preinscripcion' => true,
                'entrego_comprobante_pago' => true,
            ]
        );

        // 10. Postulante Valentina
        $postulanteUser10 = User::firstOrCreate(
            ['email' => 'valentina.ortiz@example.com'],
            [
                'name' => 'Valentina Ortiz',
                'password' => Hash::make('Postulante123!'),
                'email_verified_at' => now('America/La_Paz'),
            ]
        );
        $postulanteUser10->assignRole('ESTUDIANTE');

        Postulante::firstOrCreate(
            ['usuario_id' => $postulanteUser10->id],
            [
                'carrera_primera_id' => $carreraPrimera->id,
                'carrera_segunda_id' => $carreraSegunda->id,
                'nombres' => 'Valentina',
                'apellidos' => 'Ortiz',
                'ci' => '8790123',
                'fecha_nacimiento' => '2004-06-28',
                'telefono' => '71345678',
                'direccion' => 'Calle Potosi 951',
                'genero' => 'femenino',
                'estado' => 'aprobado',
                'tiene_bachiller' => true,
                'entrego_libreta_notas' => true,
                'entrego_ci' => true,
                'entrego_formulario_preinscripcion' => true,
                'entrego_comprobante_pago' => true,
            ]
        ); //11
        // 11. Postulante Alejandro
        $postulanteUser11 = User::firstOrCreate(
            ['email' => 'alejandro.vargas@example.com'],
            [
                'name' => 'Alejandro Vargas',
                'password' => Hash::make('Postulante123!'),
                'email_verified_at' => now('America/La_Paz'),
            ]
        );
        $postulanteUser11->assignRole('ESTUDIANTE');

        Postulante::firstOrCreate(
            ['usuario_id' => $postulanteUser11->id],
            [
                'carrera_primera_id' => $carreraPrimera->id,
                'carrera_segunda_id' => $carreraSegunda->id,
                'nombres' => 'Alejandro',
                'apellidos' => 'Vargas',
                'ci' => '6123457',
                'fecha_nacimiento' => '2005-05-12',
                'telefono' => '71112233',
                'direccion' => 'Av. San Aurelio 450',
                'genero' => 'masculino',
                'estado' => 'aprobado',
                'tiene_bachiller' => true,
                'entrego_libreta_notas' => true,
                'entrego_ci' => true,
                'entrego_formulario_preinscripcion' => true,
                'entrego_comprobante_pago' => true,
            ]
        );

        // 12. Postulante Camila
        $postulanteUser12 = User::firstOrCreate(
            ['email' => 'camila.rojas@example.com'],
            [
                'name' => 'Camila Rojas',
                'password' => Hash::make('Postulante123!'),
                'email_verified_at' => now('America/La_Paz'),
            ]
        );
        $postulanteUser12->assignRole('ESTUDIANTE');

        Postulante::firstOrCreate(
            ['usuario_id' => $postulanteUser12->id],
            [
                'carrera_primera_id' => $carreraPrimera->id,
                'carrera_segunda_id' => $carreraSegunda->id,
                'nombres' => 'Camila',
                'apellidos' => 'Rojas',
                'ci' => '6123458',
                'fecha_nacimiento' => '2004-10-19',
                'telefono' => '72223344',
                'direccion' => 'Calle Tarija 78',
                'genero' => 'femenino',
                'estado' => 'aprobado',
                'tiene_bachiller' => true,
                'entrego_libreta_notas' => true,
                'entrego_ci' => true,
                'entrego_formulario_preinscripcion' => true,
                'entrego_comprobante_pago' => true,
            ]
        );

        // 13. Postulante Mateo
        $postulanteUser13 = User::firstOrCreate(
            ['email' => 'mateo.suarez@example.com'],
            [
                'name' => 'Mateo Suarez',
                'password' => Hash::make('Postulante123!'),
                'email_verified_at' => now('America/La_Paz'),
            ]
        );
        $postulanteUser13->assignRole('ESTUDIANTE');

        Postulante::firstOrCreate(
            ['usuario_id' => $postulanteUser13->id],
            [
                'carrera_primera_id' => $carreraPrimera->id,
                'carrera_segunda_id' => $carreraSegunda->id,
                'nombres' => 'Mateo',
                'apellidos' => 'Suarez',
                'ci' => '6123459',
                'fecha_nacimiento' => '2005-08-01',
                'telefono' => '73334455',
                'direccion' => 'Urb. Las Palmas Calle 3',
                'genero' => 'masculino',
                'estado' => 'aprobado',
                'tiene_bachiller' => true,
                'entrego_libreta_notas' => true,
                'entrego_ci' => true,
                'entrego_formulario_preinscripcion' => true,
                'entrego_comprobante_pago' => true,
            ]
        );

        // 14. Postulante Natalia
        $postulanteUser14 = User::firstOrCreate(
            ['email' => 'natalia.guzman@example.com'],
            [
                'name' => 'Natalia Guzman',
                'password' => Hash::make('Postulante123!'),
                'email_verified_at' => now('America/La_Paz'),
            ]
        );
        $postulanteUser14->assignRole('ESTUDIANTE');

        Postulante::firstOrCreate(
            ['usuario_id' => $postulanteUser14->id],
            [
                'carrera_primera_id' => $carreraPrimera->id,
                'carrera_segunda_id' => $carreraSegunda->id,
                'nombres' => 'Natalia',
                'apellidos' => 'Guzman',
                'ci' => '6123460',
                'fecha_nacimiento' => '2004-12-30',
                'telefono' => '74445566',
                'direccion' => 'Av. Banzer Km 6',
                'genero' => 'femenino',
                'estado' => 'aprobado',
                'tiene_bachiller' => true,
                'entrego_libreta_notas' => true,
                'entrego_ci' => true,
                'entrego_formulario_preinscripcion' => true,
                'entrego_comprobante_pago' => true,
            ]
        );

        // 15. Postulante Sebastian
        $postulanteUser15 = User::firstOrCreate(
            ['email' => 'sebastian.pinto@example.com'],
            [
                'name' => 'Sebastian Pinto',
                'password' => Hash::make('Postulante123!'),
                'email_verified_at' => now('America/La_Paz'),
            ]
        );
        $postulanteUser15->assignRole('ESTUDIANTE');

        Postulante::firstOrCreate(
            ['usuario_id' => $postulanteUser15->id],
            [
                'carrera_primera_id' => $carreraPrimera->id,
                'carrera_segunda_id' => $carreraSegunda->id,
                'nombres' => 'Sebastian',
                'apellidos' => 'Pinto',
                'ci' => '6123461',
                'fecha_nacimiento' => '2005-02-14',
                'telefono' => '75556677',
                'direccion' => 'Calle 21 de Calacoto',
                'genero' => 'masculino',
                'estado' => 'aprobado',
                'tiene_bachiller' => true,
                'entrego_libreta_notas' => true,
                'entrego_ci' => true,
                'entrego_formulario_preinscripcion' => true,
                'entrego_comprobante_pago' => true,
            ]
        );

        // 16. Postulante Luciana
        $postulanteUser16 = User::firstOrCreate(
            ['email' => 'luciana.mendez@example.com'],
            [
                'name' => 'Luciana Mendez',
                'password' => Hash::make('Postulante123!'),
                'email_verified_at' => now('America/La_Paz'),
            ]
        );
        $postulanteUser16->assignRole('ESTUDIANTE');

        Postulante::firstOrCreate(
            ['usuario_id' => $postulanteUser16->id],
            [
                'carrera_primera_id' => $carreraPrimera->id,
                'carrera_segunda_id' => $carreraSegunda->id,
                'nombres' => 'Luciana',
                'apellidos' => 'Mendez',
                'ci' => '6123462',
                'fecha_nacimiento' => '2004-07-05',
                'telefono' => '76667788',
                'direccion' => 'Barrio Equipetrol Calle 8',
                'genero' => 'femenino',
                'estado' => 'aprobado',
                'tiene_bachiller' => true,
                'entrego_libreta_notas' => true,
                'entrego_ci' => true,
                'entrego_formulario_preinscripcion' => true,
                'entrego_comprobante_pago' => true,
            ]
        );

        // 17. Postulante Gabriel
        $postulanteUser17 = User::firstOrCreate(
            ['email' => 'gabriel.sosa@example.com'],
            [
                'name' => 'Gabriel Sosa',
                'password' => Hash::make('Postulante123!'),
                'email_verified_at' => now('America/La_Paz'),
            ]
        );
        $postulanteUser17->assignRole('ESTUDIANTE');

        Postulante::firstOrCreate(
            ['usuario_id' => $postulanteUser17->id],
            [
                'carrera_primera_id' => $carreraPrimera->id,
                'carrera_segunda_id' => $carreraSegunda->id,
                'nombres' => 'Gabriel',
                'apellidos' => 'Sosa',
                'ci' => '6123463',
                'fecha_nacimiento' => '2005-09-21',
                'telefono' => '77778899',
                'direccion' => 'Av. Mutualista Calle 5',
                'genero' => 'masculino',
                'estado' => 'aprobado',
                'tiene_bachiller' => true,
                'entrego_libreta_notas' => true,
                'entrego_ci' => true,
                'entrego_formulario_preinscripcion' => true,
                'entrego_comprobante_pago' => true,
            ]
        );

        // 18. Postulante Valeria
        $postulanteUser18 = User::firstOrCreate(
            ['email' => 'valeria.chavez@example.com'],
            [
                'name' => 'Valeria Chavez',
                'password' => Hash::make('Postulante123!'),
                'email_verified_at' => now('America/La_Paz'),
            ]
        );
        $postulanteUser18->assignRole('ESTUDIANTE');

        Postulante::firstOrCreate(
            ['usuario_id' => $postulanteUser18->id],
            [
                'carrera_primera_id' => $carreraPrimera->id,
                'carrera_segunda_id' => $carreraSegunda->id,
                'nombres' => 'Valeria',
                'apellidos' => 'Chavez',
                'ci' => '6123464',
                'fecha_nacimiento' => '2004-11-11',
                'telefono' => '78889900',
                'direccion' => 'Av. Melchor Pinto 230',
                'genero' => 'femenino',
                'estado' => 'aprobado',
                'tiene_bachiller' => true,
                'entrego_libreta_notas' => true,
                'entrego_ci' => true,
                'entrego_formulario_preinscripcion' => true,
                'entrego_comprobante_pago' => true,
            ]
        );

        // 19. Postulante Joaquin
        $postulanteUser19 = User::firstOrCreate(
            ['email' => 'joaquin.gala@example.com'],
            [
                'name' => 'Joaquin Gala',
                'password' => Hash::make('Postulante123!'),
                'email_verified_at' => now('America/La_Paz'),
            ]
        );
        $postulanteUser19->assignRole('ESTUDIANTE');

        Postulante::firstOrCreate(
            ['usuario_id' => $postulanteUser19->id],
            [
                'carrera_primera_id' => $carreraPrimera->id,
                'carrera_segunda_id' => $carreraSegunda->id,
                'nombres' => 'Joaquin',
                'apellidos' => 'Gala',
                'ci' => '6123465',
                'fecha_nacimiento' => '2005-03-18',
                'telefono' => '79990011',
                'direccion' => 'Calle Cochabamba 412',
                'genero' => 'masculino',
                'estado' => 'aprobado',
                'tiene_bachiller' => true,
                'entrego_libreta_notas' => true,
                'entrego_ci' => true,
                'entrego_formulario_preinscripcion' => true,
                'entrego_comprobante_pago' => true,
            ]
        );

        // 20. Postulante Victoria
        $postulanteUser20 = User::firstOrCreate(
            ['email' => 'victoria.rios@example.com'],
            [
                'name' => 'Victoria Rios',
                'password' => Hash::make('Postulante123!'),
                'email_verified_at' => now('America/La_Paz'),
            ]
        );
        $postulanteUser20->assignRole('ESTUDIANTE');

        Postulante::firstOrCreate(
            ['usuario_id' => $postulanteUser20->id],
            [
                'carrera_primera_id' => $carreraPrimera->id,
                'carrera_segunda_id' => $carreraSegunda->id,
                'nombres' => 'Victoria',
                'apellidos' => 'Rios',
                'ci' => '6123466',
                'fecha_nacimiento' => '2004-06-02',
                'telefono' => '70001122',
                'direccion' => 'Av. Ejercito 89',
                'genero' => 'femenino',
                'estado' => 'aprobado',
                'tiene_bachiller' => true,
                'entrego_libreta_notas' => true,
                'entrego_ci' => true,
                'entrego_formulario_preinscripcion' => true,
                'entrego_comprobante_pago' => true,
            ]
        );

        // 21. Postulante Daniel
        $postulanteUser21 = User::firstOrCreate(
            ['email' => 'daniel.medina@example.com'],
            [
                'name' => 'Daniel Medina',
                'password' => Hash::make('Postulante123!'),
                'email_verified_at' => now('America/La_Paz'),
            ]
        );
        $postulanteUser21->assignRole('ESTUDIANTE');

        Postulante::firstOrCreate(
            ['usuario_id' => $postulanteUser21->id],
            [
                'carrera_primera_id' => $carreraPrimera->id,
                'carrera_segunda_id' => $carreraSegunda->id,
                'nombres' => 'Daniel',
                'apellidos' => 'Medina',
                'ci' => '6123467',
                'fecha_nacimiento' => '2005-01-29',
                'telefono' => '71113355',
                'direccion' => 'Calle Aroma 54',
                'genero' => 'masculino',
                'estado' => 'aprobado',
                'tiene_bachiller' => true,
                'entrego_libreta_notas' => true,
                'entrego_ci' => true,
                'entrego_formulario_preinscripcion' => true,
                'entrego_comprobante_pago' => true,
            ]
        );

        // 22. Postulante Mariana
        $postulanteUser22 = User::firstOrCreate(
            ['email' => 'mariana.cruz@example.com'],
            [
                'name' => 'Mariana Cruz',
                'password' => Hash::make('Postulante123!'),
                'email_verified_at' => now('America/La_Paz'),
            ]
        );
        $postulanteUser22->assignRole('ESTUDIANTE');

        Postulante::firstOrCreate(
            ['usuario_id' => $postulanteUser22->id],
            [
                'carrera_primera_id' => $carreraPrimera->id,
                'carrera_segunda_id' => $carreraSegunda->id,
                'nombres' => 'Mariana',
                'apellidos' => 'Cruz',
                'ci' => '6123468',
                'fecha_nacimiento' => '2004-09-24',
                'telefono' => '72224466',
                'direccion' => 'Av. Las Americas 310',
                'genero' => 'femenino',
                'estado' => 'aprobado',
                'tiene_bachiller' => true,
                'entrego_libreta_notas' => true,
                'entrego_ci' => true,
                'entrego_formulario_preinscripcion' => true,
                'entrego_comprobante_pago' => true,
            ]
        );

        // 23. Postulante Nicolas
        $postulanteUser23 = User::firstOrCreate(
            ['email' => 'nicolas.blanco@example.com'],
            [
                'name' => 'Nicolas Blanco',
                'password' => Hash::make('Postulante123!'),
                'email_verified_at' => now('America/La_Paz'),
            ]
        );
        $postulanteUser23->assignRole('ESTUDIANTE');

        Postulante::firstOrCreate(
            ['usuario_id' => $postulanteUser23->id],
            [
                'carrera_primera_id' => $carreraPrimera->id,
                'carrera_segunda_id' => $carreraSegunda->id,
                'nombres' => 'Nicolas',
                'apellidos' => 'Blanco',
                'ci' => '6123469',
                'fecha_nacimiento' => '2005-07-08',
                'telefono' => '73335577',
                'direccion' => 'Calle Inavi 12',
                'genero' => 'masculino',
                'estado' => 'aprobado',
                'tiene_bachiller' => true,
                'entrego_libreta_notas' => true,
                'entrego_ci' => true,
                'entrego_formulario_preinscripcion' => true,
                'entrego_comprobante_pago' => true,
            ]
        );

        // 24. Postulante Sofia
        $postulanteUser24 = User::firstOrCreate(
            ['email' => 'sofia.reyes@example.com'],
            [
                'name' => 'Sofia Reyes',
                'password' => Hash::make('Postulante123!'),
                'email_verified_at' => now('America/La_Paz'),
            ]
        );
        $postulanteUser24->assignRole('ESTUDIANTE');

        Postulante::firstOrCreate(
            ['usuario_id' => $postulanteUser24->id],
            [
                'carrera_primera_id' => $carreraPrimera->id,
                'carrera_segunda_id' => $carreraSegunda->id,
                'nombres' => 'Sofia',
                'apellidos' => 'Reyes',
                'ci' => '6123470',
                'fecha_nacimiento' => '2004-05-15',
                'telefono' => '74446688',
                'direccion' => 'Condominio Sevilla Torres',
                'genero' => 'femenino',
                'estado' => 'aprobado',
                'tiene_bachiller' => true,
                'entrego_libreta_notas' => true,
                'entrego_ci' => true,
                'entrego_formulario_preinscripcion' => true,
                'entrego_comprobante_pago' => true,
            ]
        );

        // 25. Postulante Samuel
        $postulanteUser25 = User::firstOrCreate(
            ['email' => 'samuel.paz@example.com'],
            [
                'name' => 'Samuel Paz',
                'password' => Hash::make('Postulante123!'),
                'email_verified_at' => now('America/La_Paz'),
            ]
        );
        $postulanteUser25->assignRole('ESTUDIANTE');

        Postulante::firstOrCreate(
            ['usuario_id' => $postulanteUser25->id],
            [
                'carrera_primera_id' => $carreraPrimera->id,
                'carrera_segunda_id' => $carreraSegunda->id,
                'nombres' => 'Samuel',
                'apellidos' => 'Paz',
                'ci' => '6123471',
                'fecha_nacimiento' => '2005-11-20',
                'telefono' => '75557799',
                'direccion' => 'Av. Piraí 4to Anillo',
                'genero' => 'masculino',
                'estado' => 'aprobado',
                'tiene_bachiller' => true,
                'entrego_libreta_notas' => true,
                'entrego_ci' => true,
                'entrego_formulario_preinscripcion' => true,
                'entrego_comprobante_pago' => true,
            ]
        );

        // 26. Postulante Andrea
        $postulanteUser26 = User::firstOrCreate(
            ['email' => 'andrea.marquez@example.com'],
            [
                'name' => 'Andrea Marquez',
                'password' => Hash::make('Postulante123!'),
                'email_verified_at' => now('America/La_Paz'),
            ]
        );
        $postulanteUser26->assignRole('ESTUDIANTE');

        Postulante::firstOrCreate(
            ['usuario_id' => $postulanteUser26->id],
            [
                'carrera_primera_id' => $carreraPrimera->id,
                'carrera_segunda_id' => $carreraSegunda->id,
                'nombres' => 'Andrea',
                'apellidos' => 'Marquez',
                'ci' => '6123472',
                'fecha_nacimiento' => '2004-03-14',
                'telefono' => '76668800',
                'direccion' => 'Calle Junín 610',
                'genero' => 'femenino',
                'estado' => 'aprobado',
                'tiene_bachiller' => true,
                'entrego_libreta_notas' => true,
                'entrego_ci' => true,
                'entrego_formulario_preinscripcion' => true,
                'entrego_comprobante_pago' => true,
            ]
        );

        // 27. Postulante Benjamin
        $postulanteUser27 = User::firstOrCreate(
            ['email' => 'benjamin.soliz@example.com'],
            [
                'name' => 'Benjamin Soliz',
                'password' => Hash::make('Postulante123!'),
                'email_verified_at' => now('America/La_Paz'),
            ]
        );
        $postulanteUser27->assignRole('ESTUDIANTE');

        Postulante::firstOrCreate(
            ['usuario_id' => $postulanteUser27->id],
            [
                'carrera_primera_id' => $carreraPrimera->id,
                'carrera_segunda_id' => $carreraSegunda->id,
                'nombres' => 'Benjamin',
                'apellidos' => 'Soliz',
                'ci' => '6123473',
                'fecha_nacimiento' => '2005-04-02',
                'telefono' => '77779911',
                'direccion' => 'Av. Grigota 255',
                'genero' => 'masculino',
                'estado' => 'aprobado',
                'tiene_bachiller' => true,
                'entrego_libreta_notas' => true,
                'entrego_ci' => true,
                'entrego_formulario_preinscripcion' => true,
                'entrego_comprobante_pago' => true,
            ]
        );

        // 28. Postulante Daniela
        $postulanteUser28 = User::firstOrCreate(
            ['email' => 'daniela.miranda@example.com'],
            [
                'name' => 'Daniela Miranda',
                'password' => Hash::make('Postulante123!'),
                'email_verified_at' => now('America/La_Paz'),
            ]
        );
        $postulanteUser28->assignRole('ESTUDIANTE');

        Postulante::firstOrCreate(
            ['usuario_id' => $postulanteUser28->id],
            [
                'carrera_primera_id' => $carreraPrimera->id,
                'carrera_segunda_id' => $carreraSegunda->id,
                'nombres' => 'Daniela',
                'apellidos' => 'Miranda',
                'ci' => '6123474',
                'fecha_nacimiento' => '2004-08-09',
                'telefono' => '78880022',
                'direccion' => 'Calle España 15',
                'genero' => 'femenino',
                'estado' => 'aprobado',
                'tiene_bachiller' => true,
                'entrego_libreta_notas' => true,
                'entrego_ci' => true,
                'entrego_formulario_preinscripcion' => true,
                'entrego_comprobante_pago' => true,
            ]
        );

        // 29. Postulante Lucas
        $postulanteUser29 = User::firstOrCreate(
            ['email' => 'lucas.miranda@example.com'],
            [
                'name' => 'Lucas Miranda',
                'password' => Hash::make('Postulante123!'),
                'email_verified_at' => now('America/La_Paz'),
            ]
        );
        $postulanteUser29->assignRole('ESTUDIANTE');

        Postulante::firstOrCreate(
            ['usuario_id' => $postulanteUser29->id],
            [
                'carrera_primera_id' => $carreraPrimera->id,
                'carrera_segunda_id' => $carreraSegunda->id,
                'nombres' => 'Lucas',
                'apellidos' => 'Miranda',
                'ci' => '6123475',
                'fecha_nacimiento' => '2005-06-17',
                'telefono' => '79991133',
                'direccion' => 'Av. Santos Dumont 5to Anillo',
                'genero' => 'masculino',
                'estado' => 'aprobado',
                'tiene_bachiller' => true,
                'entrego_libreta_notas' => true,
                'entrego_ci' => true,
                'entrego_formulario_preinscripcion' => true,
                'entrego_comprobante_pago' => true,
            ]
        );

        // 30. Postulante Paula
        $postulanteUser30 = User::firstOrCreate(
            ['email' => 'paula.duarte@example.com'],
            [
                'name' => 'Paula Duarte',
                'password' => Hash::make('Postulante123!'),
                'email_verified_at' => now('America/La_Paz'),
            ]
        );
        $postulanteUser30->assignRole('ESTUDIANTE');

        Postulante::firstOrCreate(
            ['usuario_id' => $postulanteUser30->id],
            [
                'carrera_primera_id' => $carreraPrimera->id,
                'carrera_segunda_id' => $carreraSegunda->id,
                'nombres' => 'Paula',
                'apellidos' => 'Duarte',
                'ci' => '6123476',
                'fecha_nacimiento' => '2004-01-22',
                'telefono' => '70002244',
                'direccion' => 'Barrio Linda Vista UV 42',
                'genero' => 'femenino',
                'estado' => 'aprobado',
                'tiene_bachiller' => true,
                'entrego_libreta_notas' => true,
                'entrego_ci' => true,
                'entrego_formulario_preinscripcion' => true,
                'entrego_comprobante_pago' => true,
            ]
        );
        // 31. Postulante Rodrigo
        $postulanteUser31 = User::firstOrCreate(
            ['email' => 'rodrigo.sanchez@example.com'],
            [
                'name' => 'Rodrigo Sanchez',
                'password' => Hash::make('Postulante123!'),
                'email_verified_at' => now('America/La_Paz'),
            ]
        );
        $postulanteUser31->assignRole('ESTUDIANTE');

        Postulante::firstOrCreate(
            ['usuario_id' => $postulanteUser31->id],
            [
                'carrera_primera_id' => $carreraPrimera->id,
                'carrera_segunda_id' => $carreraSegunda->id,
                'nombres' => 'Rodrigo',
                'apellidos' => 'Sanchez',
                'ci' => '6123477',
                'fecha_nacimiento' => '2005-02-11',
                'telefono' => '71114466',
                'direccion' => 'Av. Virgen de Cotoca 3er Anillo',
                'genero' => 'masculino',
                'estado' => 'aprobado',
                'tiene_bachiller' => true,
                'entrego_libreta_notas' => true,
                'entrego_ci' => true,
                'entrego_formulario_preinscripcion' => true,
                'entrego_comprobante_pago' => true,
            ]
        );

        // 32. Postulante Karen
        $postulanteUser32 = User::firstOrCreate(
            ['email' => 'karen.villca@example.com'],
            [
                'name' => 'Karen Villca',
                'password' => Hash::make('Postulante123!'),
                'email_verified_at' => now('America/La_Paz'),
            ]
        );
        $postulanteUser32->assignRole('ESTUDIANTE');

        Postulante::firstOrCreate(
            ['usuario_id' => $postulanteUser32->id],
            [
                'carrera_primera_id' => $carreraPrimera->id,
                'carrera_segunda_id' => $carreraSegunda->id,
                'nombres' => 'Karen',
                'apellidos' => 'Villca',
                'ci' => '6123478',
                'fecha_nacimiento' => '2004-07-26',
                'telefono' => '72225577',
                'direccion' => 'Calle Charcas 85',
                'genero' => 'femenino',
                'estado' => 'aprobado',
                'tiene_bachiller' => true,
                'entrego_libreta_notas' => true,
                'entrego_ci' => true,
                'entrego_formulario_preinscripcion' => true,
                'entrego_comprobante_pago' => true,
            ]
        );

        // 33. Postulante Fernando
        $postulanteUser33 = User::firstOrCreate(
            ['email' => 'fernando.reyes@example.com'],
            [
                'name' => 'Fernando Reyes',
                'password' => Hash::make('Postulante123!'),
                'email_verified_at' => now('America/La_Paz'),
            ]
        );
        $postulanteUser33->assignRole('ESTUDIANTE');

        Postulante::firstOrCreate(
            ['usuario_id' => $postulanteUser33->id],
            [
                'carrera_primera_id' => $carreraPrimera->id,
                'carrera_segunda_id' => $carreraSegunda->id,
                'nombres' => 'Fernando',
                'apellidos' => 'Reyes',
                'ci' => '6123479',
                'fecha_nacimiento' => '2005-10-04',
                'telefono' => '73336688',
                'direccion' => 'Av. Tres Pasos al Frente',
                'genero' => 'masculino',
                'estado' => 'aprobado',
                'tiene_bachiller' => true,
                'entrego_libreta_notas' => true,
                'entrego_ci' => true,
                'entrego_formulario_preinscripcion' => true,
                'entrego_comprobante_pago' => true,
            ]
        );

        // 34. Postulante Claudia
        $postulanteUser34 = User::firstOrCreate(
            ['email' => 'claudia.ortiz@example.com'],
            [
                'name' => 'Claudia Ortiz',
                'password' => Hash::make('Postulante123!'),
                'email_verified_at' => now('America/La_Paz'),
            ]
        );
        $postulanteUser34->assignRole('ESTUDIANTE');

        Postulante::firstOrCreate(
            ['usuario_id' => $postulanteUser34->id],
            [
                'carrera_primera_id' => $carreraPrimera->id,
                'carrera_segunda_id' => $carreraSegunda->id,
                'nombres' => 'Claudia',
                'apellidos' => 'Ortiz',
                'ci' => '6123480',
                'fecha_nacimiento' => '2004-12-14',
                'telefono' => '74447799',
                'direccion' => 'Calle Vallegrande 550',
                'genero' => 'femenino',
                'estado' => 'aprobado',
                'tiene_bachiller' => true,
                'entrego_libreta_notas' => true,
                'entrego_ci' => true,
                'entrego_formulario_preinscripcion' => true,
                'entrego_comprobante_pago' => true,
            ]
        );

        // 35. Postulante Alvaro
        $postulanteUser35 = User::firstOrCreate(
            ['email' => 'alvaro.gutierrez@example.com'],
            [
                'name' => 'Alvaro Gutierrez',
                'password' => Hash::make('Postulante123!'),
                'email_verified_at' => now('America/La_Paz'),
            ]
        );
        $postulanteUser35->assignRole('ESTUDIANTE');

        Postulante::firstOrCreate(
            ['usuario_id' => $postulanteUser35->id],
            [
                'carrera_primera_id' => $carreraPrimera->id,
                'carrera_segunda_id' => $carreraSegunda->id,
                'nombres' => 'Alvaro',
                'apellidos' => 'Gutierrez',
                'ci' => '6123481',
                'fecha_nacimiento' => '2005-06-22',
                'telefono' => '75558800',
                'direccion' => 'Barrio El Trompillo Calle 2',
                'genero' => 'masculino',
                'estado' => 'aprobado',
                'tiene_bachiller' => true,
                'entrego_libreta_notas' => true,
                'entrego_ci' => true,
                'entrego_formulario_preinscripcion' => true,
                'entrego_comprobante_pago' => true,
            ]
        );

        // 36. Postulante Diana
        $postulanteUser36 = User::firstOrCreate(
            ['email' => 'diana.salas@example.com'],
            [
                'name' => 'Diana Salas',
                'password' => Hash::make('Postulante123!'),
                'email_verified_at' => now('America/La_Paz'),
            ]
        );
        $postulanteUser36->assignRole('ESTUDIANTE');

        Postulante::firstOrCreate(
            ['usuario_id' => $postulanteUser36->id],
            [
                'carrera_primera_id' => $carreraPrimera->id,
                'carrera_segunda_id' => $carreraSegunda->id,
                'nombres' => 'Diana',
                'apellidos' => 'Salas',
                'ci' => '6123482',
                'fecha_nacimiento' => '2004-04-17',
                'telefono' => '76669911',
                'direccion' => 'Av. Marcelo Terceros 102',
                'genero' => 'femenino',
                'estado' => 'aprobado',
                'tiene_bachiller' => true,
                'entrego_libreta_notas' => true,
                'entrego_ci' => true,
                'entrego_formulario_preinscripcion' => true,
                'entrego_comprobante_pago' => true,
            ]
        );

        // 37. Postulante Cristian
        $postulanteUser37 = User::firstOrCreate(
            ['email' => 'cristian.vaca@example.com'],
            [
                'name' => 'Cristian Vaca',
                'password' => Hash::make('Postulante123!'),
                'email_verified_at' => now('America/La_Paz'),
            ]
        );
        $postulanteUser37->assignRole('ESTUDIANTE');

        Postulante::firstOrCreate(
            ['usuario_id' => $postulanteUser37->id],
            [
                'carrera_primera_id' => $carreraPrimera->id,
                'carrera_segunda_id' => $carreraSegunda->id,
                'nombres' => 'Cristian',
                'apellidos' => 'Vaca',
                'ci' => '6123483',
                'fecha_nacimiento' => '2005-08-19',
                'telefono' => '77770022',
                'direccion' => 'Calle 24 de Septiembre 410',
                'genero' => 'masculino',
                'estado' => 'aprobado',
                'tiene_bachiller' => true,
                'entrego_libreta_notas' => true,
                'entrego_ci' => true,
                'entrego_formulario_preinscripcion' => true,
                'entrego_comprobante_pago' => true,
            ]
        );

        // 38. Postulante Gabriela
        $postulanteUser38 = User::firstOrCreate(
            ['email' => 'gabriela.paz@example.com'],
            [
                'name' => 'Gabriela Paz',
                'password' => Hash::make('Postulante123!'),
                'email_verified_at' => now('America/La_Paz'),
            ]
        );
        $postulanteUser38->assignRole('ESTUDIANTE');

        Postulante::firstOrCreate(
            ['usuario_id' => $postulanteUser38->id],
            [
                'carrera_primera_id' => $carreraPrimera->id,
                'carrera_segunda_id' => $carreraSegunda->id,
                'nombres' => 'Gabriela',
                'apellidos' => 'Paz',
                'ci' => '6123484',
                'fecha_nacimiento' => '2004-03-09',
                'telefono' => '78881133',
                'direccion' => 'Av. Cristo Redentor Km 8',
                'genero' => 'femenino',
                'estado' => 'aprobado',
                'tiene_bachiller' => true,
                'entrego_libreta_notas' => true,
                'entrego_ci' => true,
                'entrego_formulario_preinscripcion' => true,
                'entrego_comprobante_pago' => true,
            ]
        );

        // 39. Postulante Ricardo
        $postulanteUser39 = User::firstOrCreate(
            ['email' => 'ricardo.brito@example.com'],
            [
                'name' => 'Ricardo Brito',
                'password' => Hash::make('Postulante123!'),
                'email_verified_at' => now('America/La_Paz'),
            ]
        );
        $postulanteUser39->assignRole('ESTUDIANTE');

        Postulante::firstOrCreate(
            ['usuario_id' => $postulanteUser39->id],
            [
                'carrera_primera_id' => $carreraPrimera->id,
                'carrera_segunda_id' => $carreraSegunda->id,
                'nombres' => 'Ricardo',
                'apellidos' => 'Brito',
                'ci' => '6123485',
                'fecha_nacimiento' => '2005-01-05',
                'telefono' => '79992244',
                'direccion' => 'Av. Centenario Calle Pasaje',
                'genero' => 'masculino',
                'estado' => 'aprobado',
                'tiene_bachiller' => true,
                'entrego_libreta_notas' => true,
                'entrego_ci' => true,
                'entrego_formulario_preinscripcion' => true,
                'entrego_comprobante_pago' => true,
            ]
        );

        // 40. Postulante Vanessa
        $postulanteUser40 = User::firstOrCreate(
            ['email' => 'vanessa.moron@example.com'],
            [
                'name' => 'Vanessa Moron',
                'password' => Hash::make('Postulante123!'),
                'email_verified_at' => now('America/La_Paz'),
            ]
        );
        $postulanteUser40->assignRole('ESTUDIANTE');

        Postulante::firstOrCreate(
            ['usuario_id' => $postulanteUser40->id],
            [
                'carrera_primera_id' => $carreraPrimera->id,
                'carrera_segunda_id' => $carreraSegunda->id,
                'nombres' => 'Vanessa',
                'apellidos' => 'Moron',
                'ci' => '6123486',
                'fecha_nacimiento' => '2004-11-28',
                'telefono' => '70003355',
                'direccion' => 'Calle Seoane 220',
                'genero' => 'femenino',
                'estado' => 'aprobado',
                'tiene_bachiller' => true,
                'entrego_libreta_notas' => true,
                'entrego_ci' => true,
                'entrego_formulario_preinscripcion' => true,
                'entrego_comprobante_pago' => true,
            ]
        );

        // 41. Postulante Hugo
        $postulanteUser41 = User::firstOrCreate(
            ['email' => 'hugo.chavez@example.com'],
            [
                'name' => 'Hugo Chavez',
                'password' => Hash::make('Postulante123!'),
                'email_verified_at' => now('America/La_Paz'),
            ]
        );
        $postulanteUser41->assignRole('ESTUDIANTE');

        Postulante::firstOrCreate(
            ['usuario_id' => $postulanteUser41->id],
            [
                'carrera_primera_id' => $carreraPrimera->id,
                'carrera_segunda_id' => $carreraSegunda->id,
                'nombres' => 'Hugo',
                'apellidos' => 'Chavez',
                'ci' => '6123487',
                'fecha_nacimiento' => '2005-04-30',
                'telefono' => '71115577',
                'direccion' => 'Av. Roque Aguilera 540',
                'genero' => 'masculino',
                'estado' => 'aprobado',
                'tiene_bachiller' => true,
                'entrego_libreta_notas' => true,
                'entrego_ci' => true,
                'entrego_formulario_preinscripcion' => true,
                'entrego_comprobante_pago' => true,
            ]
        );

        // 42. Postulante Tatiana
        $postulanteUser42 = User::firstOrCreate(
            ['email' => 'tatiana.suarez@example.com'],
            [
                'name' => 'Tatiana Suarez',
                'password' => Hash::make('Postulante123!'),
                'email_verified_at' => now('America/La_Paz'),
            ]
        );
        $postulanteUser42->assignRole('ESTUDIANTE');

        Postulante::firstOrCreate(
            ['usuario_id' => $postulanteUser42->id],
            [
                'carrera_primera_id' => $carreraPrimera->id,
                'carrera_segunda_id' => $carreraSegunda->id,
                'nombres' => 'Tatiana',
                'apellidos' => 'Suarez',
                'ci' => '6123488',
                'fecha_nacimiento' => '2004-06-15',
                'telefono' => '72226688',
                'direccion' => 'Barrio Urbarí Calle Codoniz',
                'genero' => 'femenino',
                'estado' => 'aprobado',
                'tiene_bachiller' => true,
                'entrego_libreta_notas' => true,
                'entrego_ci' => true,
                'entrego_formulario_preinscripcion' => true,
                'entrego_comprobante_pago' => true,
            ]
        );

        // 43. Postulante Leonardo
        $postulanteUser43 = User::firstOrCreate(
            ['email' => 'leonardo.arce@example.com'],
            [
                'name' => 'Leonardo Arce',
                'password' => Hash::make('Postulante123!'),
                'email_verified_at' => now('America/La_Paz'),
            ]
        );
        $postulanteUser43->assignRole('ESTUDIANTE');

        Postulante::firstOrCreate(
            ['usuario_id' => $postulanteUser43->id],
            [
                'carrera_primera_id' => $carreraPrimera->id,
                'carrera_segunda_id' => $carreraSegunda->id,
                'nombres' => 'Leonardo',
                'apellidos' => 'Arce',
                'ci' => '6123489',
                'fecha_nacimiento' => '2005-09-03',
                'telefono' => '73337799',
                'direccion' => 'Av. Bush Calle Nicaragua',
                'genero' => 'masculino',
                'estado' => 'aprobado',
                'tiene_bachiller' => true,
                'entrego_libreta_notas' => true,
                'entrego_ci' => true,
                'entrego_formulario_preinscripcion' => true,
                'entrego_comprobante_pago' => true,
            ]
        );

        // 44. Postulante Paola
        $postulanteUser44 = User::firstOrCreate(
            ['email' => 'paola.justiniano@example.com'],
            [
                'name' => 'Paola Justiniano',
                'password' => Hash::make('Postulante123!'),
                'email_verified_at' => now('America/La_Paz'),
            ]
        );
        $postulanteUser44->assignRole('ESTUDIANTE');

        Postulante::firstOrCreate(
            ['usuario_id' => $postulanteUser44->id],
            [
                'carrera_primera_id' => $carreraPrimera->id,
                'carrera_segunda_id' => $carreraSegunda->id,
                'nombres' => 'Paola',
                'apellidos' => 'Justiniano',
                'ci' => '6123490',
                'fecha_nacimiento' => '2004-05-20',
                'telefono' => '74448800',
                'direccion' => 'Calle Isabel La Catolica 33',
                'genero' => 'femenino',
                'estado' => 'aprobado',
                'tiene_bachiller' => true,
                'entrego_libreta_notas' => true,
                'entrego_ci' => true,
                'entrego_formulario_preinscripcion' => true,
                'entrego_comprobante_pago' => true,
            ]
        );

        // 45. Postulante Eduardo
        $postulanteUser45 = User::firstOrCreate(
            ['email' => 'eduardo.mendez@example.com'],
            [
                'name' => 'Eduardo Mendez',
                'password' => Hash::make('Postulante123!'),
                'email_verified_at' => now('America/La_Paz'),
            ]
        );
        $postulanteUser45->assignRole('ESTUDIANTE');

        Postulante::firstOrCreate(
            ['usuario_id' => $postulanteUser45->id],
            [
                'carrera_primera_id' => $carreraPrimera->id,
                'carrera_segunda_id' => $carreraSegunda->id,
                'nombres' => 'Eduardo',
                'apellidos' => 'Mendez',
                'ci' => '6123491',
                'fecha_nacimiento' => '2005-07-11',
                'telefono' => '75559911',
                'direccion' => 'Calle Moldes 450',
                'genero' => 'masculino',
                'estado' => 'aprobado',
                'tiene_bachiller' => true,
                'entrego_libreta_notas' => true,
                'entrego_ci' => true,
                'entrego_formulario_preinscripcion' => true,
                'entrego_comprobante_pago' => true,
            ]
        );

        // ==========================================
        // 4 POSTULANTES ADICIONALES (140 al 143)
        // ==========================================

        $ultimosPostulantes = [
            ['nombres' => 'Alan', 'apellidos' => 'Bustamante', 'genero' => 'masculino', 'nacimiento' => '2005-05-14'],
            ['nombres' => 'Bianca', 'apellidos' => 'Villarroel', 'genero' => 'femenino', 'nacimiento' => '2004-10-20'],
            ['nombres' => 'Camilo', 'apellidos' => 'Hinojosa', 'genero' => 'masculino', 'nacimiento' => '2005-02-11'],
            ['nombres' => 'Danna', 'apellidos' => 'Añez', 'genero' => 'femenino', 'nacimiento' => '2004-08-07'],
        ];

        // Bases correlativas ajustadas para evitar duplicados
        $ciBaseUltima = 6123586; 
        $telBaseUltima = 71110300;

        foreach ($ultimosPostulantes as $index => $datos) {
            $slug = Str::slug($datos['nombres'] . '.' . $datos['apellidos']);
            $uniqueEmail = $slug . '.' . ($index + 140) . '@example.com';
            
            $user = User::firstOrCreate(
                ['email' => $uniqueEmail],
                [
                    'name' => $datos['nombres'] . ' ' . $datos['apellidos'],
                    'password' => Hash::make('Postulante123!'),
                    'email_verified_at' => now('America/La_Paz'),
                ]
            );
            $user->assignRole('ESTUDIANTE');

            Postulante::firstOrCreate(
                ['usuario_id' => $user->id],
                [
                    'carrera_primera_id' => $carreraPrimera->id,
                    'carrera_segunda_id' => $carreraSegunda->id,
                    'nombres' => $datos['nombres'],
                    'apellidos' => $datos['apellidos'],
                    'ci' => (string)($ciBaseUltima + $index),
                    'fecha_nacimiento' => $datos['nacimiento'],
                    'telefono' => (string)($telBaseUltima + $index),
                    'direccion' => 'Av. San Aurelio Calle ' . ($index + 95),
                    'genero' => $datos['genero'],
                    'estado' => 'aprobado',
                    'tiene_bachiller' => true,
                    'entrego_libreta_notas' => true,
                    'entrego_ci' => true,
                    'entrego_formulario_preinscripcion' => true,
                    'entrego_comprobante_pago' => true,
                ]
            );
        }
    }
}
