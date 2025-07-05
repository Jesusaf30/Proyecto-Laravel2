<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Medicine;
use App\Models\StockExit;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;

class StockExitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $stockExits = StockExit::with('medicine')->latest()->paginate(10);
        return view('stock-exits.index', compact('stockExits'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $medicines = Medicine::orderBy('name')->get();
        return view('stock-exits.create', compact('medicines'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'medicine_id' => 'required|exists:medicines,id',
            'quantity' => 'required|integer|min:1',
            'unit_price' => 'required|numeric|min:0',
            'exit_date' => 'required|date',
            'reason' => 'required|string|max:255',
            'notes' => 'nullable|string',
        ]);

        $medicine = Medicine::findOrFail($validated['medicine_id']);
        
        if ($medicine->stock < $validated['quantity']) {
            return back()->withErrors(['quantity' => 'No hay suficiente stock disponible.'])
                        ->withInput();
        }

        DB::transaction(function () use ($validated, $medicine) {
            StockExit::create($validated);
            $medicine->decrement('stock', $validated['quantity']);
        });

        return redirect()->route('stock-exits.index')
            ->with('success', 'Salida de stock registrada exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(StockExit $stockExit): View
    {
        return view('stock-exits.show', compact('stockExit'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(StockExit $stockExit): View
    {
        $medicines = Medicine::orderBy('name')->get();
        return view('stock-exits.edit', compact('stockExit', 'medicines'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, StockExit $stockExit): RedirectResponse
    {
        $validated = $request->validate([
            'medicine_id' => 'required|exists:medicines,id',
            'quantity' => 'required|integer|min:1',
            'unit_price' => 'required|numeric|min:0',
            'exit_date' => 'required|date',
            'reason' => 'required|string|max:255',
            'notes' => 'nullable|string',
        ]);

        $medicine = Medicine::findOrFail($validated['medicine_id']);
        $availableStock = $medicine->stock + $stockExit->quantity;

        if ($availableStock < $validated['quantity']) {
            return back()->withErrors(['quantity' => 'No hay suficiente stock disponible.'])
                        ->withInput();
        }

        DB::transaction(function () use ($stockExit, $validated) {
            // Revert old stock
            $medicine = Medicine::findOrFail($stockExit->medicine_id);
            $medicine->increment('stock', $stockExit->quantity);

            // Update exit
            $stockExit->update($validated);

            // Subtract new stock
            $medicine = Medicine::findOrFail($validated['medicine_id']);
            $medicine->decrement('stock', $validated['quantity']);
        });

        return redirect()->route('stock-exits.index')
            ->with('success', 'Salida de stock actualizada exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(StockExit $stockExit): RedirectResponse
    {
        DB::transaction(function () use ($stockExit) {
            $medicine = Medicine::findOrFail($stockExit->medicine_id);
            $medicine->increment('stock', $stockExit->quantity);
            $stockExit->delete();
        });

        return redirect()->route('stock-exits.index')
            ->with('success', 'Salida de stock eliminada exitosamente.');
    }
}
