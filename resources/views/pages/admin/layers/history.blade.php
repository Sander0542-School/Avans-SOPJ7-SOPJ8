<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            {{ __('Verandering') }}
        </h2>
    </x-slot>

    <button type="button" class="btn btn-primary information" data-toggle="modal" data-target="#infoModal">
        <i class="fa fa-info-circle my-float" ></i>
    </button>
    <div>
        <h2>user:{{$change->user->name}} {{$change->action}} on: {{$change->updated_at}}</h2>
        <div>
            {{$layer->title}}
        </div>

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
    <a class="btn btn-danger" href="{{ route('admin.layers.history',['layer'=>$layer]) }}">Terug</a>
</x-app-layout>
