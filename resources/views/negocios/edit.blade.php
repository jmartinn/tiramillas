@extends('layouts.app')

@section('titulo', 'Editar negocio')

@section('content')
    <div class="form-wrapper">
        <h1>Editar negocio</h1>

        <form method="POST" action="{{ route('negocios.update', $negocio) }}" enctype="multipart/form-data" class="entity-form">
            @method('PATCH')
            @include('negocios._form')
            <button type="submit" class="btn btn-primary">Guardar cambios</button>
            <a href="{{ route('negocios.show', $negocio) }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
@endsection
