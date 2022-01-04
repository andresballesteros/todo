@auth

    <nav class="navbar fixed-top navbar-light  bg-primary shadow-sm justify-content-between">


        <div class="card-header text-center bg-primary border-0 d-flex">
            <section id="block-cheeseburgermenu" class="block block-cheeseburger-menu block-cheesebuger-menu-block clearfix">
                <div class="cheeseburger-menu__trigger"></div>
                <div class="cheeseburger-menu__wrapper fixed-top">
                    <div class="cheeseburger-menu__menus">
                        <div class="cheeseburger-menu__menu cheeseburger-menu__menu--main cheeseburger-menu__menu--active"
                            data-drupal-selector="cheeseburger-menu--main">
                            <span class="cheeseburger-menu__menu-list-trigger"></span>
                            <ul class="cheeseburger-menu__menu-list">
                                <ul class="cheeseburger-menu__menu-list">
                                    <li class="cheeseburger-menu__menu-list-item cheeseburger-menu__menu-list-item--child">
                                        <a href="/home" class="cheeseburger-menu__menu-list-item-link ">INICIO</a>
                                    </li>
                                    @if (auth()->user()->hasPermissionTo('Ver usuarios') ||
        auth()->user()->hasPermissionTo('Ver roles') ||
        auth()->user()->hasRole('admin') ||
        auth()->user()->hasRole('super-admin'))

                                        <li
                                            class="cheeseburger-menu__menu-list-item cheeseburger-menu__menu-list-item--parent cheeseburger-menu__menu-list-item--expanded">
                                            <span
                                                class="cheeseburger-menu__menu-list-item-link cheeseburger-menu__menu-list-item-link--span">ADMINISTRACIÓN</span>
                                            <ul class="cheeseburger-menu__menu-list">
                                                @if (auth()->user()->hasPermissionTo('Ver usuarios') ||
        auth()->user()->hasRole('admin') ||
        auth()->user()->hasRole('super-admin'))

                                                    <li
                                                        class="cheeseburger-menu__menu-list-item cheeseburger-menu__menu-list-item--child">
                                                        <a href="{{ route('usuarios.index') }}"
                                                            class="cheeseburger-menu__menu-list-item-link ">Usuarios</a>

                                                    </li>
                                                @endif
                                                @if (auth()->user()->hasPermissionTo('Ver roles') ||
        auth()->user()->hasRole('admin') ||
        auth()->user()->hasRole('super-admin'))
                                                    <li
                                                        class="cheeseburger-menu__menu-list-item cheeseburger-menu__menu-list-item--child">
                                                        <a href="{{ route('roles.index') }}"
                                                            class="cheeseburger-menu__menu-list-item-link ">Roles</a>

                                                    </li>
                                                @endif
                                            </ul>

                                        </li>
                                    @endif
                                </ul>
                            </ul>
                        </div>
                    </div>
                </div>

            </section>
            <div>
                <h3 class="menu-text">MENÚ</h3>
            </div>
        </div>
        <div class="card-header text-center bg-primary border-0">
            <a href="{{ route('home') }}" class="branding-nav"><img src="" alt="Logo"
                    class="card-img-top"></a>
        </div>
        <div class="nav-item dropdown" id="">

            <a class="nav-link" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"
                aria-expanded="false">
                <i class="fas fa-user text-white" style="font-size: 25px"></i>
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">

                <a class="dropdown-item" href="{{ route('user.profile') }}">Perfil</a>

                <a class="dropdown-item" href="#" onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">Cerrar
                    sesión</a>
            </div>
        </div>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>

    @endauth
