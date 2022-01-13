{{-- Vista de información del rol --}}
{{-- Se llama el template a usar --}}
@extends('template')
{{-- Se agrega la miga de pan --}}
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
    <li class="breadcrumb-item"><a href="{{ route('roles.index') }}">Roles</a></li>
    <li class="breadcrumb-item active" aria-current="page">Ver Rol</li>
@endsection
{{-- se agrega el contenido principal de la vista --}}
@section('content')
    <div class="tituloMorado" style="width: 100%">
        <h2>VER ROL</h2>
    </div>
    <div class="row justify-content-center userShow">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Información del rol </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="name">Nombre</label>
                        <input type="text" name="name" class="form-control" value="{{ $role->display_name }}" readonly>
                    </div>

                    <div class="form-group">
                        <label>Permisos</label>
                        <textarea class="form-control" style="resize: none"
                            readonly>{{ $role->getPermissionNames()->implode(', ') }}</textarea>
                    </div>
                    {{-- validacion de permisos para el renderizado del boton de creación de roles --}}
                    @if ((auth()
            ->user()
            ->hasPermissionTo('Actualizar roles') ||
            auth()
                ->user()
                ->hasRole('admin') ||
            auth()
                ->user()
                ->hasRole('super-admin')) &&
        ($role->id !== 1 && $role->id !== 2))
                        <div class="text-center">
                            <a href="{{ route('roles.edit', $role) }}" class="btn btn-primary  btn-crear">Editar rol<i
                                    class="fa fa-pen"></i>
                            </a>
                        </div>
                    @endcan
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">Información del rol en el sistema</div>
            <div class="card-body">
                <div class="form-group">
                    <label for="name">role creador</label>
                    <input type="text" name="name" class="form-control" id="name" value="{{ $role->creatorUser->name }}"
                        readonly />
                </div>
                <div class="form-group">
                    <label for="name">Fecha de creación</label>
                    <input type="text" name="name" class="form-control" id="name"
                        value="{{ $role->created_at->format('d/m/Y H:i:s') }}" readonly />
                </div>



                <div class="form-group">
                    <label for="name">role última actulización</label>
                    <input type="text" name="name" class="form-control" id="name" value="{{ $role->updaterUser->name }}"
                        readonly />
                </div>
                <div class="form-group">
                    <label for="name">Fecha última actulización</label>
                    <input type="text" name="name" class="form-control" id="name"
                        value="{{ $role->updated_at->format('d/m/Y H:i:s') }}" readonly />
                </div>

            </div>
        </div>
    </div>
</div>

@endsection
