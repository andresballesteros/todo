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
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf

                            <div class="form-group row">
                                <div class="col-md-10 offset-md-1">
                                    <p class="text-justify">Por favor ingrese su e-mail para continuar con el proceso de
                                        reestablecimiento de su
                                        contraseña.</p>
                                </div>
                                <div class="col-md-6 offset-md-3">
                                    <div class="inner-addon left-addon">
                                        <i class="fas fa-at"></i>
                                        <input id="email" type="email" placeholder="e-mail"
                                            class="form-control @error('email') is-invalid @enderror" name="email"
                                            value="{{ old('email') }}" required autocomplete="email" autofocus>

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-4 offset-md-4">
                                    <button type="submit" class="btn btn-primary btn-reset">
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
