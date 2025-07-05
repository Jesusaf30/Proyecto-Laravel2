@extends('layouts.app')

@section('title', 'Editar Medicamento')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Editar Medicamento</h1>
        <a href="{{ route('medicines.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Volver
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('medicines.update', $medicine) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="name" class="form-label">Nombre</label>
                        <input type="text" 
                               class="form-control @error('name') is-invalid @enderror" 
                               id="name" 
                               name="name" 
                               value="{{ old('name', $medicine->name) }}" 
                               required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="laboratory" class="form-label">Laboratorio</label>
                        <input type="text" 
                               class="form-control @error('laboratory') is-invalid @enderror" 
                               id="laboratory" 
                               name="laboratory" 
                               value="{{ old('laboratory', $medicine->laboratory) }}" 
                               required>
                        @error('laboratory')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="price" class="form-label">Precio</label>
                        <div class="input-group">
                            <span class="input-group-text">$</span>
                            <input type="number" 
                                   class="form-control @error('price') is-invalid @enderror" 
                                   id="price" 
                                   name="price" 
                                   value="{{ old('price', $medicine->price) }}" 
                                   step="0.01" 
                                   min="0" 
                                   required>
                            @error('price')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="stock" class="form-label">Stock</label>
                        <input type="number" 
                               class="form-control @error('stock') is-invalid @enderror" 
                               id="stock" 
                               name="stock" 
                               value="{{ old('stock', $medicine->stock) }}" 
                               min="0" 
                               required>
                        @error('stock')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="expiration_date" class="form-label">Fecha de Vencimiento</label>
                        <input type="date" 
                               class="form-control @error('expiration_date') is-invalid @enderror" 
                               id="expiration_date" 
                               name="expiration_date" 
                               value="{{ old('expiration_date', $medicine->expiration_date->format('Y-m-d')) }}" 
                               required>
                        @error('expiration_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12 mb-3">
                        <label for="description" class="form-label">Descripción</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" 
                                  id="description" 
                                  name="description" 
                                  rows="3">{{ old('description', $medicine->description) }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save"></i> Actualizar
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection 