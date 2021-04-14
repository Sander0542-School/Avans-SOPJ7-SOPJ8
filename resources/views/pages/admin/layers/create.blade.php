<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            {{ __('Laag maken') }}
        </h2>
    </x-slot>

    <form method="POST" action="{{ route('admin.layers.store') }}">
        @csrf

        <div class="form-group">
            <label for="inputName">Titel</label>
            <input required type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="inputName" value="{{ old('name') }}">
            @error('name')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="form-group">
            <label for="inputParent">Bovenliggend onderwerp of laag</label>
            <select required class="form-control @error('parent') is-invalid @enderror" class="selectpicker" id="inputParent" data-live-search="true" name="parent">
                <option selected disabled>Kies een onderwerp of laag</option>

                <optgroup label="Onderwerpen">
                    @foreach($subjects as $subject)
                        <option @if(old('parent') == 'subject-'.$subject->id) selected @endif data-tokens="{{$subject->name}}" value="subject-{{$subject->id}}" id="subject-{{$subject->id}}" name="subject-{{$subject->id}}">{{$subject->name}}</option>
                    @endforeach
                </optgroup>

                <optgroup label="Lagen">
                    @foreach($layers as $layer)
                        <option @if(old('parent') == 'layer-'.$layer->id) selected @endif data-tokens="{{$layer->slug}}" value="layer-{{$layer->id}}" id="subject-{{$subject->id}}" name="layer-{{$layer->id}}">{{$layer->name}}</option>
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
                {{ old('content', '<h1>Nieuwe laag</h1>') }}
            </textarea>
            @error('content')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <button class="btn btn-success float-right" type="submit">Bevestigen</button>
        <a class="btn btn-danger" href="{{ route('admin.layers.index') }}">Annuleren</a>
    </form>

    @push('scripts')
        <script src="https://cdn.ckeditor.com/4.16.0/full/ckeditor.js"></script>
        <script>CKEDITOR.replace('content');</script>
    @endpush
</x-app-layout>


