@extends('layouts.app')

@section('content')
<div class="container">
    <div class="alert alert-warning">
        Ya tienes una sesión activa en otro dispositivo o navegador.
        <form action="{{ route('session.logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-danger mt-2">Cerrar sesión anterior y continuar</button>
        </form>
    </div>
</div>
@endsection
