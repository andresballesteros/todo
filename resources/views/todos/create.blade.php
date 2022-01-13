{{-- Vista para la creación de tareas --}}
{{-- Se llama el template a usar --}}
@extends('template')
{{-- Se agrega la miga de pan --}}
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
    <li class="breadcrumb-item active" aria-current="page">Crear Tarea</li>
@endsection
{{-- se agrega el contenido principal de la vista --}}
@section('content')
    <div class="tituloMorado" style="width: 100%">
        <h2>CREAR TAREA</h2>
    </div>

    <form id="todoCreateForm" action="{{ route('todos.store') }}" method="POST" class="form" autocomplete="off">
        {{-- token csfr necesario para el envío del formulario --}}
        @csrf

        <div class="row justify-content-center">
            {{-- se agrega el template del formulario para las tareas --}}
            @include('todos.form')
            <div class="col-md-8 my-3 text-center">
                <button type="button" data-toggle="modal" data-target="#confirmDialog"
                    class="btn btn-primary  btn-crear">Crear Tarea<i class="fa fa-check"></i>
                </button>
            </div>
        </div>
    </form>
    {{-- Se incluye el cuadro de dialogo para la confirmación del envío del formulario --}}
    @include('partials.confirm-dialog',['mensaje'=>'¿Desea crear esta tarea?','formId'=>'todoCreateForm'])

@endsection
