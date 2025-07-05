@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Entradas de Stock</h1>
    <a href="{{ route('stock-entries.create') }}" class="btn btn-primary">Nueva Entrada</a>
</div>

<div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Fecha</th>
                <th>Medicina</th>
                <th>Cantidad</th>
                <th>Precio Unitario</th>
                <th>Factura</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($entries as $entry)
            <tr>
                <td>{{ $entry->entry_date->format('d/m/Y') }}</td>
                <td>{{ $entry->medicine->name }}</td>
                <td>{{ $entry->quantity }}</td>
                <td>${{ number_format($entry->unit_price, 2) }}</td>
                <td>{{ $entry->invoice_number ?? 'N/A' }}</td>
                <td>
                    <div class="btn-group">
                        <a href="{{ route('stock-entries.show', $entry) }}" class="btn btn-sm btn-info">Ver</a>
                        <a href="{{ route('stock-entries.edit', $entry) }}" class="btn btn-sm btn-warning">Editar</a>
                        <form action="{{ route('stock-entries.destroy', $entry) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Está seguro?')">Eliminar</button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection 