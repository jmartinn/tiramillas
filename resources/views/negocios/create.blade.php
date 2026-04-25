@extends('layouts.app')

@section('titulo', 'Crear negocio')

@section('content')
    <div class="form-wrapper">
        <h1>Registrar mi negocio</h1>

        <form method="POST" action="{{ route('negocios.store') }}" enctype="multipart/form-data" class="entity-form">
            @include('negocios._form')
            <button type="submit" class="btn btn-primary">Crear negocio</button>
            <a href="{{ route('negocios.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
@endsection
