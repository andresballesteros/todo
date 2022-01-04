@extends('template')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('home')}}">Inicio</a></li>
    <li class="breadcrumb-item active" aria-current="page">Roles</li>
@endsection

@section('content')
    <div class="tituloMorado" style="width: 100%">
        <h2>ROLES</h2>
    </div>
    <div class="">


    </div>
    <div class="row justify-content-center">

        <div class="col-md-8 my-3">
            @if(auth()->user()->hasPermissionTo('Crear roles') || auth()->user()->hasRole('admin') || auth()->user()->hasRole('super-admin'))
            <a href="{{ route('roles.create') }}" class="btn btn-primary float-right btn-crear">Crear Rol<i
                    class="fa fa-plus"></i>
            </a>
            @endif

        </div>

        <div class="col-md-8 py-3 rounded-lg" style="background-color: rgba(0, 0, 0, 0.05);">

            <table id="tabla" class="table table-bordered table-striped mb-5" data-page-length='10'>
                <thead>
                    <tr>
                        <th>ID</th>

                        <th>NOMBRE</th>
                        <th>DESCRIPCIÓN</th>
                        <th>PERMISOS</th>
                        <th>FECHA DE CREACIÓN</th>
                        <th>ACCIONES</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($roles as $role)

                        <tr>
                            <td>{{ $role->id }}</td>
                            <td>{{ $role->display_name }}</td>
                            <td>{{ $role->description }}</td>
                            <td>{{ $role->getPermissionNames()->implode(', ') }}</td>
                            <td>{{ $role->created_at->format('d/m/Y') }}</td>
                            <td>
                                @if(auth()->user()->hasPermissionTo('Ver roles') || auth()->user()->hasRole('admin') || auth()->user()->hasRole('super-admin'))
                                    <a href="{{ route('roles.show', $role) }}" class="btn btn-sm btn-primary" title="Ver rol">
                                        <i class="fa fa-eye">
                                        </i>
                                    </a>
                                @endif
                                @if(auth()->user()->hasPermissionTo('Actualizar roles') || auth()->user()->hasRole('admin') || auth()->user()->hasRole('super-admin'))
                                @if ($role->id !== 1 && $role->id !== 2)
                                    <a href="{{ route('roles.edit', $role) }}" class="btn btn-sm btn-secondary"
                                        title="Editar rol">
                                        <i class="fa fa-pen"></i>
                                    </a>
                                @endif
                                @endif
                                @if(auth()->user()->hasPermissionTo('Eliminar roles') || auth()->user()->hasRole('admin') || auth()->user()->hasRole('super-admin'))
                                    @if ($role->id !== 1 && $role->id !== 2)
                                        <a class="btn btn-sm btn-danger" title="Eliminar rol" data-toggle="modal"
                                            data-target="#confirmDialog">
                                            <i class="fa fa-times"></i>
                                        </a>
                                        <form id="roleDeleteForm" action="{{ route('roles.destroy', $role) }}" method="POST"
                                            style="display: inline-block">
                                            @csrf @method('DELETE')
                                        </form>
                                    @endif
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    @include('partials.confirm-dialog',['mensaje'=>'¿Desea eliminar este rol?','formId'=>'roleDeleteForm'])
                </tbody>

            </table>

        </div>

    </div>


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
                    "loadingRecords": "Cargando...",
                    "processing": "Procesando...",
                    "search": "",
                    "zeroRecords": "No se encontraron coincidencias",
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
                "columns": [
                    null,
                    null,
                    null,
                    null,
                    null,
                    {
                        "width": "15%"
                    },
                ],
                "buttons": [

                    {
                        extend: 'excel',
                        text: 'Excel'

                    }
                ]
            }).buttons().container().appendTo('#tabla_wrapper .col-md-5:eq(0)');

        });

    </script>

@endpush
