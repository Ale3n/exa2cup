<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('postulantes', function (Blueprint $table) {
            $table->id();

            // Relación con usuarios
            $table->foreignId('usuario_id')
                  ->constrained('users')
                  ->cascadeOnDelete();

            // Primera y segunda opción de carrera
            $table->foreignId('carrera_primera_id')
                  ->constrained('carreras')
                  ->restrictOnDelete();

            $table->foreignId('carrera_segunda_id')
                  ->nullable()
                  ->constrained('carreras')
                  ->nullOnDelete();

            // Datos personales
            $table->string('nombres');
            $table->string('apellidos');
            $table->string('ci', 20)->unique();

            $table->date('fecha_nacimiento');

            $table->string('telefono', 20)->nullable();
            $table->string('direccion')->nullable();

            // Género
            $table->enum('genero', [
                'masculino',
                'femenino',
                'otro'
            ]);

            // Estado del postulante
            $table->enum('estado', [
                'pendiente',
                'aprobado',
                'rechazado'
            ])->default('pendiente');

            // Documentación entregada
            $table->boolean('tiene_bachiller')->default(false);

            $table->boolean('entrego_libreta_notas')
                  ->default(false);

            $table->boolean('entrego_ci')
                  ->default(false);

            $table->boolean('entrego_formulario_preinscripcion')
                  ->default(false);

            $table->boolean('entrego_comprobante_pago')
                  ->default(false);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('postulantes');
    }
};
