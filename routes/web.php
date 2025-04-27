<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\VehiculoController;
use App\Http\Controllers\SiniestroController;
use App\Http\Controllers\RecambioController;
use App\Http\Controllers\DocumentoController;
use App\Http\Controllers\SoporteController;
use App\Http\Controllers\UserDashboardController;
use App\Http\Middleware\CheckTallerRole;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    // Redirigir a los usuarios normales a su dashboard específico
    if (Auth::check() && Auth::user()->isUser()) {
        return redirect()->route('user.dashboard');
    }
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    Route::patch('/profile/logo', [ProfileController::class, 'updateLogo'])->name('profile.logo.update');
    
    // Rutas específicas para usuarios normales
    Route::get('/user/dashboard', [UserDashboardController::class, 'index'])->name('user.dashboard');
    Route::get('/user/siniestro/{id}', [UserDashboardController::class, 'showSiniestro'])->name('user.siniestro');
    
    // Rutas protegidas para talleres
    Route::middleware([CheckTallerRole::class])->group(function () {
        // Rutas para clientes
        Route::resource('clientes', ClienteController::class);
        
        // Rutas para vehículos
        Route::resource('vehiculos', VehiculoController::class);
        
        // Rutas para siniestros
        Route::resource('siniestros', SiniestroController::class);
        
        // Rutas para recambios
        Route::resource('recambios', RecambioController::class);
        
        // Rutas para documentos
        Route::resource('documentos', DocumentoController::class);
        Route::get('/documentos/{documento}/download', [DocumentoController::class, 'download'])->name('documentos.download');
        Route::get('/documentos/{documento}/view', [DocumentoController::class, 'view'])->name('documentos.view');
        
        // Rutas para soporte
        Route::resource('soporte', SoporteController::class);
    });
    
    Route::get('/home', function () {
        return redirect()->route('dashboard');
    })->name('home');
});

require __DIR__.'/auth.php';