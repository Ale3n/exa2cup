<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('grupos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('gestion_id')
                  ->constrained('gestions')
                  ->restrictOnDelete();
            $table->string('codigo', 10)->unique();
            $table->string('dias', 20)->default('Lunes a Viernes');
            $table->string('modalidad', 20)->default('presencial');
            $table->unsignedSmallInteger('inscritos')->default(0);
            $table->timestamps();
        });

        DB::statement("ALTER TABLE grupos ADD CONSTRAINT chk_modalidad 
                       CHECK (modalidad IN ('presencial', 'virtual'))");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grupos');
    }
};
