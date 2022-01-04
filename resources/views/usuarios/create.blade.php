@extends('template')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('home')}}">Inicio</a></li>
    <li class="breadcrumb-item"><a href="{{route('usuarios.index')}}">Usuarios</a></li>
    <li class="breadcrumb-item active" aria-current="page">Crear Usuario</li>
@endsection

@section('content')
    <div class="tituloMorado" style="width: 100%">
        <h2>CREAR USUARIO</h2>
    </div>

    <form id="userCreateForm" action="{{ route('usuarios.store') }}" method="POST" class="form" autocomplete="off">
        @csrf

        <div class="row justify-content-center">
            @include('usuarios.form')
            <div class="col-md-8 my-3 text-center">
                <button type="button" data-toggle="modal" data-target="#confirmDialog"
                    class="btn btn-primary  btn-crear">Crear Usuario<i class="fa fa-check"></i>
                </button>
            </div>
        </div>
    </form>

    @include('partials.confirm-dialog',['mensaje'=>'¿Desea crear este usuario?','formId'=>'userCreateForm'])

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
                "columnDefs": [{
                    orderable: false,
                    className: 'select-checkbox',
                    targets: 0
                }],
                "select": {
                    style: 'os',
                    selector: 'td:first-child'
                },
                "buttons": false,
            });
        });

    </script>
@endpush
