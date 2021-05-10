<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            {{ __('Beheerder toevoegen') }}
        </h2>
    </x-slot>

    <div>
        <div id="myModal" class="modal">
            <div class="modal-content">
                <div class="modal-header">
                    <h2>Beheerder uitleg</h2>
                    <span class="close">&times;</span>
                </div>
                <div class="modal-body">
                    <p>- Alle velden zijn verplicht. </p>
                    <p>- “Super Admin” betekent dat deze gebruiker absolute rechten heeft over alles en dus ook andere Super Admins kan editen en/of verwijderen.</p>
                    <p>- “Admin” heeft gelimiteerde rechten vergeleken met een ”Super Admin”. </p>
                </div>
            </div>
        </div>
        <button id="myBtn" class="information">
            <i class="fa fa-info-circle my-float" ></i>
        </button>
    </div>

    <form method="POST" action="{{ route('admin.managers.store') }}">
        @csrf

        <div class="form-group">
            <label for="inputName">Naam</label>
            <input required type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="inputName" value="{{ old('name') }}" autocomplete="name">
            @error('name')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="form-group">
            <label for="inputName">Email</label>
            <input required type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="inputEmail" value="{{ old('email') }}" autocomplete="email">
            @error('email')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="form-group">
            <label for="inputName">Rol</label>
            <select required name="role" class="form-control @error('email') is-invalid @enderror" id="inputRole">
                <option selected disabled>Kies een rol</option>
                @foreach($roles as $role)
                    <option @if($role->id == old('role')) selected @endif value="{{ $role->id }}">{{ $role->name }}</option>
                @endforeach
            </select>
            @error('role')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <button class="btn btn-success float-right" type="submit">Toevoegen</button>
        <a class="btn btn-danger" href="{{ route('admin.managers.index') }}">Annuleren</a>
    </form>

    <script>
        var modal = document.getElementById("myModal");
        var btn = document.getElementById("myBtn");
        var span = document.getElementsByClassName("close")[0];

        btn.onclick = function() {
            modal.style.display = "block";
        }

        span.onclick = function() {
            modal.style.display = "none";
        }

        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>
</x-app-layout>


