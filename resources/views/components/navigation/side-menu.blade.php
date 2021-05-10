<nav class="sidemenu">
    <div class="sidemenu-header">
        <div class="row">
            <img width="64" height="64" src="{{ asset('images/logo.png') }}" alt="{{ config('app.name') }}"/>
            <div class="col p-0">
                <h3>Expeditiekaart</h3>
                <h4>Bedrijfsovername</h4>
            </div>
        </div>
    </div>

    <ul class="list-unstyled components">
        @foreach($menu as $menuItem)
            <x-navigation.side-menu-item :menu-item="$menuItem" :subject-id="$menuItem['id']" :first-layer="true"/>
        @endforeach
    </ul>
</nav>
