<?php

namespace App\Http\Controllers;

use App\Models\Concept;
use Illuminate\Http\Request;

class ConceptController extends Controller
{
    /**
     * Muestra una lista de conceptos.
     */
    public function index()
    {
        $concepts = Concept::all();
        return view('concepts.index', compact('concepts'));
    }

    /**
     * Muestra el formulario para crear un nuevo concepto.
     */
    public function create()
    {
        return view('concepts.create');
    }

    /**
     * Guarda un nuevo concepto en la base de datos.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255',
            'tipo' => 'required|in:remunerativo,no remunerativo,aporte,deduccion',
            'porcentaje' => 'nullable|numeric|min:0|max:100',
            'monto_fijo' => 'nullable|numeric|min:0',
            'descripcion' => 'nullable|string|max:500',
        ]);

        Concept::create($validatedData);
        return redirect()->route('conceptos.index')->with('success', 'Concepto creado exitosamente.');
    }

    /**
     * Muestra el formulario para editar un concepto específico.
     */
    public function edit(Concept $concept)
    {
        return view('concepts.edit', compact('concept'));
    }

    /**
     * Actualiza un concepto existente en la base de datos.
     */
    public function update(Request $request, Concept $concept)
    {
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255',
            'tipo' => 'required|in:remunerativo,no remunerativo,aporte,deduccion',
            'porcentaje' => 'nullable|numeric|min:0|max:100',
            'monto_fijo' => 'nullable|numeric|min:0',
            'descripcion' => 'nullable|string|max:500',
        ]);

        $concept->update($validatedData);
        return redirect()->route('conceptos.index')->with('success', 'Concepto actualizado exitosamente.');
    }

    /**
     * Elimina un concepto de la base de datos.
     */
    public function destroy(Concept $concept)
    {
        $concept->delete();
        return redirect()->route('conceptos.index')->with('success', 'Concepto eliminado exitosamente.');
    }
}
