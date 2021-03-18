<div class="container py-5 layer-content">
    @if($layer != null)
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a onclick="window.Swapper.loadMap();" href="#">Home</a></li>
                @foreach($parentLayers as $parentLayer)
                    <li class="breadcrumb-item"><a onclick="window.Layer.load('{{ $parentLayer->slug }}');" href="#{{ $parentLayer->slug }}">{{ $parentLayer->name }}</a></li>
                @endforeach
                <li class="breadcrumb-item active" aria-current="page">{{ $layer->name }}</li>
            </ol>
        </nav>

        <h1>{{ $layer->name }}</h1>

        <div class="layer-content-text">{{ $layer->content }}</div>
        <br/>

        <div class="row">
            @foreach($layer->childLayers as $childLayer)
                <div class="col">
                    <button onclick="window.Layer.load('{{ $childLayer->slug }}');" class="btn btn-outline-primary btn-layer">{{ $childLayer->name }}</button>
                </div>
            @endforeach
        </div>
    @endif
</div>