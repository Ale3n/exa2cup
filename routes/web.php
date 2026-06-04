<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//estar parte es para las carreras
Route::get('/admin/carreras', [App\Http\Controllers\CarreraController::class, 'index'])->name('admin.carreras.index')->middleware('auth','can:admin.carreras.index');
Route::post('/admin/carreras/create', [App\Http\Controllers\CarreraController::class, 'store'])->name('admin.carreras.create')->middleware('auth','can:admin.carreras.create');//Create
Route::put('/admin/carreras/{carrera}', [App\Http\Controllers\CarreraController::class, 'update'])->name('admin.carreras.update')->middleware('auth','can:admin.carreras.update');//Update
Route::delete('/admin/carreras/{carrera}', [App\Http\Controllers\CarreraController::class, 'destroy'])->name('admin.carreras.destroy')->middleware('auth','can:admin.carreras.destroy');//

//estar parte es para las gestiones
Route::get('/admin/gestiones', [App\Http\Controllers\GestionController::class, 'index'])->name('admin.gestiones.index')->middleware('auth','can:admin.gestiones.index');
Route::post('/admin/gestiones/create', [App\Http\Controllers\GestionController::class, 'store'])->name('admin.gestiones.create')->middleware('auth','can:admin.gestiones.create');//Create
Route::put('/admin/gestiones/{gestion}', [App\Http\Controllers\GestionController::class, 'update'])->name('admin.gestiones.update')->middleware('auth','can:admin.gestiones.update');//Update
Route::delete('/admin/gestiones/{gestion}', [App\Http\Controllers\GestionController::class, 'destroy'])->name('admin.gestiones.destroy')->middleware('auth','can:admin.gestiones.destroy');

//estar parte es para los grupos
Route::get('/admin/grupos', [App\Http\Controllers\GrupoController::class, 'index'])->name('admin.grupos.index')->middleware('auth','can:admin.grupos.index');
Route::post('/admin/grupos/create', [App\Http\Controllers\GrupoController::class, 'store'])->name('admin.grupos.create')->middleware('auth','can:admin.grupos.create');
Route::put('/admin/grupos/{grupo}', [App\Http\Controllers\GrupoController::class, 'update'])->name('admin.grupos.update')->middleware('auth','can:admin.grupos.update');
Route::delete('/admin/grupos/{grupo}', [App\Http\Controllers\GrupoController::class, 'destroy'])->name('admin.grupos.destroy')->middleware('auth','can:admin.grupos.destroy');

//estar parte es para las carreras gestiones
Route::get('/admin/carrera-gestiones', [App\Http\Controllers\CarreraGestionController::class, 'index'])->name('admin.carrera-gestiones.index')->middleware('auth','can:admin.carrera-gestiones.index');
Route::post('/admin/carrera-gestiones/create', [App\Http\Controllers\CarreraGestionController::class, 'store'])->name('admin.carrera-gestiones.create')->middleware('auth','can:admin.carrera-gestiones.create');
Route::put('/admin/carrera-gestiones/{carreraGestion}', [App\Http\Controllers\CarreraGestionController::class, 'update'])->name('admin.carrera-gestiones.update')->middleware('auth','can:admin.carrera-gestiones.update');
Route::delete('/admin/carrera-gestiones/{carreraGestion}', [App\Http\Controllers\CarreraGestionController::class, 'destroy'])->name('admin.carrera-gestiones.destroy')->middleware('auth','can:admin.carrera-gestiones.destroy');

//rutas que van a ser de ROLES del sitema CreateReadUpdateDelete
//trabajando con vistas
Route::get('/admin/roles', [App\Http\Controllers\RoleController::class, 'index'])->name('admin.roles.index')->middleware('auth','can:admin.roles.index');
Route::get('/admin/roles/create', [App\Http\Controllers\RoleController::class, 'create'])->name('admin.roles.create')->middleware('auth','can:admin.roles.create');//retorna la vista
Route::post('/admin/roles/create', [App\Http\Controllers\RoleController::class, 'store'])->name('admin.roles.store')->middleware('auth','can:admin.roles.store');//Create
Route::get('/admin/roles/{id}/edit', [App\Http\Controllers\RoleController::class, 'edit'])->name('admin.roles.edit')->middleware('auth','can:admin.roles.edit');//Read
Route::put('/admin/roles/{id}', [App\Http\Controllers\RoleController::class, 'update'])->name('admin.roles.update')->middleware('auth','can:admin.roles.update');//Update
Route::delete('/admin/roles/{id}', [App\Http\Controllers\RoleController::class, 'destroy'])->name('admin.roles.destroy')->middleware('auth','can:admin.roles.destroy');//Delete
//el metodo que da permisos
Route::get('/admin/roles/{id}/permisos', [App\Http\Controllers\RoleController::class, 'permisos'])->name('admin.roles.permisos')->middleware('auth','can:admin.roles.permisos');//el que da permisos che
Route::post('/admin/roles/{id}', [App\Http\Controllers\RoleController::class, 'update_permisos'])->name('admin.roles.update_permisos')->middleware('auth','can:admin.roles.update_permisos');//el que da permisos che