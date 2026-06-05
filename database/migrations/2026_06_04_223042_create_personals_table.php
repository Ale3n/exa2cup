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
        Schema::create('personals', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->unique()
                ->constrained('users')
                ->onDelete('cascade');

            $table->enum('tipo', ['docente', 'administrativo']);

            $table->string('nombres');
            $table->string('apellidos');
            $table->string('ci')->unique();

            $table->date('fecha_nacimiento');

            $table->string('telefono');
            $table->string('direccion');
            $table->string('profesion');

            $table->boolean('es_profesional_area')->default(false);
            $table->boolean('tiene_maestria')->default(false);
            $table->boolean('tiene_diplomado_educ_superior')->default(false);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personals');
    }
};
