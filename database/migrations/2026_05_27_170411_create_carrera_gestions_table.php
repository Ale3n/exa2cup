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
        Schema::create('carrera_gestions', function (Blueprint $table) {
            $table->id();

            $table->foreignId('carrera_id')
                  ->constrained('carreras')
                  ->restrictOnDelete();

            $table->foreignId('gestion_id')
                  ->constrained('gestions')
                  ->restrictOnDelete();

            $table->integer('cupo_maximo');
            $table->integer('admitidos')->default(0);

            $table->timestamps();

            $table->unique(['carrera_id', 'gestion_id']); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carrera_gestions');
    }
};
