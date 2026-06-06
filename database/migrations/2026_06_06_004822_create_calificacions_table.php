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
        Schema::create('calificacions', function (Blueprint $table) {
            $table->id();

            $table->foreignId('inscripcion_grupo_id')
                  ->constrained('inscripcion_grupos')
                  ->cascadeOnDelete();

            $table->foreignId('materia_id')
                  ->constrained('materias')
                  ->cascadeOnDelete();

            $table->smallInteger('numero_examen');

            $table->decimal('nota', 5, 2);

            $table->timestamps();

            // Evita registrar dos veces la misma nota
            $table->unique([
                'inscripcion_grupo_id',
                'materia_id',
                'numero_examen'
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('calificacions');
    }
};
