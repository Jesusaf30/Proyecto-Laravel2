@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <h2>Nueva Entrada de Stock</h2>
    </div>
    <div class="card-body">
        <form action="{{ route('stock-entries.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="medicine_id" class="form-label">Medicina</label>
                <select class="form-select @error('medicine_id') is-invalid @enderror" id="medicine_id" name="medicine_id" required>
                    <option value="">Seleccione una medicina</option>
                    @foreach($medicines as $medicine)
                        <option value="{{ $medicine->id }}" {{ old('medicine_id') == $medicine->id ? 'selected' : '' }}>
                            {{ $medicine->name }}
                        </option>
                    @endforeach
                </select>
                @error('medicine_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="quantity" class="form-label">Cantidad</label>
                <input type="number" class="form-control @error('quantity') is-invalid @enderror" id="quantity" name="quantity" value="{{ old('quantity') }}" required min="1">
                @error('quantity')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="unit_price" class="form-label">Precio Unitario</label>
                <input type="number" step="0.01" class="form-control @error('unit_price') is-invalid @enderror" id="unit_price" name="unit_price" value="{{ old('unit_price') }}" required min="0">
                @error('unit_price')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="entry_date" class="form-label">Fecha de Entrada</label>
                <input type="date" class="form-control @error('entry_date') is-invalid @enderror" id="entry_date" name="entry_date" value="{{ old('entry_date', date('Y-m-d')) }}" required>
                @error('entry_date')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="invoice_number" class="form-label">Número de Factura</label>
                <input type="text" class="form-control @error('invoice_number') is-invalid @enderror" id="invoice_number" name="invoice_number" value="{{ old('invoice_number') }}">
                @error('invoice_number')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="notes" class="form-label">Notas</label>
                <textarea class="form-control @error('notes') is-invalid @enderror" id="notes" name="notes">{{ old('notes') }}</textarea>
                @error('notes')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex justify-content-between">
                <a href="{{ route('stock-entries.index') }}" class="btn btn-secondary">Cancelar</a>
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
        </form>
    </div>
</div>
@endsection 