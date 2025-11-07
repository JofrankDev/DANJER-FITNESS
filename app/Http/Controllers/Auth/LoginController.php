<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    /**
     * Show the login form.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Handle a login request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'email'],
            'password' => ['required'],
        ], [
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'Debe proporcionar un correo electrónico válido.',
            'password.required' => 'La contraseña es obligatoria.',
        ]);

        if ($validator->fails()) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Error de validación',
                    'errors' => $validator->errors()
                ], 422);
            }
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $credentials = $request->only('email', 'password');
        $remember = $request->boolean('remember');

        if (!Auth::attempt($credentials, $remember)) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Las credenciales proporcionadas no coinciden con nuestros registros.'
                ], 401);
            }
            return redirect()->back()
                ->withErrors(['email' => 'Las credenciales proporcionadas no coinciden con nuestros registros.'])
                ->withInput();
        }

        // Solo regenerar sesión si no es una petición JSON/API
        if ($request->hasSession()) {
            $request->session()->regenerate();
        }

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Inicio de sesión exitoso.',
                'data' => [
                    'user' => Auth::user()
                ]
            ], 200);
        }

        // Redirigir según el tipo de usuario
        $user = Auth::user();

        if ($user->trainer) {
            return redirect()->route('trainer.dashboard')
                ->with('success', '¡Bienvenido de nuevo, ' . $user->name . '!');
        }

        if ($user->administrator) {
            // Cuando tengas dashboard de admin, descomenta esta línea:
            // return redirect()->route('admin.dashboard')
            //     ->with('success', '¡Bienvenido de nuevo, Administrador!');
            return redirect()->route('dashboard')
                ->with('success', '¡Bienvenido de nuevo, Administrador!');
        }

        // Por defecto, redirigir al dashboard de cliente
        return redirect()->route('dashboard')
            ->with('success', '¡Bienvenido de nuevo!');
    }

    /**
     * Handle a logout request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
        Auth::logout();

        // Solo manipular sesión si existe
        if ($request->hasSession()) {
            $request->session()->invalidate();
            $request->session()->regenerateToken();
        }

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Sesión cerrada exitosamente.'
            ], 200);
        }

        return redirect()->route('home')
            ->with('success', 'Sesión cerrada exitosamente.');
    }
}
