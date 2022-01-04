@extends('template')

@section('content')
    <div class="container">
        <div class="row justify-content-center login">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-center bg-white border-0 mt-3 col-md-8 offset-md-2">
                        <a href="/"><img src="/img/logo.png" alt="Fontur" class="card-img-top"></a>
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('password.update') }}">
                            @csrf

                            <input type="hidden" name="token" value="{{ $token }}">

                            <div class="form-group row">
                                <div class="col-md-10 offset-md-1">
                                    <p class="text-justify">Para continuar con el proceso de restablecimiento de su
                                        contraseña, por favor
                                        complete los siguientes campos y de click en el boton restablecer </p>
                                </div>

                                <div class="col-md-6 offset-md-3">
                                    <div class="inner-addon left-addon">
                                        <i class="fas fa-at"></i>
                                        <input id="email" placeholder="e-mail" type="email"
                                            class="form-control @error('email') is-invalid @enderror" name="email"
                                            value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-6 offset-md-3">
                                    <div class="inner-addon left-addon">
                                        <i class="fas fa-key"></i>
                                        <input id="password" type="password" placeholder="Nueva Contraseña"
                                            class="form-control @error('password') is-invalid @enderror" name="password"
                                            required autocomplete="new-password">

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">


                                <div class="col-md-6 offset-md-3">
                                    <div class="inner-addon left-addon">
                                        <i class="fas fa-key"></i>
                                        <input id="password-confirm" type="password" class="form-control"
                                            placeholder="Confirmar Contraseña" name="password_confirmation" required
                                            autocomplete="new-password">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-4 offset-md-4">
                                    <button type="submit" class="btn btn-primary btn-restablecer">
                                        <i class="fas fa-caret-right"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
