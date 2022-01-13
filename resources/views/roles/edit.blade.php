{{-- Vista para la actualización de roles --}}
{{-- Se llama el template a usar --}}
@extends('template')
{{-- Se agrega la miga de pan --}}
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
    <li class="breadcrumb-item"><a href="{{ route('roles.index') }}">Roles</a></li>
    <li class="breadcrumb-item active" aria-current="page">Editar Rol</li>
@endsection
{{-- se agrega el contenido principal de la vista --}}
@section('content')
    <div class="tituloMorado" style="width: 100%">
        <h2>EDITAR ROL</h2>
    </div>

    <form id="roleEditForm" action="{{ route('roles.update', $role) }}" method="POST" class="form"
        autocomplete="off">
        {{-- token csfr necesario para el envío del formulario --}}
        {{-- se agrega el metodo put al tratarse de una actualización --}}
        @csrf @method('PUT')
        <input type="hidden" name="selected" id="selected">
        <div class="row justify-content-center">
            @include('roles.form')
            <div class="col-md-8 my-3 text-center">
                <button type="button" data-toggle="modal" data-target="#confirmDialog"
                    class="btn btn-primary  btn-crear">Actualizar Rol<i class="fa fa-check"></i>
                </button>
            </div>
        </div>
    </form>
    {{-- Se incluye el cuadro de dialogo para la confirmación del envío del formulario --}}
    @include('partials.confirm-dialog',['mensaje'=>'¿Desea actualizar este rol?','formId'=>'roleEditForm'])

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
        jqDataTable.fn.dataTable.ext.order['dom-checkbox'] = function(settings, col) {
            return this.api().column(col, {
                order: 'index'
            }).nodes().map(function(td, i) {
                return jqDataTable('input', td).prop('checked') ? '1' : '0';
            });
        }
        jqDataTable(function() {
            jqDataTable("#tabla").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "info": false,
                "language": {
                    "searchPlaceholder": "Buscar",
                    "emptyTable": "No hay registros",
                    "info": "Mostrando del  _START_ al _END_ de _TOTAL_ registros",
                    "infoEmpty": "Showing 0 to 0 of 0 entries",
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

                },
                "buttons": false,
                "columns": [{
                        "orderDataType": "dom-checkbox"
                    },
                    null,
                    null,
                    null,
                ],
                "order": [
                    [0, "desc"]
                ]

            });
        });

        $(".form-check-input").click(function() {
            console.log(this.value);
        });
    </script>
@endpush
