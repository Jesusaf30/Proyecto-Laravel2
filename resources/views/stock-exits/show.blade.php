@extends('layouts.app')

@section('title', 'Detalles de Salida de Stock')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Detalles de Salida de Stock</h1>
        <div>
            <a href="{{ route('stock-exits.edit', $stockExit) }}" class="btn btn-warning text-white">
                <i class="bi bi-pencil"></i> Editar
            </a>
            <a href="{{ route('stock-exits.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Volver
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8 mb-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Información de la Salida</h5>
                </div>
                <div class="card-body">
                    <dl class="row">
                        <dt class="col-sm-4">Medicamento</dt>
                        <dd class="col-sm-8">
                            <a href="{{ route('medicines.show', $stockExit->medicine) }}">
                                {{ $stockExit->medicine->name }}
                            </a>
                        </dd>

                        <dt class="col-sm-4">Fecha de Salida</dt>
                        <dd class="col-sm-8">{{ $stockExit->exit_date->format('d/m/Y') }}</dd>

                        <dt class="col-sm-4">Cantidad</dt>
                        <dd class="col-sm-8">{{ $stockExit->quantity }}</dd>

                        <dt class="col-sm-4">Precio Unitario</dt>
                        <dd class="col-sm-8">${{ number_format($stockExit->unit_price, 2) }}</dd>

                        <dt class="col-sm-4">Total</dt>
                        <dd class="col-sm-8">${{ number_format($stockExit->quantity * $stockExit->unit_price, 2) }}</dd>

                        <dt class="col-sm-4">Razón</dt>
                        <dd class="col-sm-8">{{ $stockExit->reason }}</dd>

                        <dt class="col-sm-4">Notas</dt>
                        <dd class="col-sm-8">{{ $stockExit->notes ?: 'No hay notas disponibles' }}</dd>

                        <dt class="col-sm-4">Fecha de Registro</dt>
                        <dd class="col-sm-8">{{ $stockExit->created_at->format('d/m/Y H:i:s') }}</dd>

                        <dt class="col-sm-4">Última Actualización</dt>
                        <dd class="col-sm-8">{{ $stockExit->updated_at->format('d/m/Y H:i:s') }}</dd>
                    </dl>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Información del Medicamento</h5>
                </div>
                <div class="card-body">
                    <dl class="row">
                        <dt class="col-sm-6">Stock Actual</dt>
                        <dd class="col-sm-6">
                            <span class="badge bg-{{ $stockExit->medicine->stock > 0 ? 'success' : 'danger' }}">
                                {{ $stockExit->medicine->stock }}
                            </span>
                        </dd>

                        <dt class="col-sm-6">Precio Actual</dt>
                        <dd class="col-sm-6">${{ number_format($stockExit->medicine->price, 2) }}</dd>

                        <dt class="col-sm-6">Laboratorio</dt>
                        <dd class="col-sm-6">{{ $stockExit->medicine->laboratory }}</dd>

                        <dt class="col-sm-6">Vencimiento</dt>
                        <dd class="col-sm-6">{{ $stockExit->medicine->expiration_date->format('d/m/Y') }}</dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>
@endsection 