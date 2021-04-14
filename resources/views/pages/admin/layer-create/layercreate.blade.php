<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            {{ __('Menu') }}
        </h2>
    </x-slot>
    {{--    MOET NOG GECHECKED WORDEN OP ADMIN ROL--}}
    <div class="layer-container">
        <form method="POST" action="{{ route('admin.layers.store') }}">
            @csrf
            <label>Wat is de titel van de nieuwe laag?</label>
            <input required class="form-control" type="text" name="title" placeholder="Titel" id="titleInput">
            <label>Selecteer de voorgaande laag:</label>
            <select class="form-control" class="selectpicker" id="previousSelectList" data-live-search="true" name="parent">
                @if($layers->isEmpty() && $subjects->isEmpty())
                    <option selected>Geen bestaande lagen gevonden</option>
                @else
                    <optgroup label="Onderwerpen">
                        @foreach($subjects as $subject)
                            <option data-tokens="{{$subject->name}}" value="subject-{{$subject->id}}" id="subject-{{$subject->id}}" name="subject-{{$subject->id}}">{{$subject->name}}</option>
                        @endforeach
                    </optgroup>
                    <optgroup label="Lagen">
                        @foreach($layers as $layer)
                            <option data-tokens="{{$layer->slug}}" value="layer-{{$layer->id}}" id="subject-{{$subject->id}}" name="layer-{{$layer->id}}">{{$layer->name}}</option>
                        @endforeach
                    </optgroup>
                @endif
            </select>
            <textarea id="editor" class="text-editor" name="editor1">
                <h1>
                    Sample text
                </h1>
                <p>
                    Bottom text
                </p>
            </textarea>
            @isset($success)
                <label id="successAlert" class="alert alert-success">{{$success}}</label>
            @endisset
            <input type="submit" value="Bevestigen" id="confirmLayer" class="btn btn-success">
            <form>
                <input type="submit" value="Annuleren" class="btn btn-danger">
            </form>
        </form>
    </div>
    @push('scripts')
        <script src="https://cdn.ckeditor.com/4.16.0/full/ckeditor.js"></script>
        <script>CKEDITOR.replace('editor1');</script>
    @endpush
</x-app-layout>


