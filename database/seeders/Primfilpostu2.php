<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\Carrera;
use App\Models\Postulante;
use App\Models\User;

class Primfilpostu2 extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // ==========================================
        // 46 POSTULANTES ADICIONALES (46 al 91)
        // ==========================================

        $nuevosPostulantes = [
            ['nombres' => 'Manuel', 'apellidos' => 'Sánchez', 'genero' => 'masculino', 'nacimiento' => '2005-01-12'],
            ['nombres' => 'Gabriela', 'apellidos' => 'Flores', 'genero' => 'femenino', 'nacimiento' => '2004-10-19'],
            ['nombres' => 'Héctor', 'apellidos' => 'Suárez', 'genero' => 'masculino', 'nacimiento' => '2005-08-01'],
            ['nombres' => 'Adriana', 'apellidos' => 'Guzmán', 'genero' => 'femenino', 'nacimiento' => '2004-12-30'],
            ['nombres' => 'Javier', 'apellidos' => 'Pinto', 'genero' => 'masculino', 'nacimiento' => '2005-02-14'],
            ['nombres' => 'Isabela', 'apellidos' => 'Méndez', 'genero' => 'femenino', 'nacimiento' => '2004-07-05'],
            ['nombres' => 'Andrés', 'apellidos' => 'Sosa', 'genero' => 'masculino', 'nacimiento' => '2005-09-21'],
            ['nombres' => 'Mariel', 'apellidos' => 'Chávez', 'genero' => 'femenino', 'nacimiento' => '2004-11-11'],
            ['nombres' => 'Ricardo', 'apellidos' => 'Gala', 'genero' => 'masculino', 'nacimiento' => '2005-03-18'],
            ['nombres' => 'Fernanda', 'apellidos' => 'Ríos', 'genero' => 'femenino', 'nacimiento' => '2004-06-02'],
            ['nombres' => 'Gustavo', 'apellidos' => 'Medina', 'genero' => 'masculino', 'nacimiento' => '2005-01-29'],
            ['nombres' => 'Paulina', 'apellidos' => 'Cruz', 'genero' => 'femenino', 'nacimiento' => '2004-09-24'],
            ['nombres' => 'Marcos', 'apellidos' => 'Blanco', 'genero' => 'masculino', 'nacimiento' => '2005-07-08'],
            ['nombres' => 'Fabiana', 'apellidos' => 'Reyes', 'genero' => 'femenino', 'nacimiento' => '2004-05-15'],
            ['nombres' => 'Josué', 'apellidos' => 'Paz', 'genero' => 'masculino', 'nacimiento' => '2005-11-20'],
            ['nombres' => 'Camila', 'apellidos' => 'Márquez', 'genero' => 'femenino', 'nacimiento' => '2004-03-14'],
            ['nombres' => 'Esteban', 'apellidos' => 'Soliz', 'genero' => 'masculino', 'nacimiento' => '2005-04-02'],
            ['nombres' => 'Juliana', 'apellidos' => 'Miranda', 'genero' => 'femenino', 'nacimiento' => '2004-08-09'],
            ['nombres' => 'Mauricio', 'apellidos' => 'Vargas', 'genero' => 'masculino', 'nacimiento' => '2005-06-17'],
            ['nombres' => 'Lucía', 'apellidos' => 'Duarte', 'genero' => 'femenino', 'nacimiento' => '2004-01-22'],
            ['nombres' => 'René', 'apellidos' => 'Rojas', 'genero' => 'masculino', 'nacimiento' => '2005-02-11'],
            ['nombres' => 'Melany', 'apellidos' => 'Villca', 'genero' => 'femenino', 'nacimiento' => '2004-07-26'],
            ['nombres' => 'Pablo', 'apellidos' => 'Arias', 'genero' => 'masculino', 'nacimiento' => '2005-10-04'],
            ['nombres' => 'Regina', 'apellidos' => 'Ortiz', 'genero' => 'femenino', 'nacimiento' => '2004-12-14'],
            ['nombres' => 'Saúl', 'apellidos' => 'Gutiérrez', 'genero' => 'masculino', 'nacimiento' => '2005-06-22'],
            ['nombres' => 'Ximena', 'apellidos' => 'Salas', 'genero' => 'femenino', 'nacimiento' => '2004-04-17'],
            ['nombres' => 'Víctor', 'apellidos' => 'Vaca', 'genero' => 'masculino', 'nacimiento' => '2005-08-19'],
            ['nombres' => 'Zulma', 'apellidos' => 'Paz', 'genero' => 'femenino', 'nacimiento' => '2004-03-09'],
            ['nombres' => 'Álvaro', 'apellidos' => 'Brito', 'genero' => 'masculino', 'nacimiento' => '2005-01-05'],
            ['nombres' => 'Beatriz', 'apellidos' => 'Morón', 'genero' => 'femenino', 'nacimiento' => '2004-11-28'],
            ['nombres' => 'César', 'apellidos' => 'Castillo', 'genero' => 'masculino', 'nacimiento' => '2005-04-30'],
            ['nombres' => 'Denise', 'apellidos' => 'Suárez', 'genero' => 'femenino', 'nacimiento' => '2004-06-15'],
            ['nombres' => 'Emilio', 'apellidos' => 'Arce', 'genero' => 'masculino', 'nacimiento' => '2005-09-03'],
            ['nombres' => 'Flavia', 'apellidos' => 'Justiniano', 'genero' => 'femenino', 'nacimiento' => '2004-05-20'],
            ['nombres' => 'Gerardo', 'apellidos' => 'Méndez', 'genero' => 'masculino', 'nacimiento' => '2005-07-11'],
            ['nombres' => 'Helena', 'apellidos' => 'Siles', 'genero' => 'femenino', 'nacimiento' => '2004-02-18'],
            ['nombres' => 'Iván', 'apellidos' => 'Terceros', 'genero' => 'masculino', 'nacimiento' => '2005-10-25'],
            ['nombres' => 'Jessica', 'apellidos' => 'Paredes', 'genero' => 'femenino', 'nacimiento' => '2004-08-14'],
            ['nombres' => 'Kevin', 'apellidos' => 'Torrico', 'genero' => 'masculino', 'nacimiento' => '2005-05-07'],
            ['nombres' => 'Liliana', 'apellidos' => 'Zeballos', 'genero' => 'femenino', 'nacimiento' => '2004-12-01'],
            ['nombres' => 'Mario', 'apellidos' => 'Camacho', 'genero' => 'masculino', 'nacimiento' => '2005-03-23'],
            ['nombres' => 'Noemí', 'apellidos' => 'Agreda', 'genero' => 'femenino', 'nacimiento' => '2004-07-12'],
            ['nombres' => 'Orlando', 'apellidos' => 'López', 'genero' => 'masculino', 'nacimiento' => '2005-11-02'],
            ['nombres' => 'Patricia', 'apellidos' => 'Hurtado', 'genero' => 'femenino', 'nacimiento' => '2004-09-09'],
            ['nombres' => 'Quentin', 'apellidos' => 'Beltrán', 'genero' => 'masculino', 'nacimiento' => '2005-01-31'],
            ['nombres' => 'Roxana', 'apellidos' => 'Antequera', 'genero' => 'femenino', 'nacimiento' => '2004-04-22'],
        ];

        // CI inicial correlativo para continuar tu lista previa sin chocar
        $ciBase = 6123492;
        $telBase = 71110000;

        $carreraPrimera = Carrera::where('codigo', '187-4')->first();
        $carreraSegunda = Carrera::where('codigo', '187-3')->first();

        foreach ($nuevosPostulantes as $index => $datos) {
            $slug = Str::slug($datos['nombres'] . '.' . $datos['apellidos']);
            $uniqueEmail = $slug . '.' . ($index + 46) . '@example.com';

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
                    'ci' => (string)($ciBase + $index),
                    'fecha_nacimiento' => $datos['nacimiento'],
                    'telefono' => (string)($telBase + $index),
                    'direccion' => 'Av. Urbanización Nueva Calle ' . ($index + 1),
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


        // ==========================================
        // 48 POSTULANTES ADICIONALES (92 al 139)
        // ==========================================

        /*
        $masPostulantes = [
            ['nombres' => 'Adolfo', 'apellidos' => 'Quiroga', 'genero' => 'masculino', 'nacimiento' => '2005-03-14'],
            ['nombres' => 'Bárbara', 'apellidos' => 'Salvatierra', 'genero' => 'femenino', 'nacimiento' => '2004-11-22'],
            ['nombres' => 'Claudio', 'apellidos' => 'Paredes', 'genero' => 'masculino', 'nacimiento' => '2005-06-05'],
            ['nombres' => 'Dora', 'apellidos' => 'Montaño', 'genero' => 'femenino', 'nacimiento' => '2004-08-19'],
            ['nombres' => 'Enrique', 'apellidos' => 'Prado', 'genero' => 'masculino', 'nacimiento' => '2005-02-27'],
            ['nombres' => 'Fabiola', 'apellidos' => 'Morales', 'genero' => 'femenino', 'nacimiento' => '2004-12-05'],
            ['nombres' => 'Gonzalo', 'apellidos' => 'Céspedes', 'genero' => 'masculino', 'nacimiento' => '2005-09-11'],
            ['nombres' => 'Hilda', 'apellidos' => 'Gutiérrez', 'genero' => 'femenino', 'nacimiento' => '2004-05-14'],
            ['nombres' => 'Ignacio', 'apellidos' => 'Rojas', 'genero' => 'masculino', 'nacimiento' => '2005-01-20'],
            ['nombres' => 'Juana', 'apellidos' => 'Guzmán', 'genero' => 'femenino', 'nacimiento' => '2004-07-08'],
            ['nombres' => 'Kristian', 'apellidos' => 'Terceros', 'genero' => 'masculino', 'nacimiento' => '2005-10-31'],
            ['nombres' => 'Liliana', 'apellidos' => 'Hurtado', 'genero' => 'femenino', 'nacimiento' => '2004-03-16'],
            ['nombres' => 'Mauricio', 'apellidos' => 'Camacho', 'genero' => 'masculino', 'nacimiento' => '2005-04-24'],
            ['nombres' => 'Norma', 'apellidos' => 'Vargas', 'genero' => 'femenino', 'nacimiento' => '2004-09-02'],
            ['nombres' => 'Omar', 'apellidos' => 'Mendoza', 'genero' => 'masculino', 'nacimiento' => '2005-11-18'],
            ['nombres' => 'Patricia', 'apellidos' => 'Alba', 'genero' => 'femenino', 'nacimiento' => '2004-02-12'],
            ['nombres' => 'Ramiro', 'apellidos' => 'Arias', 'genero' => 'masculino', 'nacimiento' => '2005-08-29'],
            ['nombres' => 'Silvia', 'apellidos' => 'Ortiz', 'genero' => 'femenino', 'nacimiento' => '2004-06-25'],
            ['nombres' => 'Tomás', 'apellidos' => 'Sosa', 'genero' => 'masculino', 'nacimiento' => '2005-05-03'],
            ['nombres' => 'Úrsula', 'apellidos' => 'Flores', 'genero' => 'femenino', 'nacimiento' => '2004-10-14'],
            ['nombres' => 'Vicente', 'apellidos' => 'Sánchez', 'genero' => 'masculino', 'nacimiento' => '2005-07-21'],
            ['nombres' => 'Wendy', 'apellidos' => 'Chávez', 'genero' => 'femenino', 'nacimiento' => '2004-01-09'],
            ['nombres' => 'Xavier', 'apellidos' => 'Suárez', 'genero' => 'masculino', 'nacimiento' => '2005-12-11'],
            ['nombres' => 'Yolanda', 'apellidos' => 'Villca', 'genero' => 'femenino', 'nacimiento' => '2004-04-26'],
            ['nombres' => 'Zacarías', 'apellidos' => 'Pinto', 'genero' => 'masculino', 'nacimiento' => '2005-03-30'],
            ['nombres' => 'Alicia', 'apellidos' => 'Márquez', 'genero' => 'femenino', 'nacimiento' => '2004-08-01'],
            ['nombres' => 'Bruno', 'apellidos' => 'Soliz', 'genero' => 'masculino', 'nacimiento' => '2005-06-15'],
            ['nombres' => 'Cecilia', 'apellidos' => 'Miranda', 'genero' => 'femenino', 'nacimiento' => '2004-11-04'],
            ['nombres' => 'Diego', 'apellidos' => 'Duarte', 'genero' => 'masculino', 'nacimiento' => '2005-02-09'],
            ['nombres' => 'Elena', 'apellidos' => 'Brito', 'genero' => 'femenino', 'nacimiento' => '2004-09-27'],
            ['nombres' => 'Felipe', 'apellidos' => 'Morón', 'genero' => 'masculino', 'nacimiento' => '2005-01-15'],
            ['nombres' => 'Gloria', 'apellidos' => 'Castillo', 'genero' => 'femenino', 'nacimiento' => '2004-05-19'],
            ['nombres' => 'Hugo', 'apellidos' => 'Justiniano', 'genero' => 'masculino', 'nacimiento' => '2005-10-07'],
            ['nombres' => 'Irene', 'apellidos' => 'Méndez', 'genero' => 'femenino', 'nacimiento' => '2004-12-14'],
            ['nombres' => 'Jaime', 'apellidos' => 'Siles', 'genero' => 'masculino', 'nacimiento' => '2005-04-22'],
            ['nombres' => 'Karla', 'apellidos' => 'Paredes', 'genero' => 'femenino', 'nacimiento' => '2004-07-11'],
            ['nombres' => 'Lucas', 'apellidos' => 'Torrico', 'genero' => 'masculino', 'nacimiento' => '2005-09-05'],
            ['nombres' => 'Martha', 'apellidos' => 'Zeballos', 'genero' => 'femenino', 'nacimiento' => '2004-03-18'],
            ['nombres' => 'Néstor', 'apellidos' => 'Agreda', 'genero' => 'masculino', 'nacimiento' => '2005-11-24'],
            ['nombres' => 'Olga', 'apellidos' => 'López', 'genero' => 'femenino', 'nacimiento' => '2004-06-02'],
            ['nombres' => 'Pedro', 'apellidos' => 'Antequera', 'genero' => 'masculino', 'nacimiento' => '2005-01-02'],
            ['nombres' => 'Raquel', 'apellidos' => 'Beltrán', 'genero' => 'femenino', 'nacimiento' => '2004-08-30'],
            ['nombres' => 'Simón', 'apellidos' => 'Vaca', 'genero' => 'masculino', 'nacimiento' => '2005-05-25'],
            ['nombres' => 'Teresa', 'apellidos' => 'Paz', 'genero' => 'femenino', 'nacimiento' => '2004-10-12'],
            ['nombres' => 'Uriel', 'apellidos' => 'Salas', 'genero' => 'masculino', 'nacimiento' => '2005-07-04'],
            ['nombres' => 'Valeria', 'apellidos' => 'Flores', 'genero' => 'femenino', 'nacimiento' => '2004-04-08'],
            ['nombres' => 'Walter', 'apellidos' => 'Suárez', 'genero' => 'masculino', 'nacimiento' => '2005-03-19'],
            ['nombres' => 'Zoe', 'apellidos' => 'Guzmán', 'genero' => 'femenino', 'nacimiento' => '2004-12-28'],
        ];

        // CI y teléfono base actualizados correlativamente para no colisionar con tus seeders previos
        $ciBaseNueva = 6123538;
        $telBaseNueva = 71110200;

        foreach ($masPostulantes as $index => $datos) {
            $slug = Str::slug($datos['nombres'] . '.' . $datos['apellidos']);
            $uniqueEmail = $slug . '.' . ($index + 92) . '@example.com';

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
                    'ci' => (string)($ciBaseNueva + $index),
                    'fecha_nacimiento' => $datos['nacimiento'],
                    'telefono' => (string)($telBaseNueva + $index),
                    'direccion' => 'Av. Urbanización Central Calle ' . ($index + 47),
                    'genero' => $datos['genero'],
                    'estado' => 'aprobado',
                    'tiene_bachiller' => true,
                    'entrego_libreta_notas' => true,
                    'entrego_ci' => true,
                    'entrego_formulario_preinscripcion' => true,
                    'entrego_comprobante_pago' => true,
                ]
            );
        }*/
    }
}
