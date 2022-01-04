<section class="aplicaciones my-5 mx-10">
    @include('partials.validation-errors')
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="row">
                <div class="col-md-4 divHerramientas menuAplicaciones">
                    <div class="tituloAplicaciones" style="width: 100%">
                        <h2>TUS APLICACIONES</h2>
                    </div>
                    <ul>
                        @if (auth()
        ->user()
        ->hasPermissionTo('Portal') ||
    auth()
        ->user()
        ->hasRole('admin') ||
    auth()
        ->user()
        ->hasRole('super-admin'))
                            <li>
                                <a href="https://fontur.com.co/es/user/login" target="_blank">MI PORTAL</a>
                                <br>
                                <small>Edita el contenido e imágenes del portal web</small>
                            </li>
                        @endif
                        @if (auth()
        ->user()
        ->hasPermissionTo('Herramientas') ||
    auth()
        ->user()
        ->hasRole('admin') ||
    auth()
        ->user()
        ->hasRole('super-admin'))

                            <li>
                                <a href="#"
                                    onclick="event.preventDefault();document.getElementById('formAplicaciones').submit();"
                                    target="_blank">TUS HERRAMIENTAS</a>

                                <form id="formAplicaciones" action="https://herramientas.fontur.info/fontl/" method="POST"
                                    class="d-none" target="_blank">
                                    <input type="hidden" name="correo" value="{{ auth()->user()->email }}">
                                    <input type="hidden" name="nombrecompleto" value="{{ auth()->user()->name }}">
                                    <input type="hidden" name="token" value="{{ auth()->user()->token }}">
                                </form>
                                <br>
                                <small>Ingresa al portal de herramientas FONTUR</small>
                            </li>
                        @endif
                        @if (auth()
        ->user()
        ->hasPermissionTo('Salesforce') ||
    auth()
        ->user()
        ->hasRole('admin') ||
    auth()
        ->user()
        ->hasRole('super-admin'))
                            <li>
                                <a href="https://login.salesforce.com/" target="_blank">SALESFORCE</a>
                                <br>
                                <small>Accede a tu CMR</small>
                            </li>
                        @endif
                        @if (auth()
        ->user()
        ->hasPermissionTo('Capacitaciones') ||
    auth()
        ->user()
        ->hasRole('admin') ||
    auth()
        ->user()
        ->hasRole('super-admin'))
                            <li>
                                <a href="https://fdxvirtual.fiducoldex.com.co/login/" target="_blank">CAPACITACIONES</a>
                                <br>
                                <small>Accede al portal de capacitaciones de fiducoldex</small>
                            </li>
                        @endif
                        @if (auth()
        ->user()
        ->hasPermissionTo('Centinela') ||
    auth()
        ->user()
        ->hasRole('admin') ||
    auth()
        ->user()
        ->hasRole('super-admin'))
                            <li>
                                <a href="https://fiducoldex.optima.net.co/Home/Index?ReturnUrl=%2FListas%2FDashboard%2FIndex" target="_blank">GIRO</a>
                                <br>
                                <small>Ingresa a Giro</small>
                            </li>
                        @endif
                        @if (auth()
        ->user()
        ->hasPermissionTo('Sinef') ||
    auth()
        ->user()
        ->hasRole('admin') ||
    auth()
        ->user()
        ->hasRole('super-admin'))
                            <li>
                                <a href="http://sinef.fiducoldex.com.co/sinef/">ATALAYA</a>
                                <br>
                                <small>Accede al aplicativo de ATALAYA</small>
                            </li>
                        @endif
                    </ul>
                </div>
                <div class="col-md-4 divHerramientas">
                    <div class="tituloAplicaciones colorMorado" style="width: 100%">
                        <h2>TU CORRESPONDENCIA</h2>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-8 correspondencia">
                            <form id="correspondenciaForm" action="{{ route('home.correspondencia.store') }}"
                                method="POST">
                                @csrf
                                <p>Registra tu correspondencia de forma fácil.</p>
                                <div class="form-group">
                                    <label for="de">DE:</label>
                                    <input class="form-control" id="de" value="{{ Auth::user()->name }}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="para">PARA:</label>
                                    <input name="para" class="form-control @error('para') is-invalid @enderror"
                                        id="para" placeholder="Ingrese el destinatario" value="{{ old('para') }}">
                                    @error('para')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="asunto">ASUNTO:</label>
                                    <textarea class="form-control @error('asunto') is-invalid @enderror" name="asunto"
                                        id="asunto"
                                        placeholder="Ingrese el asuto de la correspondencia">{{ old('asunto') }}</textarea>
                                    @error('asunto')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="text-center">
                                    <button type="button" data-toggle="modal" data-target="#confirmDialog"
                                        class="btn btn-primary  btn-correspondencia-home">
                                        REGISTRAR<i class="fas fa-caret-right pl-3"></i>
                                    </button>
                                </div>

                                @include('partials.confirm-dialog',['mensaje'=>'¿Desea registrar esta
                                correspondencia?','formId'=>'correspondenciaForm'])

                            </form>
                            <div class="text-center my-3">
                                <a href="{{ route('correspondencia.index') }}" class="primary" href="#">Consulta tu
                                    correspondencia aquí</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 reserva divHerramientas">
                    <div class="tituloAplicaciones colorRosa" style="width: 100%">
                        <h2>RESERVA UNA SALA</h2>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-8 correspondencia">
                            <p>Selecciona la sala y el horario que quieres reservar.</p>
                            <form>

                                <div class="form-group">
                                    <label for="sala">SALA:</label>
                                    <select class="form-control" id="exampleFormControlSelect1">
                                        <option>Seleccione una sala</option>
                                        <option>AMAZONÍA</option>
                                        <option>ANDES</option>
                                        <option>CAFETERÍA</option>
                                        <option>CARIBE</option>
                                        <option>ORINOQUÍA</option>
                                        <option>SALÓN MÚLTIPLE</option>

                                    </select>

                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
