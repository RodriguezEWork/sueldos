<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Cargo;
use App\Models\User;
use App\Models\JobTitle; // Importar el modelo JobTitle
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Muestra la vista de registro.
     */
    public function create(): View
    {
        $cargos = Cargo::all();
        return view('auth.register', compact('cargos'));
    }

    /**
     * Maneja una solicitud de registro entrante.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // Validar los datos ingresados
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'apellido' => ['required', 'string', 'max:255'], // Asegúrate de incluirlo aquí
            'dni' => ['required', 'string', 'max:20'], // Puedes ajustar la validación según sea necesario
            'cargo_id' => ['required'], // Igualmente aquí
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // Crear el nuevo usuario
        $user = User::create([
            'name' => $request->name,
            'apellido' => $request->apellido,
            'dni' => $request->dni,
            'email' => $request->email,
            'cargo_id' => $request->cargo_id,
            'password' => Hash::make($request->password),
        ]);

        // Evento de registro
        event(new Registered($user));

        // Loguear al usuario recién registrado
        Auth::login($user);

        // Redirigir al home
        return redirect(RouteServiceProvider::HOME);
    }
}
