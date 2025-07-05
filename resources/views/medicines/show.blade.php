@extends('layouts.app')

@section('title', 'Detalles del Medicamento')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Detalles del Medicamento</h1>
        <div>
            <a href="{{ route('medicines.edit', $medicine) }}" class="btn btn-warning text-white">
                <i class="bi bi-pencil"></i> Editar
            </a>
            <a href="{{ route('medicines.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Volver
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Información General</h5>
                </div>
                <div class="card-body">
                    <dl class="row">
                        <dt class="col-sm-4">Nombre</dt>
                        <dd class="col-sm-8">{{ $medicine->name }}</dd>

                        <dt class="col-sm-4">Laboratorio</dt>
                        <dd class="col-sm-8">{{ $medicine->laboratory }}</dd>

                        <dt class="col-sm-4">Precio</dt>
                        <dd class="col-sm-8">${{ number_format($medicine->price, 2) }}</dd>

                        <dt class="col-sm-4">Stock Actual</dt>
                        <dd class="col-sm-8">
                            <span class="badge bg-{{ $medicine->stock > 0 ? 'success' : 'danger' }}">
                                {{ $medicine->stock }}
                            </span>
                        </dd>

                        <dt class="col-sm-4">Fecha de Vencimiento</dt>
                        <dd class="col-sm-8">{{ $medicine->expiration_date->format('d/m/Y') }}</dd>

                        <dt class="col-sm-4">Descripción</dt>
                        <dd class="col-sm-8">{{ $medicine->description ?: 'No disponible' }}</dd>
                    </dl>
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Movimientos Recientes</h5>
                </div>
                <div class="card-body">
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#entries" type="button">
                                Entradas
                            </button>
                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#exits" type="button">
                                Salidas
                            </button>
                        </div>
                    </nav>
                    <div class="tab-content mt-3">
                        <div class="tab-pane fade show active" id="entries">
                            @if($medicine->stockEntries->count() > 0)
                                <div class="table-responsive">
                                    <table class="table table-sm">
                                        <thead>
                                            <tr>
                                                <th>Fecha</th>
                                                <th>Cantidad</th>
                                                <th>Factura</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($medicine->stockEntries->take(5) as $entry)
                                                <tr>
                                                    <td>{{ $entry->entry_date->format('d/m/Y') }}</td>
                                                    <td>{{ $entry->quantity }}</td>
                                                    <td>{{ $entry->invoice_number }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <p class="text-muted mb-0">No hay entradas registradas.</p>
                            @endif
                        </div>
                        <div class="tab-pane fade" id="exits">
                            @if($medicine->stockExits->count() > 0)
                                <div class="table-responsive">
                                    <table class="table table-sm">
                                        <thead>
                                            <tr>
                                                <th>Fecha</th>
                                                <th>Cantidad</th>
                                                <th>Razón</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($medicine->stockExits->take(5) as $exit)
                                                <tr>
                                                    <td>{{ $exit->exit_date->format('d/m/Y') }}</td>
                                                    <td>{{ $exit->quantity }}</td>
                                                    <td>{{ $exit->reason }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <p class="text-muted mb-0">No hay salidas registradas.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection 