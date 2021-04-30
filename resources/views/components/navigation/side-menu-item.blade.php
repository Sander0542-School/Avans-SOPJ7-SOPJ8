<li id="menu-item-{{ $menuItem['slug'] }}">
    @if($menuItem['children'] != null)
        <div class="menu-item">
            <a href="#menu-{{ $menuItem['slug'] }}" data-toggle="collapse" aria-expanded="false" class="sidemenu-toggle">
                <i class="far"></i>
            </a>
            <a @if(!$firstLayer) onclick="window.Layer.load('{{ $menuItem['slug'] }}', {{ $subjectId }})" href="#{{ $menuItem['slug'] }}" @endif>{{ $menuItem['name'] }}</a>
        </div>
        <ul class="collapse list-unstyled" id="menu-{{ $menuItem['slug'] }}">
            @foreach($menuItem['children'] as $childItem)
                <x-navigation.side-menu-item :menu-item="$childItem" :subject-id="$subjectId"/>
            @endforeach
        </ul>
    @else
        <div class="menu-item single">
            <a @if(!$firstLayer) onclick="window.Layer.load('{{ $menuItem['slug'] }}', {{ $subjectId }})" href="#{{ $menuItem['slug'] }}" @endif>{{ $menuItem['name'] }}</a>
        </div>
    @endif
</li>
