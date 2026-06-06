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

//estar parte es para los ----GRUPOS----
Route::get('/admin/grupos', [App\Http\Controllers\GrupoController::class, 'index'])->name('admin.grupos.index')->middleware('auth','can:admin.grupos.index');
Route::post('/admin/grupos/create', [App\Http\Controllers\GrupoController::class, 'store'])->name('admin.grupos.create')->middleware('auth','can:admin.grupos.create');
Route::put('/admin/grupos/{grupo}', [App\Http\Controllers\GrupoController::class, 'update'])->name('admin.grupos.update')->middleware('auth','can:admin.grupos.update');
Route::delete('/admin/grupos/{grupo}', [App\Http\Controllers\GrupoController::class, 'destroy'])->name('admin.grupos.destroy')->middleware('auth','can:admin.grupos.destroy');

//estar parte es para las ----CARRERAS-GESTIONES---- gestiones
Route::get('/admin/carrera-gestiones', [App\Http\Controllers\CarreraGestionController::class, 'index'])->name('admin.carrera-gestiones.index')->middleware('auth','can:admin.carrera-gestiones.index');
Route::post('/admin/carrera-gestiones/create', [App\Http\Controllers\CarreraGestionController::class, 'store'])->name('admin.carrera-gestiones.create')->middleware('auth','can:admin.carrera-gestiones.create');
Route::put('/admin/carrera-gestiones/{carreraGestion}', [App\Http\Controllers\CarreraGestionController::class, 'update'])->name('admin.carrera-gestiones.update')->middleware('auth','can:admin.carrera-gestiones.update');
Route::delete('/admin/carrera-gestiones/{carreraGestion}', [App\Http\Controllers\CarreraGestionController::class, 'destroy'])->name('admin.carrera-gestiones.destroy')->middleware('auth','can:admin.carrera-gestiones.destroy');

//rutas que van a ser de ----ROLES---- del sitema CreateReadUpdateDelete
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

//rutas que van a ser de ----POSTULANTES---- del sitema CreateReadUpdateDelete
//trabajando con vistas
Route::get('/admin/postulantes/', [App\Http\Controllers\PostulanteController::class,'index'])->name('admin.postulantes.index')->middleware('auth','can:admin.postulantes.index');
Route::get('/admin/postulantes/create', [App\Http\Controllers\PostulanteController::class,'create'])->name('admin.postulantes.create')->middleware('auth','can:admin.postulantes.create');
Route::post('/admin/postulantes/create', [App\Http\Controllers\PostulanteController::class,'store'])->name('admin.postulantes.store')->middleware('auth','can:admin.postulantes.store');
Route::get('/admin/postulantes/{id}', [App\Http\Controllers\PostulanteController::class,'show'])->name('admin.postulantes.show')->middleware('auth','can:admin.postulantes.show');
Route::get('/admin/postulantes/{id}/edit', [App\Http\Controllers\PostulanteController::class,'edit'])->name('admin.postulantes.edit')->middleware('auth','can:admin.postulantes.edit');
Route::put('/admin/postulantes/{id}', [App\Http\Controllers\PostulanteController::class,'update'])->name('admin.postulantes.update')->middleware('auth','can:admin.postulantes.update');
Route::delete('/admin/postulantes/{id}', [App\Http\Controllers\PostulanteController::class,'destroy'])->name('admin.postulantes.destroy')->middleware('auth','can:admin.postulantes.destroy');

//rutas para el --PERSONAL--- 
Route::get('/admin/personal/{tipo}', [App\Http\Controllers\PersonalController::class, 'index'])->name('admin.personal.index')->middleware('auth','can:admin.personal.index');//retorna la vista indexx
Route::get('/admin/personal/create/{tipo}', [App\Http\Controllers\PersonalController::class, 'create'])->name('admin.personal.create')->middleware('auth','can:admin.personal.create');//retorna la vista create
Route::post('/admin/personal/create', [App\Http\Controllers\PersonalController::class, 'store'])->name('admin.personal.store')->middleware('auth','can:admin.personal.store');//Create
Route::get('/admin/personal/show/{id}', [App\Http\Controllers\PersonalController::class, 'show'])->name('admin.personal.show')->middleware('auth','can:admin.personal.show');//retorna la vista show
Route::get('/admin/personal/{id}/edit', [App\Http\Controllers\PersonalController::class, 'edit'])->name('admin.personal.edit')->middleware('auth','can:admin.personal.edit');//Read
Route::put('/admin/personal/{id}', [App\Http\Controllers\PersonalController::class, 'update'])->name('admin.personal.update')->middleware('auth','can:admin.personal.update');//Update
Route::delete('/admin/personal/{id}', [App\Http\Controllers\PersonalController::class, 'destroy'])->name('admin.personal.destroy')->middleware('auth','can:admin.personal.destroy');//Delete

//rutas para el --AULAS---
Route::get('/admin/aulas', [App\Http\Controllers\AulaController::class, 'index'])->name('admin.aulas.index')->middleware('auth','can:admin.aulas.index');
Route::post('/admin/aulas/create', [App\Http\Controllers\AulaController::class, 'store'])->name('admin.aulas.create')->middleware('auth','can:admin.aulas.create');
Route::put('/admin/aulas/{aula}', [App\Http\Controllers\AulaController::class, 'update'])->name('admin.aulas.update')->middleware('auth','can:admin.aulas.update');
Route::delete('/admin/aulas/{aula}', [App\Http\Controllers\AulaController::class, 'destroy'])->name('admin.aulas.destroy')->middleware('auth','can:admin.aulas.destroy');

//rutas para ---MATERIAS----
Route::get('/admin/materias', [App\Http\Controllers\MateriaController::class, 'index'])->name('admin.materias.index')->middleware('auth','can:admin.materias.index');
Route::post('/admin/materias/create', [App\Http\Controllers\MateriaController::class, 'store'])->name('admin.materias.create')->middleware('auth','can:admin.materias.create');
Route::put('/admin/materias/{materia}', [App\Http\Controllers\MateriaController::class, 'update'])->name('admin.materias.update')->middleware('auth','can:admin.materias.update');
Route::delete('/admin/materias/{materia}', [App\Http\Controllers\MateriaController::class, 'destroy'])->name('admin.materias.destroy')->middleware('auth','can:admin.materias.destroy');

//rutas para ---GRUPOS-MATERIAS----
Route::get('/admin/grupo-materias', [App\Http\Controllers\GrupoMateriaController::class, 'index'])->name('admin.grupo-materias.index')->middleware('auth','can:admin.grupo-materias.index');
Route::post('/admin/grupo-materias/create', [App\Http\Controllers\GrupoMateriaController::class, 'store'])->name('admin.grupo-materias.create')->middleware('auth','can:admin.grupo-materias.create');
Route::put('/admin/grupo-materias/{grupo_materia}', [App\Http\Controllers\GrupoMateriaController::class, 'update'])->name('admin.grupo-materias.update')->middleware('auth','can:admin.grupo-materias.update');
Route::delete('/admin/grupo-materias/{grupo_materia}', [App\Http\Controllers\GrupoMateriaController::class, 'destroy'])->name('admin.grupo-materias.destroy')->middleware('auth','can:admin.grupo-materias.destroy');

//rutas para ---INSCRIPCION-GRUPOS----
Route::get('/admin/inscripcion-grupos', [App\Http\Controllers\InscripcionGrupoController::class, 'index'])->name('admin.inscripcion-grupos.index')->middleware('auth','can:admin.inscripcion-grupos.index');
Route::post('/admin/inscripcion-grupos/create', [App\Http\Controllers\InscripcionGrupoController::class, 'store'])->name('admin.inscripcion-grupos.create')->middleware('auth','can:admin.inscripcion-grupos.create');
Route::put('/admin/inscripcion-grupos/{inscripcion_grupo}', [App\Http\Controllers\InscripcionGrupoController::class, 'update'])->name('admin.inscripcion-grupos.update')->middleware('auth','can:admin.inscripcion-grupos.update');
Route::delete('/admin/inscripcion-grupos/{inscripcion_grupo}', [App\Http\Controllers\InscripcionGrupoController::class, 'destroy'])->name('admin.inscripcion-grupos.destroy')->middleware('auth','can:admin.inscripcion-grupos.destroy');

//rutas para ---CALIFICAIONES----
Route::get('/admin/calificaciones', [App\Http\Controllers\CalificacionController::class, 'index'])->name('admin.calificaciones.index')->middleware('auth','can:admin.calificaciones.index');
Route::post('/admin/calificaciones/create', [App\Http\Controllers\CalificacionController::class, 'store'])->name('admin.calificaciones.create')->middleware('auth','can:admin.calificaciones.create');
Route::put('/admin/calificaciones/{calificacion}', [App\Http\Controllers\CalificacionController::class, 'update'])->name('admin.calificaciones.update')->middleware('auth','can:admin.calificaciones.update');
Route::delete('/admin/calificaciones/{calificacion}', [App\Http\Controllers\CalificacionController::class, 'destroy'])->name('admin.calificaciones.destroy')->middleware('auth','can:admin.calificaciones.destroy');
