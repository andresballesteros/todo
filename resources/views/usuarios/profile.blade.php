{{-- Vista del perfil de usuarios --}}
{{-- Se llama el template a usar --}}
@extends('template')
{{-- Se agrega la miga de pan --}}
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
    <li class="breadcrumb-item active" aria-current="page">Perfil</li>
@endsection
{{-- se agrega el contenido principal de la vista --}}
@section('content')

    <div class="tituloMorado" style="width: 100%">
        <h2>TU PERFIL</h2>
    </div>
    {{-- se incluye la el código para la presentacion de los mensajes de error --}}
    @include('partials.validation-errors')
    <div class="row justify-content-center userShow">

        <div class="col-md-4">
            <div class="card h-100">
                <div class="card-header">Información del usuario </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="email">Usuario</label>
                        <input name="email" class="form-control" id="email" value="{{ $usuario->email }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="name">Nombre</label>
                        <input type="text" name="name" class="form-control" id="name" value="{{ $usuario->name }}"
                            readonly>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card h-100">
                {{-- formulario para el cambio de contraseña --}}
                <div class="card-header">Cambia tu contraseña aquí</div>
                <div class="card-body">
                    <form id="updatePasswordForm" action="{{ route('user.updatePassword', $usuario) }}" method="post">
                        @csrf @method('PUT')
                        <div class="form-group">
                            <label for="password">Contraseña</label>
                            <input type="password" name="password"
                                class="form-control @error('password') is-invalid @enderror" id="password"
                                aria-describedby="passwordHelp" placeholder="Ingrese el password" autocomplete="off">
                            @error('password')
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @else
                                <small id="passwordHelp" class="form-text text-muted">Ingrese la contraseña para el acceso
                                    del
                                    aplicativo</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password_confirmation">Confirme la contraseña</label>
                            <input type="password" name="password_confirmation"
                                class="form-control @error('password_confirmation') is-invalid @enderror"
                                id="password_confirmation" aria-describedby="password_confirmHelp"
                                placeholder="Confirme el password">
                            @error('password_confirmation')
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @else
                                <small id="password_confirmHelp" class="form-text text-muted">Confirme la contraseña</small>
                            @enderror
                        </div>
                        <div class="col-md-12 my-3 text-center">
                            <button type="button" data-toggle="modal" data-target="#confirmDialog"
                                class="btn btn-primary  btn-crear">Cambiar<i class="fa fa-check"></i>
                            </button>
                        </div>
                    </form>
                    {{-- Se incluye el cuadro de dialogo para la confirmación del envío del formulario --}}
                    @include('partials.confirm-dialog',['mensaje'=>'¿Deseas cambiar tu
                    contraseña?','formId'=>'updatePasswordForm'])
                </div>
            </div>
        </div>
    </div>

@endsection
