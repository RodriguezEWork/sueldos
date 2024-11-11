<?php

use App\Http\Controllers\JobTitleController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PayoutController;
use App\Http\Controllers\ConceptController;
use App\Http\Controllers\FacturaController;
use App\Models\Concept;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

// Estas rutas deberían estar después de instalar Breeze
require __DIR__.'/auth.php';


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/cargos', [JobTitleController::class, 'index'])->middleware(['auth', 'verified'])->name('cargos.index');
Route::get('/cargos/crear', [JobTitleController::class, 'create'])->middleware(['auth', 'verified'])->name('cargos.create');
Route::post('/cargos', [JobTitleController::class, 'store'])->middleware(['auth', 'verified'])->name('cargos.store');
Route::get('/cargos/{id}/editar', [JobTitleController::class, 'edit'])->middleware(['auth', 'verified'])->name('cargos.edit');
Route::put('/cargos/{id}', [JobTitleController::class, 'update'])->middleware(['auth', 'verified'])->name('cargos.update');

Route::get('/empleados', [UserController::class, 'index'])->middleware(['auth', 'verified'])->name('empleados');
Route::get('/empleados/{id}', [UserController::class, 'show'])->middleware(['auth', 'verified'])->name('users.show');
Route::get('/empleados/{id}/edit', [UserController::class, 'edit'])->middleware(['auth', 'verified'])->name('users.edit');
Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');

//Rutas de liquidaciones
Route::get('/liquidaciones/crear/{user}', [PayoutController::class, 'create'])->middleware(['auth', 'verified'])->name('liquidaciones.create');

// Index
Route::get('/liquidaciones/{userId}', [PayoutController::class, 'index'])->middleware(['auth', 'verified'])->name('liquidaciones.index');

// Store
Route::post('/liquidaciones', [PayoutController::class, 'store'])->middleware(['auth', 'verified'])->name('liquidaciones.store');

// Show
Route::get('/payouts/{userId}/{payoutId}', [PayoutController::class, 'index'])->middleware(['auth', 'verified'])->name('payouts.show');

Route::get('/conceptos', [ConceptController::class, 'index'])->middleware(['auth', 'verified'])->name('conceptos.index');
Route::get('/conceptos/crear', [ConceptController::class, 'create'])->middleware(['auth', 'verified'])->name('conceptos.create');
Route::post('/conceptos', [ConceptController::class, 'store'])->middleware(['auth', 'verified'])->name('conceptos.store');
Route::get('/conceptos/{id}/editar', [ConceptController::class, 'edit'])->middleware(['auth', 'verified'])->name('conceptos.edit');
Route::put('/conceptos/{id}', [ConceptController::class, 'update'])->middleware(['auth', 'verified'])->name('conceptos.update');
Route::delete('/concepts', [ConceptController::class, 'destroy'])->name('conceptos.destroy');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Rutas de Facturación
    Route::get('/facturas', [FacturaController::class, 'index'])->name('facturas.index');
    Route::get('/facturas/generar', [FacturaController::class, 'generar'])->name('facturas.generar');
    Route::get('/facturas/generar-todo', [FacturaController::class, 'generarTodo'])->name('facturas.generarTodo');
    Route::get('/facturas/pdf', [FacturaController::class, 'pdf'])->name('facturas.pdf');
});

require __DIR__.'/auth.php';
