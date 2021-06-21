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
    <div class="container">
        <div class="col-md-12 text-center">
            <a type="button" href="{{ route('admin.dashboard') }}" class="btn btn-primary btn-lg btn-block" style="background-color:#2E7D32;border-color:#2E7D32">Inloggen</a>
        </div>
    </div>

</nav>
