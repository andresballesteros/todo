{{-- pagina no encontrada --}}
@extends('template')

@section('title', 'Eror 404')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8 text-center">
            <img src="/img/pag_no_encontrada.png" alt="" height="200" width="200">
            <p class="error">NO SE HA ENCONTRADO LA PÁGINA SOLICITADA :(</p>
            <a href="/" class="btn btn-crear btn-error" style="" target="_self">VOLVER</a>
        </div>
    </div>
@endsection
