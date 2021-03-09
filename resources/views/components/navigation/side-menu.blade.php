<nav class="sidebar">
    <div class="sidebar-header">
        <h3>HAS Expeditiekaart</h3>
    </div>

    <ul class="list-unstyled components">
        @foreach($menu as $menuItem)
            <x-navigation.side-menu-item :menu-item="$menuItem" :first-layer="true"/>
        @endforeach
    </ul>
</nav>
