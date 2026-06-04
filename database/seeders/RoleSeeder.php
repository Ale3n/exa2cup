<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $admin = Role::firstOrCreate(['name' => 'ADMINISTRADOR']);
        $administrativo = Role::firstOrCreate(['name' => 'ADMINISTRATIVO']);
        $docente = Role::firstOrCreate(['name' => 'DOCENTE']);
        $estudiante = Role::firstOrCreate(['name' => 'ESTUDIANTE']);

        Permission::whereIn('name', [
            'admin.carreragestiones.index',
            'admin.carreragestiones.store',
            'admin.carreragestiones.update',
            'admin.carreragestiones.destroy',
        ])->delete();

        // --- PERMISOS PARA CARRERAS CRUD---
        Permission::firstOrCreate(['name' => 'admin.carreras.index'])->syncRoles($admin);
        Permission::firstOrCreate(['name' => 'admin.carreras.create'])->syncRoles($admin);
        Permission::firstOrCreate(['name' => 'admin.carreras.update'])->syncRoles($admin);
        Permission::firstOrCreate(['name' => 'admin.carreras.destroy'])->syncRoles($admin);


        // --- PERMISOS PARA ROLES CRUD---
        Permission::firstOrCreate(['name' => 'admin.roles.index'])->syncRoles($admin);
        Permission::firstOrCreate(['name' => 'admin.roles.create'])->syncRoles($admin);
        Permission::firstOrCreate(['name' => 'admin.roles.store'])->syncRoles($admin);
        Permission::firstOrCreate(['name' => 'admin.roles.edit'])->syncRoles($admin);
        Permission::firstOrCreate(['name' => 'admin.roles.update'])->syncRoles($admin);
        Permission::firstOrCreate(['name' => 'admin.roles.destroy'])->syncRoles($admin);
        Permission::firstOrCreate(['name' => 'admin.roles.permisos'])->syncRoles($admin);
        Permission::firstOrCreate(['name' => 'admin.roles.update_permisos'])->syncRoles($admin);

        // --- PERMISOS PARA POSTULANTES CRUD---
        Permission::firstOrCreate(['name' => 'admin.postulantes.index'])->syncRoles($admin);
        Permission::firstOrCreate(['name' => 'admin.postulantes.create'])->syncRoles($admin);
        Permission::firstOrCreate(['name' => 'admin.postulantes.store'])->syncRoles($admin);
        Permission::firstOrCreate(['name' => 'admin.postulantes.show'])->syncRoles($admin);
        Permission::firstOrCreate(['name' => 'admin.postulantes.edit'])->syncRoles($admin);
        Permission::firstOrCreate(['name' => 'admin.postulantes.update'])->syncRoles($admin);
        Permission::firstOrCreate(['name' => 'admin.postulantes.destroy'])->syncRoles($admin);

          // --- PERMISOS PARA ESTUDIANTES CRUD---
        //Permission::firstOrCreate(['name' => 'admin.estudiantes.index'])->syncRoles($admin);
        //Permission::firstOrCreate(['name' => 'admin.estudiantes.create'])->syncRoles($admin);
        //Permission::firstOrCreate(['name' => 'admin.estudiantes.store'])->syncRoles($admin);
        //Permission::firstOrCreate(['name' => 'admin.estudiantes.show'])->syncRoles($admin);
        //Permission::firstOrCreate(['name' => 'admin.estudiantes.edit'])->syncRoles($admin);
        //Permission::firstOrCreate(['name' => 'admin.estudiantes.update'])->syncRoles($admin);
        //Permission::firstOrCreate(['name' => 'admin.estudiantes.destroy'])->syncRoles($admin);

          // --- PERMISOS PARA PERSONAL CRUD---
        //Permission::firstOrCreate(['name' => 'admin.personal.index'])->syncRoles($admin);
        //Permission::firstOrCreate(['name' => 'admin.personal.create'])->syncRoles($admin);
        //Permission::firstOrCreate(['name' => 'admin.personal.store'])->syncRoles($admin);
        //Permission::firstOrCreate(['name' => 'admin.personal.show'])->syncRoles($admin);
        //Permission::firstOrCreate(['name' => 'admin.personal.edit'])->syncRoles($admin);
        //Permission::firstOrCreate(['name' => 'admin.personal.update'])->syncRoles($admin);
        //Permission::firstOrCreate(['name' => 'admin.personal.destroy'])->syncRoles($admin);


        // --- PERMISOS PARA AULAS CRUD---
        //Permission::firstOrCreate(['name' => 'admin.aulas.index'])->syncRoles($admin);
        //Permission::firstOrCreate(['name' => 'admin.aulas.create'])->syncRoles($admin);
        //Permission::firstOrCreate(['name' => 'admin.aulas.update'])->syncRoles($admin);
        //Permission::firstOrCreate(['name' => 'admin.aulas.destroy'])->syncRoles($admin);

        // --- PERMISOS PARA REPORTES ---
        //Permission::firstOrCreate(['name' => 'admin.reportes.index'])->syncRoles($admin);


        // --- PERMISOS PARA GRUPOS CRUD---
        Permission::firstOrCreate(['name' => 'admin.grupos.index'])->syncRoles($admin);
        Permission::firstOrCreate(['name' => 'admin.grupos.create'])->syncRoles($admin);
        Permission::firstOrCreate(['name' => 'admin.grupos.update'])->syncRoles($admin);
        Permission::firstOrCreate(['name' => 'admin.grupos.destroy'])->syncRoles($admin);

          // --- PERMISOS PARA GESTIONES CRUD---
        Permission::firstOrCreate(['name' => 'admin.gestiones.index'])->syncRoles($admin);
        Permission::firstOrCreate(['name' => 'admin.gestiones.create'])->syncRoles($admin);
        Permission::firstOrCreate(['name' => 'admin.gestiones.update'])->syncRoles($admin);
        Permission::firstOrCreate(['name' => 'admin.gestiones.destroy'])->syncRoles($admin); 

        // --- PERMISOS PARA CARRERA-GESTIONES CRUD---
        Permission::firstOrCreate(['name' => 'admin.carrera-gestiones.index'])->syncRoles($admin);
        Permission::firstOrCreate(['name' => 'admin.carrera-gestiones.create'])->syncRoles($admin);
        Permission::firstOrCreate(['name' => 'admin.carrera-gestiones.update'])->syncRoles($admin);
        Permission::firstOrCreate(['name' => 'admin.carrera-gestiones.destroy'])->syncRoles($admin); 
     
    }
}
