<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            {{ __('Aanpassing') }}
        </h2>
    </x-slot>

    <button type="button" class="btn btn-primary information" data-toggle="modal" data-target="#infoModal">
        <i class="fa fa-info-circle my-float"></i>
    </button>

    <div class="modal fade" id="infoModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Aanpassing uitleg</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <ul>
                        <li>Op deze pagina kan worden ingezien wie wanneer welke aanpassing(en) heeft gemaakt.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="changetitle">
        <h2>
            <span>Gebruiker</span>: {{$change->user->email}}
        </h2>
        <h2>
            <span>{{$change->action}}</span>: {{$layer->name}}
        </h2>
        <h2>
            <span>Op</span>: {{$change->updated_at}}
        </h2>
    </div>

    <div class="changesDiv">
        <div class="change">
            <h2>Van:</h2>
            <div>
                @if($previousChange !=null)
                {!!$previousChange->content!!}
                @else
                    Er zijn geen voorgaande veranderingen gevonden.
                @endif
            </div>
        </div>

        <div class="change">
            <h2>Naar:</h2>
            <div>
            <span>{!!$change->content!!}</span>
            </div>
        </div>

    </div>
    <a class="btn btn-danger" href="{{ route('admin.layers.history',['layer'=>$layer]) }}">Terug</a>
</x-app-layout>
