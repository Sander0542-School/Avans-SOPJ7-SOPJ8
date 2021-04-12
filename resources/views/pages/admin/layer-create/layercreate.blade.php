<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            {{ __('Menu') }}
        </h2>
    </x-slot>
    <div class="layer-container">
        <form method="post">
               <label>What is your layer title?</label>
                <input required class="form-control" type="text" name="layerTitle" placeholder="Title">
            <label>Please select the subject or layer that was previous to this layer.</label>
            <input type="text" autocomplete="off" class="form-control" placeholder="Search layer/subject.." id="layerSearch">
            <select class="mdb-select md-form" id="previousSelectList" multiple>
                @if($layers->isEmpty() && $subjects->isEmpty())
                    <option>No previously existing layers found</option>
                @else
                    @foreach($layers as $layer)
                        <option value="layer{{$layer->id}}" id="layer{{$layer->id}}">{{$layer->name}}</option>
                    @endforeach
                    @foreach($subjects as $subject)
                        <option value="subject{{$subject->id}}" id="subject{{$subject->id}}">{{$subject->name}}</option>
                    @endforeach
                @endif
            </select>
            <div class="text-editor">
                hier komt de tekst editor van Fedor
            </div>
            <input type="submit" value="Submit">
        </form>
        <form>
            <input type="submit" value="Cancel">
        </form>
    </div>
</x-app-layout>
