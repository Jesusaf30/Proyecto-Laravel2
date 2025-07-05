<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Medicine;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class MedicineController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $medicines = Medicine::latest()->paginate(10);
        return view('medicines.index', compact('medicines'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('medicines.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'laboratory' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'expiration_date' => 'required|date|after:today',
        ]);

        Medicine::create($validated);

        return redirect()->route('medicines.index')
            ->with('success', 'Medicamento creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Medicine $medicine): View
    {
        return view('medicines.show', compact('medicine'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Medicine $medicine): View
    {
        return view('medicines.edit', compact('medicine'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Medicine $medicine): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'laboratory' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'expiration_date' => 'required|date',
        ]);

        $medicine->update($validated);

        return redirect()->route('medicines.index')
            ->with('success', 'Medicamento actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Medicine $medicine): RedirectResponse
    {
        $medicine->delete();

        return redirect()->route('medicines.index')
            ->with('success', 'Medicamento eliminado exitosamente.');
    }
}
