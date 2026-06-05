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
        Schema::create('grupo_materias', function (Blueprint $table) {
             $table->id();
            $table->foreignId('grupo_id')
                ->constrained('grupos')
                ->onDelete('cascade');

            $table->foreignId('materia_id')
                ->constrained('materias')
                ->onDelete('cascade');

            $table->foreignId('personal_id')
                ->constrained('personals')
                ->onDelete('cascade');

            $table->foreignId('aula_id')
                ->constrained('aulas')
                ->onDelete('cascade');

            // HORARIOS
            $table->time('hora_inicio');
            $table->time('hora_fin');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grupo_materias');
    }
};
