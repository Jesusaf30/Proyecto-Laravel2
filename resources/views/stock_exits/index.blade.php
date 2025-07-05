@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Salidas de Stock</h1>
    <a href="{{ route('stock-exits.create') }}" class="btn btn-primary">Nueva Salida</a>
</div>

<div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Fecha</th>
                <th>Medicina</th>
                <th>Cantidad</th>
                <th>Precio Unitario</th>
                <th>Razón</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($exits as $exit)
            <tr>
                <td>{{ $exit->exit_date->format('d/m/Y') }}</td>
                <td>{{ $exit->medicine->name }}</td>
                <td>{{ $exit->quantity }}</td>
                <td>${{ number_format($exit->unit_price, 2) }}</td>
                <td>{{ $exit->reason ?? 'N/A' }}</td>
                <td>
                    <div class="btn-group">
                        <a href="{{ route('stock-exits.show', $exit) }}" class="btn btn-sm btn-info">Ver</a>
                        <a href="{{ route('stock-exits.edit', $exit) }}" class="btn btn-sm btn-warning">Editar</a>
                        <form action="{{ route('stock-exits.destroy', $exit) }}" method="POST" class="d-inline">
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