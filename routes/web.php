<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\VehiculoController;
use App\Http\Controllers\SiniestroController;
use App\Http\Controllers\RecambioController;
use App\Http\Controllers\DocumentoController;
use App\Http\Controllers\SoporteController;
use App\Http\Controllers\UserDashboardController;
use App\Http\Middleware\CheckTallerRole;
use App\Http\Middleware\CheckUserRole;
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
    // Rutas de perfil originales (mantener para compatibilidad)
    Route::get('/profile', [UserProfileController::class, 'show'])->name('profile.edit');
    Route::patch('/profile', [UserProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Rutas para el perfil de usuario
    Route::get('/user-profile', [UserProfileController::class, 'show'])->name('user.profile');
    Route::patch('/user-profile', [UserProfileController::class, 'update'])->name('user.profile.update');
    Route::patch('/user-profile/logo', [UserProfileController::class, 'updateLogo'])->name('user.profile.logo');
    
    // Rutas específicas para usuarios normales
    Route::middleware([CheckUserRole::class])->group(function () {
        Route::get('/user/dashboard', [UserDashboardController::class, 'index'])->name('user.dashboard');
        Route::get('/user/siniestro/{id}', [UserDashboardController::class, 'showSiniestro'])->name('user.siniestro');
    });
    
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
    });
    
    // Ruta para soporte accesible para todos los usuarios autenticados
    Route::get('/soporte/create', [SoporteController::class, 'create'])->name('soporte.create');
    Route::post('/soporte', [SoporteController::class, 'store'])->name('soporte.store');
    Route::get('/soporte/{soporte}', [SoporteController::class, 'show'])->name('soporte.show');
    Route::resource('soporte', SoporteController::class);
    
    Route::get('/home', function () {
        return redirect()->route('dashboard');
    })->name('home');
});

require __DIR__.'/auth.php';
