<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use Illuminate\Validation\ValidationException;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        try {
            $login = $request->input('login');
            $loginType = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'dni';
            Log::info("Intento de inicio de sesión con {$loginType}: {$login}");
            
            $request->authenticate();
            
            Log::info("Inicio de sesión exitoso para {$loginType}: {$login}");
            
            $request->session()->regenerate();
            
            return redirect()->intended(RouteServiceProvider::HOME);
        } catch (ValidationException $e) {
            throw $e;
        } catch (\Exception $e) {
            Log::error('Error de autenticación: ' . $e->getMessage(), [
                'login' => $request->input('login'),
                'exception' => get_class($e),
                'trace' => $e->getTraceAsString()
            ]);
            
            return back()->withErrors([
                'login' => 'Email o Contraseña. Errónea inténtelo de nuevo.',
            ])->withInput();
        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}