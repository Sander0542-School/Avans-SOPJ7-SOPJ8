<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            {{ __('Beheerder') }}
            <a id="newManager" href="{{ route('admin.managers.create') }}" class="btn btn-primary float-right">{{ __('Beheerder toevoegen') }}</a>
            <a id="newArchive" href="{{ route('admin.managers.deleted') }}" class="btn btn-primary float-right">{{ __('Archief') }}</a>
        </h2>
    </x-slot>

    <div class="card">
        <div class="card-body">
            <div class="form-group m-0">
                <input type="text" id="inputFilter" class="form-control" onkeyup="filterLayers()" placeholder="Zoek door beheerders">
            </div>
        </div>
    </div>
    <br/>

    <div class="card">
        <table id="managerTable" class="table m-0">
            <thead>
            <tr>
                <th class="border-0">Naam</th>
                <th class="border-0">Email</th>
                <th class="border-0">Rol</th>
                <th class="border-0"></th>
            </tr>
            </thead>
            <tbody>
            @foreach($managers as $manager)
                <tr>
                    <td>{{ $manager->name }}</td>
                    <td>{{ $manager->email }}</td>
                    <td>{{ $manager->roles[0]['name'] }}</td>
                    <td class="text-right">
                        <a class="btn btn-success" href="{{ route('admin.managers.show', ['manager' => $manager]) }}"><i class="fas fa-eye"></i></a>
                        <a class="btn btn-warning" href="{{ route('admin.managers.edit', ['manager' => $manager]) }}"><i class="fas fa-edit"></i></a>
                        @if(auth()->user()->id != $manager->id && !$manager->hasRole('Super Admin'))
                            <button class="btn btn-danger" onclick="deleteManager({{ $manager->id }}, '{{ $manager->name }}', '{{ route('admin.managers.destroy', ['manager' => $manager]) }}')">
                                <i class="fas fa-trash"></i>
                            </button>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <div class="modal" id="managerDeleteModal" tabindex="-1" role="dialog" aria-labelledby="managerDeleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 id="managerDeleteModalLabel" class="modal-title">Beheerder verwijderen</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Weet je zeker dat je <span id="modalManagerName"></span> wil verwijderen?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuleren</button>
                    <form id="modalManagerForm" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Verwijderen</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            function deleteManager(id, name, action) {
                document.getElementById('modalManagerName').innerText = name;
                document.getElementById('modalManagerForm').action = action;

                $('#managerDeleteModal').modal('show');
            }

            function filterLayers() {
                const input = document.getElementById("inputFilter");
                const filter = input.value.toUpperCase();
                const table = document.getElementById("managerTable");

                table.querySelectorAll('tbody > tr').forEach((row) => {
                    const content = row.textContent || row.innerText;

                    if (content.toUpperCase().indexOf(filter) > -1) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            }
        </script>
    @endpush
</x-app-layout>
