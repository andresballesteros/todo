@extends('template')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
    <li class="breadcrumb-item active" aria-current="page">Usuarios</li>
@endsection

@section('content')
    <div class="tituloMorado" style="width: 100%">
        <h2>USUARIOS</h2>
    </div>
    <div class="">


    </div>
    <div class="row justify-content-center">

        <div class="col-md-8 my-3">
            @if (auth()
            ->user()
            ->hasPermissionTo('Crear usuarios') ||
        auth()
            ->user()
            ->hasRole('admin') ||
        auth()
            ->user()
            ->hasRole('super-admin'))
                <a href="{{ route('usuarios.create') }}" class="btn btn-primary float-right btn-crear">Crear Usuario<i
                        class="fa fa-plus"></i>
                </a>
            @endif
        </div>

        <div class="col-md-8 py-3 rounded-lg" style="background-color: rgba(0, 0, 0, 0.05);">

            <table id="tabla" class="table table-bordered table-striped mb-5" data-page-length='10'>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>USUARIO</th>
                        <th>NOMBRE</th>
                        <th>ESTADO</th>
                        <th>FECHA DE CREACIÓN</th>
                        <th>ACCIONES</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($usuarios as $usuario)

                        <tr>
                            <td>{{ $usuario->id }}</td>
                            <td>{{ $usuario->email }}</td>
                            <td>{{ $usuario->name }}</td>
                            <td>{{ $usuario->active ? 'ACTIVO' : 'INACTIVO' }}</td>
                            <td>{{ $usuario->created_at->format('d/m/Y') }}</td>
                            <td>
                                @if (auth()
            ->user()
            ->hasPermissionTo('Ver usuarios') ||
        auth()
            ->user()
            ->hasRole('admin') ||
        auth()
            ->user()
            ->hasRole('super-admin'))
                                    <a href="{{ route('usuarios.show', $usuario) }}" class="btn btn-sm btn-primary"
                                        title="Ver usuario">
                                        <i class="fa fa-eye">
                                        </i>
                                    </a>
                                @endif
                                @if ((auth()
            ->user()
            ->hasPermissionTo('Actualizar usuarios') ||
            auth()
                ->user()
                ->hasRole('admin') ||
            auth()
                ->user()
                ->hasRole('super-admin')) &&
        $usuario->id !== 1 &&
        $usuario->id !== 2)

                                    <a href="{{ route('usuarios.edit', $usuario) }}" class="btn btn-sm btn-secondary"
                                        title="Editar usuario">
                                        <i class="fa fa-pen"></i>
                                    </a>
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
