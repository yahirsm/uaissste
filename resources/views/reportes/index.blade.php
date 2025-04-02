@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Reportes</h2>
    <p>Selecciona el tipo de reporte que deseas generar:</p>

    <ul>
        <li><a href="{{ route('inventario.pdf') }}" class="btn btn-danger">Reporte General de Inventario (PDF)</a></li>
        {{-- Agregar más reportes aquí --}}
    </ul>
</div>
@endsection
