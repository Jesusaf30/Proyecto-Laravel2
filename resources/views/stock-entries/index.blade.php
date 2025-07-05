@extends('layouts.app')

@section('title', 'Entradas de Stock')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Entradas de Stock</h1>
        <a href="{{ route('stock-entries.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg"></i> Nueva Entrada
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Fecha</th>
                            <th>Medicamento</th>
                            <th>Cantidad</th>
                            <th>Precio Unitario</th>
                            <th>Factura</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($stockEntries as $entry)
                            <tr>
                                <td>{{ $entry->entry_date->format('d/m/Y') }}</td>
                                <td>{{ $entry->medicine->name }}</td>
                                <td>{{ $entry->quantity }}</td>
                                <td>${{ number_format($entry->unit_price, 2) }}</td>
                                <td>{{ $entry->invoice_number }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('stock-entries.show', $entry) }}" 
                                           class="btn btn-sm btn-info text-white">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <a href="{{ route('stock-entries.edit', $entry) }}" 
                                           class="btn btn-sm btn-warning text-white">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="{{ route('stock-entries.destroy', $entry) }}" 
                                              method="POST" 
                                              class="d-inline delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">No hay entradas de stock registradas.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $stockEntries->links() }}
            </div>
        </div>
    </div>
@endsection 