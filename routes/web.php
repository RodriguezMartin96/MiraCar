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
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Middleware\CheckTallerRole;
use App\Http\Middleware\CheckUserRole;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Añade esta ruta para el healthcheck de Railway
Route::get('/health', function () {
    return response()->json(['status' => 'ok']);
});

Route::get('/', function () {
    return view('welcome');
});

Route::redirect('/dashboard', '/taller/inicio');
Route::redirect('/clientes/create', '/taller/clientes/crear');
Route::redirect('/taller/siniestros/create', '/taller/siniestros/crear');
Route::redirect('/taller/vehiculos/create', '/taller/vehiculos/crear');
Route::redirect('/soporte/create', '/soporte');
Route::redirect('/soporte', '/soporte');
Route::redirect('/user-profile', '/perfil');
Route::redirect('/profile', '/perfil');
Route::redirect('/login', '/acceder');
Route::redirect('/user/dashboard', '/usuario/inicio');
Route::redirect('/user/siniestro', '/usuario/siniestro');

Route::get('/taller/inicio', function () {
    if (Auth::check() && Auth::user()->isUser()) {
        return redirect()->route('user.dashboard');
    }
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::middleware('guest')->group(function () {
    Route::get('registrarse', [RegisteredUserController::class, 'create'])
        ->name('registrarse');

    Route::post('registrarse', [RegisteredUserController::class, 'store'])
        ->name('registrarse.submit');
});

Route::middleware('auth')->group(function () {
    Route::get('/perfil', [UserProfileController::class, 'show'])->name('user.profile');
    Route::patch('/perfil', [UserProfileController::class, 'update'])->name('user.profile.update');
    Route::patch('/perfil/logo', [UserProfileController::class, 'updateLogo'])->name('user.profile.logo');
    Route::delete('/perfil', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    Route::get('/soporte', [SoporteController::class, 'create'])->name('soporte.create');
    Route::post('/soporte', [SoporteController::class, 'store'])->name('soporte.store');
    Route::get('/soporte/{soporte}', [SoporteController::class, 'show'])->name('soporte.show');
    Route::get('/soporte/index', [SoporteController::class, 'index'])->name('soporte.index');
    Route::get('/soporte/{soporte}/edit', [SoporteController::class, 'edit'])->name('soporte.edit');
    Route::put('/soporte/{soporte}', [SoporteController::class, 'update'])->name('soporte.update');
    Route::delete('/soporte/{soporte}', [SoporteController::class, 'destroy'])->name('soporte.destroy');
    
    Route::middleware([CheckUserRole::class])->group(function () {
        Route::get('/usuario/inicio', [UserDashboardController::class, 'index'])->name('user.dashboard');
        Route::get('/usuario/siniestro/{id}', [UserDashboardController::class, 'showSiniestro'])->name('user.siniestro');
    });
    
    Route::middleware([CheckTallerRole::class])->group(function () {
        Route::prefix('taller')->group(function () {
            Route::get('/clientes', [ClienteController::class, 'index'])->name('clientes.index');
            Route::get('/clientes/crear', [ClienteController::class, 'create'])->name('clientes.create');
            Route::post('/clientes', [ClienteController::class, 'store'])->name('clientes.store');
            Route::get('/clientes/{cliente}', [ClienteController::class, 'show'])->name('clientes.show');
            Route::get('/clientes/{cliente}/editar', [ClienteController::class, 'edit'])->name('clientes.edit');
            Route::put('/clientes/{cliente}', [ClienteController::class, 'update'])->name('clientes.update');
            Route::delete('/clientes/{cliente}', [ClienteController::class, 'destroy'])->name('clientes.destroy');
            
            Route::get('/vehiculos', [VehiculoController::class, 'index'])->name('vehiculos.index');
            Route::get('/vehiculos/crear', [VehiculoController::class, 'create'])->name('vehiculos.create');
            Route::post('/vehiculos', [VehiculoController::class, 'store'])->name('vehiculos.store');
            Route::get('/vehiculos/{vehiculo}', [VehiculoController::class, 'show'])->name('vehiculos.show');
            Route::get('/vehiculos/{vehiculo}/editar', [VehiculoController::class, 'edit'])->name('vehiculos.edit');
            Route::put('/vehiculos/{vehiculo}', [VehiculoController::class, 'update'])->name('vehiculos.update');
            Route::delete('/vehiculos/{vehiculo}', [VehiculoController::class, 'destroy'])->name('vehiculos.destroy');
            
            Route::get('/siniestros', [SiniestroController::class, 'index'])->name('siniestros.index');
            Route::get('/siniestros/crear', [SiniestroController::class, 'create'])->name('siniestros.create');
            Route::post('/siniestros', [SiniestroController::class, 'store'])->name('siniestros.store');
            Route::get('/siniestros/{siniestro}', [SiniestroController::class, 'show'])->name('siniestros.show');
            Route::get('/siniestros/{siniestro}/editar', [SiniestroController::class, 'edit'])->name('siniestros.edit');
            Route::put('/siniestros/{siniestro}', [SiniestroController::class, 'update'])->name('siniestros.update');
            Route::delete('/siniestros/{siniestro}', [SiniestroController::class, 'destroy'])->name('siniestros.destroy');
            
            Route::get('/recambios', [RecambioController::class, 'index'])->name('recambios.index');
            Route::get('/recambios/crear', [RecambioController::class, 'create'])->name('recambios.create');
            Route::post('/recambios', [RecambioController::class, 'store'])->name('recambios.store');
            Route::get('/recambios/{recambio}', [RecambioController::class, 'show'])->name('recambios.show');
            Route::get('/recambios/{recambio}/editar', [RecambioController::class, 'edit'])->name('recambios.edit');
            Route::put('/recambios/{recambio}', [RecambioController::class, 'update'])->name('recambios.update');
            Route::delete('/recambios/{recambio}', [RecambioController::class, 'destroy'])->name('recambios.destroy');
            
            Route::get('/documentos', [DocumentoController::class, 'index'])->name('documentos.index');
            Route::get('/documentos/crear', [DocumentoController::class, 'create'])->name('documentos.create');
            Route::post('/documentos', [DocumentoController::class, 'store'])->name('documentos.store');
            Route::get('/documentos/{documento}', [DocumentoController::class, 'show'])->name('documentos.show');
            Route::get('/documentos/{documento}/editar', [DocumentoController::class, 'edit'])->name('documentos.edit');
            Route::put('/documentos/{documento}', [DocumentoController::class, 'update'])->name('documentos.update');
            Route::delete('/documentos/{documento}', [DocumentoController::class, 'destroy'])->name('documentos.destroy');
            Route::get('/documentos/{documento}/download', [DocumentoController::class, 'download'])->name('documentos.download');
            Route::get('/documentos/{documento}/view', [DocumentoController::class, 'view'])->name('documentos.view');
        });
    });
    
    Route::get('/home', function () {
        return redirect()->route('dashboard');
    })->name('home');
});

require __DIR__.'/auth.php';