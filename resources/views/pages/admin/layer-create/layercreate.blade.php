<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            {{ __('Menu') }}
        </h2>
    </x-slot>

{{--    MOET NOG GECHECKED WORDEN OP ADMIN ROL--}}
    <div class="layer-container">
        <form method="post" action="">
            @csrf
            <label>Wat is de titel van de nieuwe laag?</label>
            <input required class="form-control" type="text" name="layerTitle" placeholder="Titel">
            <label>Selecteer de voorgaande laag:</label>
            <select class="form-control" class="selectpicker" id="previousSelectList" data-live-search="true">
                @if($layers->isEmpty() && $subjects->isEmpty())
                    <option selected>Geen bestaande lagen gevonden</option>
                @else
                    <optgroup label="Onderwerpen">
                        @foreach($subjects as $subject)
                            <option data-tokens="{{$subject->name}}" value="subject{{$subject->id}}" name="subject{{$subject->id}}">{{$subject->name}}</option>
                        @endforeach
                    </optgroup>
                    <optgroup label="Lagen">
                        @foreach($layers as $layer)
                            <option data-tokens="{{$layer->name}}" value="layer{{$layer->id}}" name="layer{{$layer->id}}">{{$layer->name}}</option>
                        @endforeach
                    </optgroup>
                @endif
            </select>
            <div class="text-editor">
                hier komt de tekst editor van Fedor
            </div>
            <input type="submit" value="Bevestigen" class="btn btn-success">
            <form>
                <input type="submit" value="Annuleren" class="btn btn-danger">
            </form>
        </form>
    </div>
</x-app-layout>
