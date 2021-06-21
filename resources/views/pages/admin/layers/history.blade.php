<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            {{ __('Verandering') }}
        </h2>
    </x-slot>

    <button type="button" class="btn btn-primary information" data-toggle="modal" data-target="#infoModal">
        <i class="fa fa-info-circle my-float"></i>
    </button>
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
                {{$change->content}}
            </div>
        </div>

        <div class="change">
            <h2>Naar:</h2>
            <div>
            <span @if($change->action == "updated")
                  class="yellow-content"
                  @elseif($change->action == "deleted")
                  class="red-content"
                  @else
                  class="green-content"
                @endif>{{$change->content}}</span>
            </div>
        </div>

    </div>
    <a class="btn btn-danger" href="{{ route('admin.layers.history',['layer'=>$layer]) }}">Terug</a>
</x-app-layout>
