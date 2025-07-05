@extends('layouts.app')

@section('title', 'Salidas de Stock')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Salidas de Stock</h1>
        <a href="{{ route('stock-exits.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg"></i> Nueva Salida
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
                            <th>Razón</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($stockExits as $exit)
                            <tr>
                                <td>{{ $exit->exit_date->format('d/m/Y') }}</td>
                                <td>{{ $exit->medicine->name }}</td>
                                <td>{{ $exit->quantity }}</td>
                                <td>${{ number_format($exit->unit_price, 2) }}</td>
                                <td>{{ $exit->reason }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('stock-exits.show', $exit) }}" 
                                           class="btn btn-sm btn-info text-white">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <a href="{{ route('stock-exits.edit', $exit) }}" 
                                           class="btn btn-sm btn-warning text-white">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="{{ route('stock-exits.destroy', $exit) }}" 
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
                                <td colspan="6" class="text-center">No hay salidas de stock registradas.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $stockExits->links() }}
            </div>
        </div>
    </div>
@endsection 