<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            {{ __('Beheerder aanpassen') }}
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
                        <li>“Super Admin” betekent dat deze gebruiker absolute rechten heeft over alles en dus ook andere Super Admins kan editen en/of verwijderen.</li>
                        <li>“Admin” heeft gelimiteerde rechten vergeleken met een ”Super Admin”. </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

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
            <label for="inputName">Email</label>
            <input required type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="inputEmail" value="{{ $manager->email }}" autocomplete="email">
            @error('email')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="form-group">
            <label for="inputName">Rol</label>
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

        <button class="btn btn-success float-right" type="submit">Opslaan</button>
        <a class="btn btn-danger" href="{{ route('admin.managers.index') }}">Annuleren</a>
    </form>

</x-app-layout>


