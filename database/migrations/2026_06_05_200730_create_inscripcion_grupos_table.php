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
        Schema::create('inscripcion_grupos', function (Blueprint $table) {
             $table->id();

            $table->foreignId('postulante_id')
                ->constrained('postulantes')
                ->cascadeOnDelete();

            $table->foreignId('grupo_id')
                ->constrained('grupos')
                ->cascadeOnDelete();

            $table->date('fecha_eleccion');

            $table->timestamps();

            // Evita que un postulante se inscriba dos veces al mismo grupo
            $table->unique(['postulante_id', 'grupo_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inscripcion_grupos');
    }
};
