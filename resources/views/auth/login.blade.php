{{-- vista del login --}}
@extends('template')

@section('content')
    <div class="container">
        <div class="row justify-content-center login">
            <div class="col-lg-5">
                <div class="card">
                    <div class="card-header text-center bg-white border-0 mt-3">
                        <a href="/"><img src="img/logo-1.png" style="width: 100px" alt="Logo" class="card-img-top"></a>
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="form-group row mb-4">
                                <div class="col-md-8 offset-md-2">
                                    <div class="inner-addon left-addon">
                                        <i class="fas fa-user"></i>
                                        <input id="email" type="email"
                                            class="form-control my-4 @error('email') is-invalid @enderror" name="email"
                                            value="{{ old('email') }}" autocomplete="email" autofocus
                                            placeholder="Usuario">

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row my-4">
                                <div class="col-md-8 offset-md-2">
                                    <div class="inner-addon left-addon">
                                        <i class="fas fa-key"></i>
                                        <input id="password" type="password"
                                            class="form-control mb-4 @error('password') is-invalid @enderror"
                                            name="password" autocomplete="current-password" placeholder="Contraseña">

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
                                    <button type="submit" class="btn btn-primary btn-block btn-login">
                                        <i class="fas fa-caret-right"></i>
                                    </button>

                                </div>
                            </div>

                            <div class="form-group row mb-0 justify-content-center align-self-center">
                                <div class="col-md-6 ">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                            {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-6" style="text-align: center;">
                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
