<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            {{ __('Beheerder aanpassen') }}
        </h2>
    </x-slot>

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


