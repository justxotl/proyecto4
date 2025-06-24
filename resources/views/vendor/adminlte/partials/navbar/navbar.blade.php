@inject('layoutHelper', 'JeroenNoten\LaravelAdminLte\Helpers\LayoutHelper')

<nav
    class="main-header navbar
    {{ config('adminlte.classes_topnav_nav', 'navbar-expand') }}
    {{ config('adminlte.classes_topnav', 'navbar-white navbar-light') }}">

    {{-- Navbar left links --}}
    <ul class="navbar-nav">
        {{-- Left sidebar toggler link --}}
        @include('adminlte::partials.navbar.menu-item-left-sidebar-toggler')

        {{-- Configured left links --}}
        @each('adminlte::partials.navbar.menu-item', $adminlte->menu('navbar-left'), 'item')

        {{-- Custom left links --}}
        @yield('content_top_nav_left')
    </ul>

    {{-- Navbar right links --}}
    <ul class="navbar-nav ml-auto">
        {{-- Custom right links --}}
        @yield('content_top_nav_right')

        {{-- Configured right links --}}
        @each('adminlte::partials.navbar.menu-item', $adminlte->menu('navbar-right'), 'item')

        @can('Ver Manuales de MASTER')
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="opcionesDropdown" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false" title="Manuales de Administración">
                    <i class="fas fa-cogs"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="opcionesDropdown">
                    <a class="dropdown-item" href="{{ asset('manuales/Manual_de_Usuario_Gestor_de_Fichas.pdf') }}"
                        target="_blank">Manual de Usuario Maestro</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{ asset('manuales/Manual_Técnico_Gestor_de_Fichas.pdf') }}"
                        target="_blank"> Manual Técnico</a>
                </div>
            </li>
        @endcan

        @canany(['Ver Manual de ADMIN', 'Ver Manual de USER'])
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="manualesDropdown" role="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="Manuales de Usuario">
                    <i class="fas fa-book-open"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="manualesDropdown">
                    @can('Ver Manual de ADMIN')
                        <a class="dropdown-item"
                            href="{{ asset('manuales/Manual_de_Usuario_Gestor_de_Fichas_Nivel_ADMIN.pdf') }}" target="_blank">
                            Manual de Administrador
                        </a>
                    @endcan
                    @can('Ver Manuales de MASTER')<div class="dropdown-divider"></div>@endcan
                    @can('Ver Manual de USER')
                        <a class="dropdown-item"
                            href="{{ asset('manuales/Manual_de_Usuario_Gestor_de_Fichas_Nivel_USER.pdf') }}" target="_blank">
                            Manual de Consultas
                        </a>
                    @endcan
                </div>
            </li>
        @endcanany

        {{-- User menu link --}}
        @if (Auth::user())
            @if (config('adminlte.usermenu_enabled'))
                @include('adminlte::partials.navbar.menu-item-dropdown-user-menu')
            @else
                @include('adminlte::partials.navbar.menu-item-logout-link')
            @endif
        @endif

        {{-- Right sidebar toggler link --}}
        @if ($layoutHelper->isRightSidebarEnabled())
            @include('adminlte::partials.navbar.menu-item-right-sidebar-toggler')
        @endif
    </ul>

</nav>
