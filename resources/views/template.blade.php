<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title','Administrador Formulario Aliados | Tarjeta Joven')</title>
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <link rel="stylesheet" href="{{ mix('css/cheeseburger_menu.css') }}">
    <link rel="icon" type="image/png" href="">
    @stack('styles')
    <script src="{{ mix('js/app.js') }}" defer></script>
    <script src="{{ mix('js/cheeseburger_menu.js') }}" defer></script>


</head>

<body
    class="{{ request()->is('/') ? 'bg-image-login' : '' }} 
    {{ request()->is('password/reset*') ? 'bg-image-login' : '' }} bg-white">
    @auth
        <div id="loader" class="loader"></div>
    @endauth
    <div id="app" class="d-flex flex-column h-screen justify-content-between">
        <header>

            @include('partials/nav')

        </header>
        <main class="py-3">
            @auth

                <section class="welcome">
                    <img src="/img/bienvenido.png" alt="Bienvenido">
                    <h3 class="pt-2">{{ Auth::user()->name }}</h3>
                </section>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        @yield('breadcrumb')
                    </ol>
                </nav>
                @include('partials.flash-messages')
            @endauth
            <div class="container" style="max-width: 100%">
                @yield('content')
            </div>
        </main>


        <footer class="d-block">
            <div class="footer-login bg-white text-black-50 text-center shadow">
                &copy; {{ date('Y') }}, UNIVERSIDAD DE LA RIOJA <br>
                <a href="https://unir.edu.co/" target="_blank">UNIR</a>
                {{ date('Y') }}
            </div>
        </footer>
    </div>

    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script type="text/javascript">
        $(window).load(function() {
            $(".loader").fadeOut("slow");
        });
    </script>
    <script src="/js/confirm.js"></script>
    @stack('scripts')
</body>

</html>
