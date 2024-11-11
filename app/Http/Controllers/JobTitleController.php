<?php

namespace App\Http\Controllers;

use App\Models\Cargo;
use Illuminate\Http\Request;

class JobTitleController extends Controller
{
    public function index()
    {
        $cargos = Cargo::all();
        return view('jobtitles.index', compact('cargos'));
    }

    public function create()
    {
        return view('jobtitles.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'base_salary' => 'required|numeric',
        ]);

        JobTitle::create([
            'name' => $request->name,
            'base_salary' => $request->base_salary,
        ]);

        return redirect()->route('cargos.index')->with('success', 'Cargo creado exitosamente');
    }

    public function edit($id)
    {
        $jobTitle = JobTitle::findOrFail($id);
        return view('jobtitles.edit', compact('jobTitle'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'base_salary' => 'required|numeric',
        ]);

        $jobTitle = JobTitle::findOrFail($id);
        $jobTitle->update([
            'name' => $request->name,
            'base_salary' => $request->base_salary,
        ]);

        return redirect()->route('cargos.index')->with('success', 'Cargo actualizado exitosamente');
    }
}
