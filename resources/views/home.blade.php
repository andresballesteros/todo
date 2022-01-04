@extends('template')

@section('title', 'Inicio')


@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
@endsection

@section('content')
    <div class="tituloMorado" style="width: 100%">
        <h2>TAREAS</h2>
    </div>
    <div class="">


    </div>
    <div class="row justify-content-center">

        <div class="col-md-8 my-3">
            <a href="{{ route('todos.create') }}" class="btn btn-primary float-right btn-crear">Crear Tarea<i
                    class="fa fa-plus"></i>
            </a>
        </div>

        <div class="col-md-8 py-3 rounded-lg" style="background-color: rgba(0, 0, 0, 0.05);">

            <table id="tabla" class="table table-bordered table-striped mb-5" data-page-length='10'>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>TAREA</th>
                        <th>ESTADO</th>
                        <th>USUARIO</th>
                        <th>FECHA DE CREACIÓN</th>
                        <th>FECHA DE ÚLTIMA ACTUALIZACIÓN</th>
                        <th>ACCIONES</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($todos as $todo)

                        <tr>
                            <td>{{ $todo->id }}</td>
                            <td>{{ $todo->tarea }}</td>
                            <td>{{ $todo->active ? 'COMPLETADA' : 'INCOMPLETA' }}</td>
                            <td>{{ $todo->creatorUser->name }}</td>
                            <td>{{ $todo->created_at->format('d/m/Y H:i:s') }}</td>
                            <td>{{ $todo->updated_at->format('d/m/Y H:i:s') }}</td>
                            <td>

                                @if (auth()->user()->id == $todo->user_id && !$todo->active)
                                    <a href="{{ route('todo.complete', $todo) }}"
                                        data-confirm="¿Desea marcar como completada esta tarea?"
                                        class="btn btn-sm btn-success mb-1" title="Marcar como tarea completada">
                                        <i class="fas fa-check"></i></a>
                                @elseif(auth()->user()->id == $todo->user_id && $todo->active)
                                    <a href="{{ route('todo.incomplete', $todo) }}"
                                        data-confirm="¿Desea marcar como incompleta esta tarea?"
                                        class="btn btn-sm btn-danger mb-1" title="Marcar como tarea incompleta"><i
                                            class="fas fa-times"></i></a>
                                @endif
                                @if (!$todo->active)
                                    <a href="{{ route('observaciones.create', $todo) }}" class="btn btn-dark btn-sm mb-1"
                                        title="Agregar observación"><i class="far fa-comment-dots"></i></a>
                                @endif
                                <a href="{{ route('todos.show', $todo) }}" class="btn btn-sm btn-primary mb-1"
                                    title="Ver tarea">
                                    <i class="fa fa-eye">
                                    </i>
                                </a>

                                @if (auth()->user()->id == $todo->user_id && !$todo->active)

                                    <a href="{{ route('todos.edit', $todo) }}" class="btn btn-sm btn-secondary mb-1"
                                        title="Editar tarea">
                                        <i class="fa fa-pen"></i>
                                    </a>
                                @endif
                                @if (auth()->user()->id == $todo->user_id)
                                    <a class="btn btn-danger btn-sm mb-1" title="Eliminar tarea" data-toggle="modal"
                                        data-target="#confirmDialog"><i class="fa fa-ban"></i>
                                    </a>
                                    <form id="todoDeleteForm" action="{{ route('todos.destroy', $todo) }}" method="POST"
                                        style="display: inline-block">
                                        @csrf @method('DELETE')
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>

        </div>

    </div>

    @include('partials.confirm-dialog',['mensaje'=>'Al eliminar esta tarea se eliminarán todas las observaciones.
    ¿Desea eliminar esta tarea?','formId'=>'todoDeleteForm'])
@endsection

@push('styles')
    @include('datatable.styles')
@endpush

@push('scripts')
    @include('datatable.scripts')
    <script>
        var jqDataTable = $.noConflict(true);
        jqDataTable(function() {
            jqDataTable("#tabla").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "info": false,
                "language": {
                    "searchPlaceholder": "Buscar",
                    "decimal": "",
                    "emptyTable": "No hay registros",
                    "info": "Mostrando del  _START_ al _END_ de _TOTAL_ registros",
                    "infoEmpty": "Showing 0 to 0 of 0 entries",
                    "infoFiltered": "(filtered from _MAX_ total entries)",
                    "infoPostFix": "",
                    "thousands": ",",
                    "lengthMenu": "Show _MENU_ entries",
                    "loadingRecords": "Loading...",
                    "processing": "Processing...",
                    "search": "",
                    "zeroRecords": "No matching records found",
                    "paginate": {
                        "first": "<<",
                        "last": ">>",
                        "next": ">",
                        "previous": "<"
                    },
                    "aria": {
                        "sortAscending": ": activate to sort column ascending",
                        "sortDescending": ": activate to sort column descending"
                    }
                },
                "buttons": [{
                    extend: 'excel',
                    text: 'Excel'
                }]
            }).buttons().container().appendTo('#tabla_wrapper .col-md-5:eq(0)');

        });
    </script>

@endpush
