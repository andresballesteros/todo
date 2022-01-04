@extends('template')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
    <li class="breadcrumb-item active" aria-current="page">Editar Tarea</li>
@endsection

@section('content')
    <div class="tituloMorado" style="width: 100%">
        <h2>EDITAR OBSERVACIÓN</h2>
    </div>

    <form id="userUpdateForm" action="{{ route('observaciones.update', $observacionTodo) }}" method="POST"
        class="form" autocomplete="off">
        @csrf @method('PUT')

        <div class="row justify-content-center">
            @include('observaciones.form')
            <div class="col-md-8 my-3 text-center">
                <button type="button" data-toggle="modal" data-target="#confirmDialog"
                    class="btn btn-primary  btn-crear">Actualizar Observación<i class="fa fa-check"></i>
                </button>
            </div>
        </div>
    </form>

    @include('partials.confirm-dialog',['mensaje'=>'¿Desea actualizar esta observación?','formId'=>'userUpdateForm'])

@endsection
