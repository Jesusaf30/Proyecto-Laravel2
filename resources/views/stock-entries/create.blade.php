@extends('layouts.app')

@section('title', 'Nueva Entrada de Stock')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Nueva Entrada de Stock</h1>
        <a href="{{ route('stock-entries.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Volver
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('stock-entries.store') }}" method="POST">
                @csrf

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="medicine_id" class="form-label">Medicamento</label>
                        <select class="form-select @error('medicine_id') is-invalid @enderror" 
                                id="medicine_id" 
                                name="medicine_id" 
                                required>
                            <option value="">Seleccione un medicamento</option>
                            @foreach($medicines as $medicine)
                                <option value="{{ $medicine->id }}" 
                                        {{ old('medicine_id') == $medicine->id ? 'selected' : '' }}>
                                    {{ $medicine->name }} (Stock actual: {{ $medicine->stock }})
                                </option>
                            @endforeach
                        </select>
                        @error('medicine_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="entry_date" class="form-label">Fecha de Entrada</label>
                        <input type="date" 
                               class="form-control @error('entry_date') is-invalid @enderror" 
                               id="entry_date" 
                               name="entry_date" 
                               value="{{ old('entry_date', date('Y-m-d')) }}" 
                               required>
                        @error('entry_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="quantity" class="form-label">Cantidad</label>
                        <input type="number" 
                               class="form-control @error('quantity') is-invalid @enderror" 
                               id="quantity" 
                               name="quantity" 
                               value="{{ old('quantity') }}" 
                               min="1" 
                               required>
                        @error('quantity')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="unit_price" class="form-label">Precio Unitario</label>
                        <div class="input-group">
                            <span class="input-group-text">$</span>
                            <input type="number" 
                                   class="form-control @error('unit_price') is-invalid @enderror" 
                                   id="unit_price" 
                                   name="unit_price" 
                                   value="{{ old('unit_price') }}" 
                                   step="0.01" 
                                   min="0" 
                                   required>
                            @error('unit_price')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="invoice_number" class="form-label">Número de Factura</label>
                        <input type="text" 
                               class="form-control @error('invoice_number') is-invalid @enderror" 
                               id="invoice_number" 
                               name="invoice_number" 
                               value="{{ old('invoice_number') }}" 
                               required>
                        @error('invoice_number')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12 mb-3">
                        <label for="notes" class="form-label">Notas</label>
                        <textarea class="form-control @error('notes') is-invalid @enderror" 
                                  id="notes" 
                                  name="notes" 
                                  rows="3">{{ old('notes') }}</textarea>
                        @error('notes')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save"></i> Guardar
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection 