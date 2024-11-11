<?php

namespace App\Http\Controllers;

use App\Models\Cargo;
use App\Models\User;
use App\Models\JobTitle; // Importar el modelo JobTitle
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Muestra una lista de usuarios.
     */
    public function index()
    {
        // Obtener todos los usuarios junto con su JobTitle
        $users = User::with('cargo')->get();

        // Retornar la vista 'users' con la lista de usuarios
        return view('users.index', compact('users'));
    }

    /**
     * Muestra los detalles de un usuario específico.
     */
    public function show($id)
    {
        // Buscar al usuario por su ID junto con su JobTitle
        $user = User::with('cargo')->findOrFail($id);

        // Retornar la vista de detalles con los datos del usuario
        return view('users.show', compact('user'));
    }

    /**
     * Muestra el formulario para crear un nuevo usuario.
     */
    public function create()
    {
        // Obtener todos los cargos (Job Titles) para mostrarlos en un select
        $jobTitles = JobTitle::all();

        return view('users.create', compact('jobTitles'));
    }

    /**
     * Almacena un nuevo usuario en la base de datos.
     */
    public function store(Request $request)
    {
        // Validar los datos ingresados
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8',
            'job_title_id' => 'required|exists:job_titles,id', // Validar que el cargo exista
        ]);

        // Crear el nuevo usuario
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password), // Encriptar la contraseña
            'job_title_id' => $request->job_title_id, // Guardar el ID del cargo
        ]);

        // Redirigir a la lista de usuarios con un mensaje de éxito
        return redirect()->route('users.index')->with('success', 'Usuario creado correctamente.');
    }

    /**
     * Muestra el formulario para editar un usuario existente.
     */
    public function edit($id)
    {
        // Buscar al usuario por su ID junto con su JobTitle
        $user = User::with('cargo')->findOrFail($id);

        // Obtener todos los cargos disponibles
        $cargos = Cargo::all();

        // Retornar la vista de edición con los datos del usuario y cargos
        return view('users.edit', compact('user', 'cargos'));
    }

    /**
     * Actualiza la información de un usuario.
     */
    public function update(Request $request, $id)
    {
        // Validar los datos del formulario
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'dni' => 'required|string|max:255|unique:users,dni,' . $id,  // Asegurar que el DNI sea único excepto para el usuario actual
            'job_title_id' => 'nullable|exists:job_titles,id',  // Validar que el job_title_id exista en la tabla job_titles
        ]);
    
        // Buscar al usuario por ID
        $user = User::findOrFail($id);
    
        // Asignar los valores del formulario al modelo de usuario
        $user->name = $validatedData['name'];
        $user->last_name = $validatedData['last_name'];
        $user->dni = $validatedData['dni'];
        $user->job_title_id = $validatedData['job_title_id'];  // Guardar el cargo seleccionado
    
        // Guardar los cambios en la base de datos
        $user->save();
    
        // Redirigir a la lista de empleados con un mensaje de éxito
        return redirect()->route('empleados')->with('success', 'Usuario actualizado correctamente.');
    }
    

    /**
     * Elimina un usuario.
     */
    public function destroy($id)
    {
        // Buscar el usuario por su ID y eliminarlo
        $user = User::findOrFail($id);
        $user->delete();

        // Redirigir con un mensaje de éxito
        return redirect()->route('users.index')->with('success', 'Usuario eliminado correctamente.');
    }
}
