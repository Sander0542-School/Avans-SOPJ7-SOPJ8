<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            {{ __('Laag maken') }}
        </h2>
    </x-slot>

    <button type="button" class="btn btn-primary information" data-toggle="modal" data-target="#infoModal">
        <i class="fa fa-info-circle my-float" ></i>
    </button>

    <div class="modal fade" id="infoModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Beheerders uitleg</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <ul>
                        <li>Alle velden zijn verplicht. </li>
                        <li>Gebruik de Rich Text Editor om afbeeldingen, linkjes en tekst toe te voegen en/of te editen. </li>
                        <li>Het gebruik van iedere functionaliteit van de Rich Text Editor wordt besproken in de gebruikshandleiding onder het kopje “Tekst editor”. </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <form method="POST" action="{{ route('admin.layers.update', ['layer' => $layer]) }}">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="inputName">Titel</label>
            <input required type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="inputName" value="{{ old('name', $layer->name) }}">
            @error('name')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="form-group">
            <label for="inputParent">Bovenliggend onderwerp of laag</label>
            <span class="" data-toggle="tooltip" data-placement="right" title="Kies hier het onderwerp of laag, waar deze nieuwe laag onder valt. Deze nieuwe laag zal vervolgens te zien zijn wanneer je de bovenliggende laag uitklapt in het menu.">
                <i class="fa fa-info-circle my-float"></i>
            </span>
            <select required class="form-control @error('parent') is-invalid @enderror" class="selectpicker" id="inputParent" data-live-search="true" name="parent">
                <option selected disabled>Kies een onderwerp of laag</option>

                <optgroup label="Onderwerpen">
                    @foreach($subjects as $subject)
                        <option @if(old('parent', $layer->subject != null ? 'subject-'.$layer->subject->id : null) == 'subject-'.$subject->id) selected @endif data-tokens="{{$subject->name}}" value="subject-{{$subject->id}}" id="subject-{{$subject->id}}" name="subject-{{$subject->id}}">{{$subject->name}}</option>
                    @endforeach
                </optgroup>

                <optgroup label="Lagen">
                    @foreach($layers as $layer1)
                        <option @if(old('parent', $layer->parentLayer != null ? 'layer-'.$layer->parentLayer->id : null) == 'layer-'.$layer1->id) selected @endif data-tokens="{{$layer1->slug}}" value="layer-{{$layer1->id}}" id="layer-{{$layer1->id}}" name="layer-{{$layer1->id}}">{{$layer1->name}}</option>
                    @endforeach
                </optgroup>
            </select>
            @error('parent')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="form-group">
            <label for="inputContent">Inhoud</label>
            <textarea required id="inputContent" class="text-editor form-control @error('content') is-invalid @enderror" name="content">
                {{ old('content', $layer->content) }}
            </textarea>
            @error('content')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <button class="btn btn-success float-right" type="submit">Opslaan</button>
        <a class="btn btn-danger" href="{{ route('admin.layers.index') }}">Annuleren</a>
    </form>

    @push('scripts')
        <script src="https://cdn.ckeditor.com/4.16.0/full/ckeditor.js"></script>
        <script>CKEDITOR.replace('content');</script>
    @endpush

</x-app-layout>


