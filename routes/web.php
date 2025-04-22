<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\VehiculoController;
use App\Http\Controllers\SiniestroController;
use App\Http\Controllers\RecambioController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Quitar el middleware 'verified' para permitir acceso después del registro
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Rutas para clientes
    Route::resource('clientes', ClienteController::class);
    
    // Rutas para vehículos
    Route::resource('vehiculos', VehiculoController::class);
    
    // Rutas para siniestros
    Route::resource('siniestros', SiniestroController::class);
    
    // Rutas para recambios
    Route::resource('recambios', RecambioController::class);
    
    // Rutas para documentación
    Route::get('/documentacion', function () {
        return view('documentacion.index');
    })->name('documentacion.index');
    
    // Rutas para soporte
    Route::get('/soporte', function () {
        return view('soporte.index');
    })->name('soporte.index');
});

require __DIR__.'/auth.php';