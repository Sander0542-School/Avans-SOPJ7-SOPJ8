<nav class="sidemenu">
    <div class="sidemenu-header">
        <h3>Expeditiekaart</h3>
        <h4>Bedrijfsovername</h4>
    </div>

    <ul class="list-unstyled components">
        @foreach($menu as $menuItem)
            <x-navigation.side-menu-item :menu-item="$menuItem" :first-layer="true"/>
        @endforeach
    </ul>
</nav>
