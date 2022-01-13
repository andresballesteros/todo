{{-- Se llama el template a usar --}}
@extends('template')
{{-- Se agrega el título de la página --}}
@section('title', 'Inicio')
{{-- Se agrega la miga de pan --}}
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
@endsection
{{-- se agrega el contenido principal de la vista --}}
@section('content')
    <div class="tituloMorado" style="width: 100%">
        <h2>TAREAS</h2>
    </div>
    <div class="">


    </div>
    <div class="row justify-content-center">

        <div class="col-md-8 my-3">
            {{-- boton para ir al formulario de creacion de tareas --}}
            <a href="{{ route('todos.create') }}" class="btn btn-primary float-right btn-crear">Crear Tarea<i
                    class="fa fa-plus"></i>
            </a>
        </div>

        <div class="col-md-8 py-3 rounded-lg" style="background-color: rgba(0, 0, 0, 0.05);">
            {{-- Tabla para la presentacion de las tareas --}}
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
                    {{-- se recorre la variable todos para visualizar todas las tareas --}}
                    @foreach ($todos as $todo)

                        <tr>
                            <td>{{ $todo->id }}</td>
                            <td>{{ $todo->tarea }}</td>
                            <td>{{ $todo->active ? 'COMPLETADA' : 'INCOMPLETA' }}</td>
                            <td>{{ $todo->creatorUser->name }}</td>
                            <td>{{ $todo->created_at->format('d/m/Y H:i:s') }}</td>
                            <td>{{ $todo->updated_at->format('d/m/Y H:i:s') }}</td>
                            <td>
                                {{-- se implementa los botones de las acciones con sus respectivas restricciones --}}
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
                                    <form id="todoDeleteForm{{ $todo->id }}"
                                        action="{{ route('todos.destroy', $todo) }}" method="POST"
                                        style="display: inline-block">
                                        {{-- token csfr necesario para el envío del formulario --}}
                                        {{-- se agrega el metodo DELETE al tratarse de una eliminación --}}
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger show_confirm mb-1"
                                            data-toggle="tooltip" title='Delete'><i class="fa fa-ban"></i></button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>

        </div>

    </div>


@endsection

@push('styles')
    {{-- se agregan los estilos del datatable --}}
    @include('datatable.styles')
@endpush

@push('scripts')
    {{-- se incluyen los scripts necesarios para el datatable --}}
    @include('datatable.scripts')
    <script>
        /* configuracion del datatable */
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
    {{-- implementación y configuración de sweetalert --}}
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript">
        $('.show_confirm').click(function(event) {
            var form = $(this).closest("form");
            var name = $(this).data("name");
            event.preventDefault();
            Swal.fire({
                    title: '<div class="modal-header"><h5 class="modal-title" id="exampleModalLongTitle">Confirmación</h5></div>',
                    text: 'Al eliminar esta tarea se eliminarán todas las observaciones. ¿Desea eliminar esta tarea?',
                    buttons: true,
                    showCancelButton: true,
                    dangerMode: true,
                    customClass: {
                        container: 'modal',
                        htmlContainer: 'modal-body',
                        actions: 'modal-footer',
                        confirmButton: 'btn btn-primary btn-crear m-2',
                        cancelButton: 'btn btn-secondary btn-crear m-2'
                    },
                    cancelButtonText: 'Cancelar<i class="fa fa-times"></i>',
                    confirmButtonText: 'Aceptar<i class="fa fa-check"></i>',
                    buttonsStyling: false,
                    reverseButtons: true,
                })
                .then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
        });
    </script>

@endpush
