<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Medicine;
use App\Models\StockEntry;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;

class StockEntryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $stockEntries = StockEntry::with('medicine')->latest()->paginate(10);
        return view('stock-entries.index', compact('stockEntries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $medicines = Medicine::orderBy('name')->get();
        return view('stock-entries.create', compact('medicines'));
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
            'entry_date' => 'required|date',
            'invoice_number' => 'required|string|max:255',
            'notes' => 'nullable|string',
        ]);

        DB::transaction(function () use ($validated) {
            StockEntry::create($validated);

            $medicine = Medicine::findOrFail($validated['medicine_id']);
            $medicine->increment('stock', $validated['quantity']);
        });

        return redirect()->route('stock-entries.index')
            ->with('success', 'Entrada de stock registrada exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(StockEntry $stockEntry): View
    {
        return view('stock-entries.show', compact('stockEntry'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(StockEntry $stockEntry): View
    {
        $medicines = Medicine::orderBy('name')->get();
        return view('stock-entries.edit', compact('stockEntry', 'medicines'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, StockEntry $stockEntry): RedirectResponse
    {
        $validated = $request->validate([
            'medicine_id' => 'required|exists:medicines,id',
            'quantity' => 'required|integer|min:1',
            'unit_price' => 'required|numeric|min:0',
            'entry_date' => 'required|date',
            'invoice_number' => 'required|string|max:255',
            'notes' => 'nullable|string',
        ]);

        DB::transaction(function () use ($stockEntry, $validated) {
            // Revert old stock
            $medicine = Medicine::findOrFail($stockEntry->medicine_id);
            $medicine->decrement('stock', $stockEntry->quantity);

            // Update entry
            $stockEntry->update($validated);

            // Add new stock
            $medicine = Medicine::findOrFail($validated['medicine_id']);
            $medicine->increment('stock', $validated['quantity']);
        });

        return redirect()->route('stock-entries.index')
            ->with('success', 'Entrada de stock actualizada exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(StockEntry $stockEntry): RedirectResponse
    {
        DB::transaction(function () use ($stockEntry) {
            $medicine = Medicine::findOrFail($stockEntry->medicine_id);
            $medicine->decrement('stock', $stockEntry->quantity);
            $stockEntry->delete();
        });

        return redirect()->route('stock-entries.index')
            ->with('success', 'Entrada de stock eliminada exitosamente.');
    }
}
