<?php

use App\Http\Controllers\AreasMedicasController;
use App\Http\Controllers\CitasController;
use App\Http\Controllers\MedicosController;
use App\Http\Controllers\PacientesController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/citas', [CitasController::class, 'show'])->middleware(['auth'])->name('citas');

Route::get('/get-citas', [CitasController::class, 'getCitas'])->middleware(['auth'])->name('getCitas');

Route::post('/citas', [CitasController::class, 'guardar'])->middleware(['auth'])->name('guardar');

Route::patch('/citas', [CitasController::class, 'modificar'])->middleware(['auth'])->name('modificar');

Route::delete('/citas', [CitasController::class, 'eliminar'])->middleware(['auth'])->name('eliminar');

Route::get('/medicos', [MedicosController::class, 'show'])->middleware(['auth'])->name('medicos');

Route::get('/medicos/{id}', [MedicosController::class, 'getMedico'])->middleware(['auth'])->name('getMedico');

Route::post('/medicos', [MedicosController::class, 'guardar'])->middleware(['auth'])->name('guardar');

Route::get('/pacientes', [PacientesController::class, 'show'])->middleware(['auth'])->name('pacientes');

Route::post('/pacientes', [PacientesController::class, 'guardar'])->middleware(['auth'])->name('guardar');

Route::get('/areas', [AreasMedicasController::class, 'show'])->middleware(['auth'])->name('areas');

Route::post('/areas', [AreasMedicasController::class, 'guardar'])->middleware(['auth'])->name('guardar');

require __DIR__ . '/auth.php';
