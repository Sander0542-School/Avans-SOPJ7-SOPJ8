<li id="menu-item-{{ Str::slug($menuItem['name']) }}">
    @if($menuItem['children'] != null)
        <div class="menu-item">
            <a href="#menu-{{ Str::slug($menuItem['name']) }}" data-toggle="collapse" aria-expanded="false" class="sidemenu-toggle">
                <i class="far"></i>
            </a>
            <a @if(!$firstLayer) href="#{{ Str::slug($menuItem['name']) }}" @endif>{{ $menuItem['name'] }}</a>
        </div>
        <ul class="collapse list-unstyled" id="menu-{{ Str::slug($menuItem['name']) }}">
            @foreach($menuItem['children'] as $childItem)
                <x-navigation.side-menu-item :menu-item="$childItem"/>
            @endforeach
        </ul>
    @else
        <div class="menu-item single">
            <a href="#">{{ $menuItem['name'] }}</a>
        </div>
    @endif
</li>
