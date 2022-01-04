<div class="col-md-8">
    @include('partials.validation-errors')
</div>
<div class="col-md-8">
    <div class="form-group">
        <label for="email">E-mail</label>
        <input name="email" class="form-control  @error('email') is-invalid @enderror" id="email"
            aria-describedby="emailHelp" placeholder="Ingrese el e-mail" value="{{ old('email', $usuario->email) }}"
            autocomplete="off">
        @error('email')
            <span class="invalid-feedback d-block" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @else
            <small id="emailHelp" class="form-text text-muted">Este correo corresponderá al usuario del
                aplicativo</small>
        @enderror
    </div>
    <div class="form-group">
        <label for="name">Nombre</label>
        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name"
            aria-describedby="nameHelp" placeholder="Ingrese el nombre" value="{{ old('name', $usuario->name) }}">
        @error('name')
            <span class="invalid-feedback d-block" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @else
            <small id="nameHelp" class="form-text text-muted">Nombre del usuario</small>
        @enderror
    </div>   
    
       @if (Route::current()->getName() == 'usuarios.edit')
        <div class="form-group form-check">
            <input name="active" type="checkbox" {{ $usuario->active ? 'checked' : '' }} class="form-check-input"
                id="exampleCheck1">
            <label class="form-check-label" for="exampleCheck1" aria-describedby="activeHelp">Activo</label>
            <small id="activeHelp" class="form-text text-muted">Estado que permitirá el ingreso al aplicativo</small>
        </div>
    @endif
    <div class="form-group">
        <label for="password">Contraseña</label>
        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
            id="password" aria-describedby="passwordHelp" placeholder="Ingrese el password" autocomplete="off">
        @error('password')
            <span class="invalid-feedback d-block" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @else
            <small id="passwordHelp" class="form-text text-muted">Ingrese la contraseña para el acceso del
                aplicativo</small>
        @enderror
    </div>

    <div class="form-group">
        <label for="password_confirmation">Confirme la contraseña</label>
        <input type="password" name="password_confirmation"
            class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation"
            aria-describedby="password_confirmHelp" placeholder="Confirme el password">
        @error('password_confirmation')
            <span class="invalid-feedback d-block" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @else
            <small id="password_confirmHelp" class="form-text text-muted">Confirme la contraseña</small>
        @enderror
    </div>
    <label for="password_confirm">Seleccione los roles</label>
</div>

<div class="col-md-8 py-3 rounded-lg" style="background-color: rgba(0, 0, 0, 0.05);">

    <table id="tabla" class="table table-bordered table-striped mb-5" data-page-length='10'>
        <thead>
            <tr>
                <th></th>
                <th>ID</th>
                <th>NOMBRE</th>
                <th>DESCRIPCIÓN</th>


            </tr>
        </thead>
        <tbody>
            @foreach ($roles as $rol)
                <tr>
                    <td><input name="roles[]" class="form-check-input" type="checkbox" value="{{ $rol->name }}"
                            id="defaultCheck{{ $rol->id }}"
                            {{ $usuario->roles->contains($rol) || collect(old('roles'))->contains($rol->name) ? 'checked' : '' }}>
                    </td>
                    <td>{{ $rol->id }}</td>
                    <td>{{ $rol->display_name }}</td>
                    <td>{{ $rol->description }}</td>

                </tr>
            @endforeach
        </tbody>

    </table>

</div>
@push('scripts')
    {{-- <script src="/adminlte/plugins/jquery/jquery.min.js"></script> --}}
    <script src="/js/cargos.js"></script>

@endpush
