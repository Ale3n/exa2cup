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
Route::get('/admin/carreras', [App\Http\Controllers\CarreraController::class, 'index'])->name('admin.carreras.index');//->middleware('auth','can:admin.carreras.index');
Route::post('/admin/carreras/create', [App\Http\Controllers\CarreraController::class, 'store'])->name('admin.carreras.create');//->middleware('auth','can:admin.carreras.create');//Create
Route::put('/admin/carreras/{carrera}', [App\Http\Controllers\CarreraController::class, 'update'])->name('admin.carreras.update');//->middleware('auth','can:admin.carreras.update');//Update
Route::delete('/admin/carreras/{carrera}', [App\Http\Controllers\CarreraController::class, 'destroy'])->name('admin.carreras.destroy');//->middleware('auth','can:admin.carreras.destroy');//

//estar parte es para las gestiones
Route::get('/admin/gestiones', [App\Http\Controllers\GestionController::class, 'index'])->name('admin.gestiones.index');//->middleware('auth','can:admin.gestiones.index');
Route::post('/admin/gestiones/create', [App\Http\Controllers\GestionController::class, 'store'])->name('admin.gestiones.create');//->middleware('auth','can:admin.gestiones.create');//Create
Route::put('/admin/gestiones/{gestion}', [App\Http\Controllers\GestionController::class, 'update'])->name('admin.gestiones.update');//->middleware('auth','can:admin.gestiones.update');//Update
Route::delete('/admin/gestiones/{gestion}', [App\Http\Controllers\GestionController::class, 'destroy'])->name('admin.gestiones.destroy');//->middleware('auth','can:admin.gestiones.destroy');//

//estar parte es para los grupos
Route::get('/admin/grupos', [App\Http\Controllers\GrupoController::class, 'index'])->name('admin.grupos.index');
Route::post('/admin/grupos/create', [App\Http\Controllers\GrupoController::class, 'store'])->name('admin.grupos.create');
Route::put('/admin/grupos/{grupo}', [App\Http\Controllers\GrupoController::class, 'update'])->name('admin.grupos.update');
Route::delete('/admin/grupos/{grupo}', [App\Http\Controllers\GrupoController::class, 'destroy'])->name('admin.grupos.destroy');

//estar parte es para las carreras gestionesh
Route::get('/admin/carrera-gestiones', [App\Http\Controllers\CarreraGestionController::class, 'index'])->name('admin.carrera-gestiones.index');
Route::post('/admin/carrera-gestiones/create', [App\Http\Controllers\CarreraGestionController::class, 'store'])->name('admin.carrera-gestiones.create');
Route::put('/admin/carrera-gestiones/{carreraGestion}', [App\Http\Controllers\CarreraGestionController::class, 'update'])->name('admin.carrera-gestiones.update');
Route::delete('/admin/carrera-gestiones/{carreraGestion}', [App\Http\Controllers\CarreraGestionController::class, 'destroy'])->name('admin.carrera-gestiones.destroy');