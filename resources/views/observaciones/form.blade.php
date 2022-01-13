{{-- Template del formulario para la creación y actualización de observaciones --}}
<div class="col-md-8">
    {{-- se incluye la el código para la presentacion de los mensajes de error --}}
    @include('partials.validation-errors')
</div>
<div class="col-md-8">
    <div class="form-group">
        <label for="tarea">Observación</label>
        <textarea type="text" name="observacion" class="form-control @error('observacion') is-invalid @enderror"
            id="observacion" aria-describedby="observacionHelp"
            placeholder="Ingrese la observación">{{ old('observacion', $observacionTodo->observacion) }}</textarea>
        @error('observacion')
            <span class="invalid-feedback d-block" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @else
            <small id="observacionHelp" class="form-text text-muted">Ingrese la observación de la tarea.</small>
        @enderror
    </div>
</div>
