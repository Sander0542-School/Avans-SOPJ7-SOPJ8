<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            {{ __('Beheerder aanpassen') }}
        </h2>
    </x-slot>

    <button type="button" class="btn btn-primary information" data-toggle="modal" data-target="#infoModal">
        <i class="fa fa-info-circle my-float"></i>
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
                        <li>Alle velden zijn verplicht.</li>
                        <li>“Super Admin” betekent dat deze gebruiker absolute rechten heeft over alles en dus ook andere Super Admins kan editen en/of verwijderen.</li>
                        <li>“Admin” heeft gelimiteerde rechten vergeleken met een ”Super Admin”.</li>
                        <li>Je kunt onderwerpen en/of specifieke lagen toekennen aan een beheerder. Dit doe je door een onderwerp te kiezen, en vervolgens specifieke lagen te kiezen (optioneel). Wanneer een onderwerp gekozen wordt, worden de bijbehorende lagen automatisch geselecteerd. Uiteindelijk worden de geselecteerde lagen doorgevoerd wanneer je op opslaan drukt.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    @dump($errors)

    <form method="POST" action="{{ route('admin.managers.update', $manager) }}">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="inputName">Naam</label>
            <input required type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="inputName" value="{{ $manager->name }}" autocomplete="name">
            @error('name')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="form-group">
            <label for="inputEmail">Email</label>
            <input required type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="inputEmail" value="{{ $manager->email }}" autocomplete="email">
            @error('email')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="form-group" id="roleForm">
            <label for="inputRole">Rol</label>
            <span data-toggle="tooltip" data-placement="right" title="Een Super Admin kan wel andere beheerders beheren, maar een normale Admin kan geen andere beheerders beheren.">
                <i class="fa fa-info-circle my-float"></i>
            </span>
            <select required name="role" class="form-control @error('email') is-invalid @enderror" id="inputRole">
                <option disabled>Kies een rol</option>
                @foreach($roles as $role)
                    @if(auth()->user()->hasRole('Super Admin') && $role->name == 'Super Admin')
                        <option @if($manager->roles->where('id', $role->id)->isNotEmpty()) selected @endif value="{{ $role->id }}">{{ $role->name }}</option>
                    @else
                        <option @if($manager->roles->where('id', $role->id)->isNotEmpty()) selected @endif value="{{ $role->id }}">{{ $role->name }}</option>
                    @endif
                @endforeach
            </select>
            @error('role')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div id="allLayers" class="form-group" style="display: none;">
            <label for="allLayersSelect">Heeft de beheerder het recht om alle bestaande lagen te beheren?</label>
            <select class="form-control" name="custom_permissions" id="allLayersSelect">
                <option value="1">Ja</option>
                <option value="0">Nee</option>
            </select>
        </div>

        <div id="subjectPermissionDiv" class="form-group" style="display: none;">
            <label for="subjectPermission">
                <span style="font-weight: bold">onderwerpen</span> die deze beheerder mag beheren
            </label>
            <select name="subjects[]" class="form-control selectpicker" multiple data-live-search="true" id="subjectPermission">
                <optgroup label="Onderwerpen">
                    {{--                    @foreach($subject as $subjects)--}}
                    {{--                        <option data-tokens="{{$subject->slug}}" value="subject-{{$subject->id}}" name="subject-{{$subject->id}}">{{$subject->name}}</option>--}}
                    {{--                    @endforeach--}}
                    <option value="1">Onderwerp 1</option>
                    <option value="2">Onderwerp 2</option>
                    <option value="3">Onderwerp 3</option>
                </optgroup>
            </select>
            <button type="button" class="btn btn-secondary" style="margin-top:30px;" onclick="window.Admin.ManagerEdit.showLayerPermissions()" id="assignLayersButton">Wijs specifieke lagen toe</button>
        </div>

        <div id="layerPermissionDiv" class="form-group" style="display: none;">
            <label for="layerPermission">Selecteer de <span style="font-weight: bold">lagen</span> die deze beheerder mag beheren.</label>
            <select name="layers[]" class="form-control selectpicker" multiple data-live-search="true" id="layerPermission">
                <optgroup label="Lagen">
                    {{--                    @foreach($layer as $layers)--}}
                    {{--                        <option data-tokens="{{$layer->slug}}" data-parent="subject-{{$subject->id}}" value="{{$layer->id}}">{{$layer->name}}</option>--}}
                    {{--                    @endforeach--}}
                    <option value="1" data-parent="subject-1">Laag 1</option>
                    <option value="2" data-parent="subject-1">Laag 2</option>
                    <option value="3" data-parent="subject-2">Laag 3</option>
                </optgroup>
            </select>
        </div>

        <button class="btn btn-success float-right" type="submit">Opslaan</button>
        <a class="btn btn-danger" href="{{ route('admin.managers.index') }}">Annuleren</a>
    </form>

    @push('scripts')
        <script defer>window.Admin.ManagerEdit.initAdmin();</script>
    @endpush
</x-app-layout>


