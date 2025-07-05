@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <h2>Detalles de Entrada de Stock</h2>
    </div>
    <div class="card-body">
        <div class="row mb-3">
            <div class="col-md-3 fw-bold">Medicina:</div>
            <div class="col-md-9">{{ $stockEntry->medicine->name }}</div>
        </div>

        <div class="row mb-3">
            <div class="col-md-3 fw-bold">Cantidad:</div>
            <div class="col-md-9">{{ $stockEntry->quantity }}</div>
        </div>

        <div class="row mb-3">
            <div class="col-md-3 fw-bold">Precio Unitario:</div>
            <div class="col-md-9">${{ number_format($stockEntry->unit_price, 2) }}</div>
        </div>

        <div class="row mb-3">
            <div class="col-md-3 fw-bold">Precio Total:</div>
            <div class="col-md-9">${{ number_format($stockEntry->quantity * $stockEntry->unit_price, 2) }}</div>
        </div>

        <div class="row mb-3">
            <div class="col-md-3 fw-bold">Fecha de Entrada:</div>
            <div class="col-md-9">{{ $stockEntry->entry_date->format('d/m/Y') }}</div>
        </div>

        <div class="row mb-3">
            <div class="col-md-3 fw-bold">Número de Factura:</div>
            <div class="col-md-9">{{ $stockEntry->invoice_number ?? 'N/A' }}</div>
        </div>

        <div class="row mb-3">
            <div class="col-md-3 fw-bold">Notas:</div>
            <div class="col-md-9">{{ $stockEntry->notes ?? 'N/A' }}</div>
        </div>

        <div class="mt-4 d-flex justify-content-between">
            <a href="{{ route('stock-entries.index') }}" class="btn btn-secondary">Volver</a>
            <div>
                <a href="{{ route('stock-entries.edit', $stockEntry) }}" class="btn btn-warning">Editar</a>
                <form action="{{ route('stock-entries.destroy', $stockEntry) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('¿Está seguro?')">Eliminar</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection 