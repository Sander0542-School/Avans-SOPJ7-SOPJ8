<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            {{ __('Beheerder') }}
            <a id="listManager" href="{{ route('admin.managers.index') }}" class="btn btn-primary float-right">{{ __('Terug naar de lijst') }}</a>
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
                        @if(auth()->user()->id != $manager->id && !$manager->hasRole('Super Admin'))
                            <button class="btn btn-danger" onclick="modalShow('{{ route('admin.managers.restore', ['manager' => $manager]) }}', '{{ $manager->name }}')">
                                <i class="fas fa-file-export"></i>
                            </button>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <div class="modal" id="managerRestoreModal" tabindex="-1" role="dialog" aria-labelledby="managerRestoreModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 id="managerRestoreModalLabel" class="modal-title">Beheerder Herstellen</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Weet je zeker dat je <span id="modalManagerName"></span> wil herstellen?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuleren</button>
                    <a class="btn btn-danger" id ='modalSubmit'>Herstellen</a>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            function restoreManager(id, name, action) {
                document.getElementById('modalManagerName').innerText = name;
                document.getElementById('modalManagerForm').action = action;

                $('#managerRestoreModal').modal('show');
            }

            function modalShow(url, name) {
                document.getElementById('modalManagerName').innerText = name;
                document.getElementById('modalSubmit').href = url;

                $('#managerRestoreModal').modal('show');
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
