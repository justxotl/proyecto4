@inject('sidebarItemHelper', 'JeroenNoten\LaravelAdminLte\Helpers\SidebarItemHelper')
<!-- no es esto ? o por aqui? porque lit la carpeta se llama sidebar XDDDDDDDDDDDD -->
@if ($sidebarItemHelper->isHeader($item))

    {{-- Header --}}
    @include('adminlte::partials.sidebar.menu-item-header')

@elseif ($sidebarItemHelper->isLegacySearch($item) || $sidebarItemHelper->isCustomSearch($item))

    {{-- Search form --}}
    @include('adminlte::partials.sidebar.menu-item-search-form')

@elseif ($sidebarItemHelper->isMenuSearch($item))

    {{-- Search menu --}}
    @include('adminlte::partials.sidebar.menu-item-search-menu')

@elseif ($sidebarItemHelper->isSubmenu($item))

    {{-- Treeview menu --}}
    @include('adminlte::partials.sidebar.menu-item-treeview-menu')

@elseif ($sidebarItemHelper->isLink($item))

    {{-- Link --}}
    @include('adminlte::partials.sidebar.menu-item-link')

@endif
