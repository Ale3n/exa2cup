<?php

namespace Database\Seeders;

use App\Models\User;
use Database\Seeders\RoleSeeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Carrera;
use App\Models\Gestion;
use App\Models\Materia;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RoleSeeder::class);
        $this->call(Primerafila::class);
        $this->call(Primfildocente::class);
        $this->call(Primfilpostu::class);
        //$this->call(Primfilpostu2::class);
        $this->call(GrupoMateriaSeeder::class);
        $this->call(Segundafila::class);
        $this->call(Caliseed::class);
        // User::factory(10)->create();

        
            






    }
}
