@extends('layouts.app')

@section('title', 'Listado de Talleres')

@section('content')
    <h1>Talleres Disponibles</h1>
    <a href="{{ route('talleres.create') }}" class="btn btn-success mb-3">Crear Nuevo Taller</a>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @if (empty($talleres)) {{-- Ahora verificamos si el array está vacío --}}
        <p>No hay talleres registrados aún o hubo un error al cargarlos.</p>
    @else
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Instructor</th> {{-- El nombre del instructor vendrá de la API --}}
                    <th>Cupo Máximo</th>
                    <th>Costo</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($talleres as $taller)
                    <tr>
                        <td>{{ $taller['id'] }}</td> {{-- Accede como array asociativo --}}
                        <td>{{ $taller['nombre'] }}</td>
                        {{-- Esto asume que tu API de talleres incluye la información del instructor.
                             Si tu API de talleres solo devuelve instructor_id, necesitarás hacer otra petición
                             o adaptar la API para eager loading. --}}
                        <td>{{ $taller['instructor']['nombre'] ?? 'N/A' }}</td>
                        <td>{{ $taller['cupo_maximo'] }}</td>
                        <td>${{ number_format($taller['costo'], 2) }}</td>
                        <td>
                            <a href="{{ route('talleres.show', $taller['id']) }}" class="btn btn-info btn-sm">Ver</a>
                            <a href="{{ route('talleres.edit', $taller['id']) }}" class="btn btn-warning btn-sm">Editar</a>
                            <form action="{{ route('talleres.destroy', $taller['id']) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que quieres eliminar este taller?')">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection
