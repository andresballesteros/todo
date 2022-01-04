@extends('template')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
    <li class="breadcrumb-item"><a href="{{ route('usuarios.index') }}">Usuarios</a></li>
    <li class="breadcrumb-item active" aria-current="page">Ver Usuario</li>
@endsection

@section('content')
    <div class="tituloMorado" style="width: 100%">
        <h2>USUARIO</h2>
    </div>
    <div class="row justify-content-center userShow">
        <div class="col-md-4">
            <div class="card h-100">
                <div class="card-header">Información del usuario </div>
                <div class="card-body">
                    <div class="form-group">
                        <label>Usuario</label>
                        <input class="form-control" id="email" value="{{ $usuario->email }}" readonly>
                    </div>
                    <div class="form-group">
                        <label>Nombre</label>
                        <input type="text" class="form-control" value="{{ $usuario->name }}" readonly>
                    </div>
                    <div class="form-group">
                        <label>Estado</label>
                        <input type="text" class="form-control" value="{{ $usuario->active ? 'ACTIVO' : 'INACTIVO' }}"
                            readonly>
                    </div>
                    <div class="form-group">
                        <label>Roles</label>
                        <input type="text" class="form-control" value="{{ $usuario->getRoleNames()->implode(', ') }}"
                            readonly>
                    </div>
                    <div class="form-group">
                        <label>Permisos</label>
                        <input type="text" class="form-control"
                            value="{{ $usuario->getAllPermissions()->pluck('name')->implode(', ') }}" readonly>
                    </div>
                    @if (auth()->user()->hasPermissionTo('Actualizar usuarios') ||
        auth()->user()->hasRole('admin') ||
        auth()->user()->hasRole('super-admin'))
                        <div class="text-center">
                            <a href="{{ route('usuarios.edit', $usuario) }}" class="btn btn-primary  btn-crear">Editar
                                Usuario<i class="fa fa-pen"></i>
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card h-100">
                <div class="card-header">Información del usuario en el sistema</div>
                <div class="card-body">
                    <div class="form-group">
                        <label>Usuario creador</label>
                        <input type="text" class="form-control" value="{{ $usuario->creatorUser->name }}" readonly />
                    </div>
                    <div class="form-group">
                        <label>Fecha de creación</label>
                        <input type="text" class="form-control"
                            value="{{ $usuario->created_at->format('d/m/Y H:i:s') }}" readonly />
                    </div>

                    <div class="form-group">
                        <label>Usuario última actulización</label>
                        <input type="text" class="form-control" value="{{ $usuario->updaterUser->name }}" readonly />
                    </div>
                    <div class="form-group">
                        <label>Fecha última actulización</label>
                        <input type="text" class="form-control"
                            value="{{ $usuario->updated_at->format('d/m/Y H:i:s') }}" readonly />
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
