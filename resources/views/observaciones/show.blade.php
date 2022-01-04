@extends('template')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
    <li class="breadcrumb-item active" aria-current="page">Ver Tarea</li>
@endsection

@section('content')
    <div class="tituloMorado" style="width: 100%">
        <h2>OBSERVACIÓN</h2>
    </div>
    <div class="row justify-content-center userShow row-eq-height">
        <div class="col-md-6">
            <div class="card h-100">
                <div class="card-header">Observación de la tarea </div>
                <div class="card-body">
                    <div class="form-group">
                        <label>Tarea</label>
                        <textarea class="form-control" id="email" readonly>{{ $todo->tarea }}</textarea>
                    </div>
                    <div class="form-group">
                        <label>Estado</label>
                        <input type="text" class="form-control"
                            value="{{ $todo->active ? 'COMPLETADA' : 'INCOMPLETA' }}" readonly>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card h-100">
                <div class="card-header">Información de la tarea </div>
                <div class="card-body">
                    <div class="form-group">
                        <label>Usuario</label>
                        <input type="text" class="form-control" value="{{ $todo->creatorUser->name }}" readonly>
                    </div>
                    <div class="form-group">
                        <label>Fecha de creación</label>
                        <input type="text" class="form-control" value="{{ $todo->created_at->format('d/m/Y H:i:s') }}"
                            readonly />
                    </div>
                    <div class="form-group">
                        <label>Fecha última actulización</label>
                        <input type="text" class="form-control" value="{{ $todo->updated_at->format('d/m/Y H:i:s') }}"
                            readonly />
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 text-center py-3">
            @if (auth()->user()->id == $todo->user_id && !$todo->active)
                <a href="" class="btn btn-success btn-crear" title="Marcar como tarea completada">Tarea Completada<i
                        class="fas fa-check"></i></a>
            @elseif(auth()->user()->id == $todo->user_id && $todo->active)
                <a href="" class="btn btn-danger btn-crear" title="Marcar como tarea incompleta">Tarea Incompleta<i
                        class="fas fa-times"></i></a>
            @endif
            <div class="col-md-8 my-3 text-center">
                <button type="button" data-toggle="modal" data-target="#observacionDialog"
                    class="btn btn-secondary btn-crear">Agregar Comentario<i class="far fa-comment-dots"></i>
                </button>
            </div>
            @if (auth()->user()->id == $todo->user_id)
                <a href="" class="btn btn-danger btn-crear">Eliminar Tarea<i class="fas fa-ban"></i></a>
            @endif
        </div>
    </div>

@endsection
@include('partials.observacion-dialog')
