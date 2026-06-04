<?php

namespace Database\Seeders;

use App\Models\User;
use Database\Seeders\RoleSeeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RoleSeeder::class);

        // User::factory(10)->create();

        $admin = User::firstOrCreate(
            ['email' => 'dylancossioaguilera@gmail.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('12345678Aa'),
                'email_verified_at' => now('America/La_Paz'),
            ]
        );

        $admin->assignRole('ADMINISTRADOR');
    }
}
