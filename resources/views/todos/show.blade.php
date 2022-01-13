{{-- Vista para la visualización de tareas --}}
{{-- Se llama el template a usar --}}
@extends('template')
{{-- Se agrega la miga de pan --}}
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
    <li class="breadcrumb-item active" aria-current="page">Ver Tarea</li>
@endsection
{{-- se agrega el contenido principal de la vista --}}
@section('content')
    <div class="tituloMorado" style="width: 100%">
        <h2>TAREA</h2>
    </div>
    {{-- presentación de la información de la tarea --}}
    <div class="row justify-content-center userShow row-eq-height">
        <div class="col-md-6">
            <div class="card h-100">
                <div class="card-header">Descripción de la tarea </div>
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
            {{-- validación para el renderizado de los botones de acción de la tarea --}}
            @if (auth()->user()->id == $todo->user_id && !$todo->active)
                <a href="{{ route('todo.complete', $todo) }}" data-confirm="¿Desea marcar como completada esta tarea?"
                    class="btn btn-success btn-crear" title="Marcar como tarea completada">Tarea Completada<i
                        class="fas fa-check"></i></a>
            @elseif(auth()->user()->id == $todo->user_id && $todo->active)
                <a href="{{ route('todo.incomplete', $todo) }}" data-confirm="¿Desea marcar como incompleta esta tarea?"
                    class="btn btn-danger btn-crear" title="Marcar como tarea incompleta">Tarea Incompleta<i
                        class="fas fa-times"></i></a>
            @endif
            @if (!$todo->active)
                <a href="{{ route('observaciones.create', $todo) }}" class="btn btn-secondary btn-crear">Agregar
                    Observación<i class="far fa-comment-dots"></i></a>
            @endif

            @if (auth()->user()->id == $todo->user_id)
                <a class="btn btn-danger btn-crear" title="Eliminar tarea" data-toggle="modal" data-target="#confirmDialog">
                    Eliminar Tarea<i class="fa fa-ban"></i>
                </a>
                <form id="todoDeleteForm" action="{{ route('todos.destroy', $todo) }}" method="POST"
                    style="display: inline-block">
                    {{-- token csfr necesario para el envío del formulario --}}
                    {{-- se agrega el metodo DELETE al tratarse de una eliminación --}}
                    @csrf @method('DELETE')
                </form>
            @endif
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="tituloMorado" style="width: 100%">
            <h2>OBSERVACIONES TAREA</h2>
        </div>
        <div class="col-md-8 py-3 rounded-lg" style="background-color: rgba(0, 0, 0, 0.05);">
            {{-- presentación de las observaciones de la tarea --}}
            <table id="tabla" class="table table-bordered table-striped mb-5" data-page-length='5'>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>OBSERVACIÓN</th>
                        <th>USUARIO</th>
                        <th>FECHA DE CREACIÓN</th>
                        <th>ACCIONES</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- se recorre la variable observacionesTodo para obetener todas las observaciones de la tarea --}}
                    @foreach ($observacionesTodo as $observacionTodo)

                        <tr>
                            <td>{{ $observacionTodo->id }}</td>
                            <td>{{ $observacionTodo->observacion }}</td>
                            <td>{{ $observacionTodo->creatorUser->name }}</td>
                            <td>{{ $observacionTodo->created_at->format('d/m/Y H:i:s') }}</td>
                            <td>
                                {{-- se valida el renderizado de los botones de acción de las observaciones de la tarea --}}
                                @if (auth()->user()->id == $observacionTodo->user_id && !$todo->active)

                                    <a href="{{ route('observaciones.edit', $observacionTodo) }}"
                                        class="btn btn-sm btn-secondary" title="Editar observación">
                                        <i class="fa fa-pen"></i>
                                    </a>
                                @endif
                                @if (auth()->user()->id == $observacionTodo->user_id && !$todo->active)
                                    <form id="observacionDeleteForm{{ $observacionTodo->id }}"
                                        action="{{ route('observaciones.destroy', $observacionTodo) }}" method="POST"
                                        style="display: inline-block">
                                        {{-- token csfr necesario para el envío del formulario --}}
                                        {{-- se agrega el metodo DELETE al tratarse de una eliminación --}}
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger show_confirm"
                                            data-toggle="tooltip" title='Eliminar tarea'><i
                                                class="fa fa-ban"></i></button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>

        </div>

    </div>
    {{-- Se incluye el cuadro de dialogo para la confirmación del envío del formulario de la eliminación de la tarea --}}
    @include('partials.confirm-dialog',['mensaje'=>'Al eliminar esta tarea se eliminarán todas las observaciones.
    ¿Desea eliminar esta tarea?','formId'=>'todoDeleteForm']))

@endsection
{{-- se agregan los estilos del datatable --}}
@push('styles')
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
                    text: '¿Desea eliminar esta observación?',
                    showCancelButton: true,
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
