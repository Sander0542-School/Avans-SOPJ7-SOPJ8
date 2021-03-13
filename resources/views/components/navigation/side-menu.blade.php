<nav class="sidemenu active">
    <div class="sidemenu-header">
        <h3>HAS Expeditiekaart</h3>
    </div>

    <ul class="list-unstyled components">
        @foreach($menu as $menuItem)
            <x-navigation.side-menu-item :menu-item="$menuItem" :first-layer="true"/>
        @endforeach
    </ul>

    <div class="sidemenu-control">
        <button onclick="toggleSideMenu()" class="btn btn-primary">Sidemenu</button>
    </div>
</nav>
