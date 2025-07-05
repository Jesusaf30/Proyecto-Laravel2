<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Inventario - @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4">
        <div class="container">
            <a class="navbar-brand" href="{{ route('medicines.index') }}">Inventario Farmacia</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('medicines.*') ? 'active' : '' }}" 
                           href="{{ route('medicines.index') }}">Medicamentos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('stock-entries.*') ? 'active' : '' }}" 
                           href="{{ route('stock-entries.index') }}">Entradas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('stock-exits.*') ? 'active' : '' }}" 
                           href="{{ route('stock-exits.index') }}">Salidas</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Confirm deletion
        document.addEventListener('submit', function(e) {
            if (e.target.classList.contains('delete-form')) {
                if (!confirm('¿Está seguro de que desea eliminar este registro?')) {
                    e.preventDefault();
                }
            }
        });
    </script>
</body>
</html> 