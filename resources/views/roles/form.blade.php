{{-- Template del formulario para la creación y actualización de roles --}}
<div class="col-md-8">
    {{-- se incluye la el código para la presentacion de los mensajes de error --}}
    @include('partials.validation-errors')
</div>
<div class="col-md-8">
    <div class="form-group">
        <label for="name">Nombre</label>
        {{-- Se valida la ruta actual para el renderizado de los campos --}}
        @if (Route::currentRouteName() == 'roles.create')

            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name"
                aria-describedby="nameHelp" placeholder="Ingrese el nombre" value="{{ old('name', $role->name) }}">
            @error('name')
                <span class="invalid-feedback d-block" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @else
                <small id="nameHelp" class="form-text text-muted">Nombre del rol</small>
            @enderror
        @else
            <input type="text" name="display_name" class="form-control @error('display_name') is-invalid @enderror"
                id="display_name" aria-describedby="display_nameHelp" placeholder="Ingrese el nombre"
                value="{{ old('name', $role->display_name) }}">
            @error('display_name')
                <span class="invalid-feedback d-block" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @else
                <small id="nameHelp" class="form-text text-muted">Nombre del rol</small>
            @enderror
        @endif
    </div>
    <div class="form-group">
        <label for="description">DESCRIPCION</label>
        <textarea type="description" name="description" style="resize: none;"
            class="form-control @error('description') is-invalid @enderror" id="description"
            aria-describedby="descriptionHelp" placeholder="Ingrese la descripción"
            autocomplete="off">{{ old('description', $role->description) }}</textarea>
        @error('description')
            <span class="invalid-feedback d-block" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @else
            <small id="descriptionHelp" class="form-text text-muted">Ingrese una breve descripción del rol</small>
        @enderror
    </div>
    <label for="permissions" aria-describedby="permissionsHelp">Seleccione los permisos</label>
    @error('permissions')
        <span class="invalid-feedback d-block" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
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
            {{-- se recorre la variable permissions para visualizar todos los permisos --}}
            @foreach ($permissions as $permission)
                <tr>
                    <td><input name="permissions[]" data-id="{{ $permission->id }}" class="form-check-input"
                            type="checkbox" value="{{ $permission->name }}" id="defaultCheck{{ $permission->id }}"
                            {{ $role->hasPermissionTo($permission->name) || collect(old('permissions'))->contains($permission->name) ? 'checked' : '' }}>
                    </td>
                    <td>{{ $permission->id }}</td>
                    <td>{{ $permission->name }}</td>
                    <td>{{ $permission->description }}</td>

                </tr>
            @endforeach
        </tbody>

    </table>

</div>
