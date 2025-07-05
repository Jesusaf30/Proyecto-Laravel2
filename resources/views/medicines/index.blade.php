@extends('layouts.app')

@section('title', 'Medicamentos')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Medicamentos</h1>
        <a href="{{ route('medicines.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg"></i> Nuevo Medicamento
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Laboratorio</th>
                            <th>Precio</th>
                            <th>Stock</th>
                            <th>Fecha de Vencimiento</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($medicines as $medicine)
                            <tr>
                                <td>{{ $medicine->name }}</td>
                                <td>{{ $medicine->laboratory }}</td>
                                <td>${{ number_format($medicine->price, 2) }}</td>
                                <td>
                                    <span class="badge bg-{{ $medicine->stock > 0 ? 'success' : 'danger' }}">
                                        {{ $medicine->stock }}
                                    </span>
                                </td>
                                <td>{{ $medicine->expiration_date->format('d/m/Y') }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('medicines.show', $medicine) }}" 
                                           class="btn btn-sm btn-info text-white">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <a href="{{ route('medicines.edit', $medicine) }}" 
                                           class="btn btn-sm btn-warning text-white">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="{{ route('medicines.destroy', $medicine) }}" 
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
                                <td colspan="6" class="text-center">No hay medicamentos registrados.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $medicines->links() }}
            </div>
        </div>
    </div>
@endsection 