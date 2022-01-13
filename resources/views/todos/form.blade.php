{{-- Template del formulario para la creación y actualización de tareas --}}
<div class="col-md-8">
    {{-- se incluye la el código para la presentacion de los mensajes de error --}}
    @include('partials.validation-errors')
</div>
<div class="col-md-8">
    <div class="form-group">
        <label for="tarea">Tarea</label>
        <textarea type="text" name="tarea" class="form-control @error('tarea') is-invalid @enderror" id="tarea"
            aria-describedby="tareaHelp"
            placeholder="Ingrese la descripción">{{ old('tarea', $todo->tarea) }}</textarea>
        @error('tarea')
            <span class="invalid-feedback d-block" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @else
            <small id="tareaHelp" class="form-text text-muted">Ingrese la descripción de la tarea.</small>
        @enderror
    </div>


    <div class="form-group form-check">
        <input name="active" type="checkbox" {{ $todo->active ? 'checked' : '' }} class="form-check-input"
            id="exampleCheck1">
        <label class="form-check-label" for="exampleCheck1" aria-describedby="activeHelp">Activo</label>
        <small id="activeHelp" class="form-text text-muted">Seleccione el estado de la tarea.</small>
    </div>
</div>
