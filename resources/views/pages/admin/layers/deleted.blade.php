<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            {{ __('Laag') }}
            <a id="listLayer" href="{{ route('admin.layers.index') }}" class="btn btn-primary float-right">{{ __('Terug naar de lijst') }}</a>
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
                        <li>Op deze pagina zijn alle verwijderde lagen te vinden. </li>
                        <li>Gebruik de knopjes om een laag te bekijken of om het uit het archief te halen. </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="form-group m-0">
                <input type="text" id="inputFilter" class="form-control" onkeyup="filterLayers()" placeholder="Zoek door beheerders">
            </div>
        </div>
    </div>
    <br/>

    <div class="card">
        <table id="layerTable" class="table m-0">
            <thead>
            <tr>
                <th class="border-0">Naam</th>
                <th class="border-0">Bovenliggende laag</th>
                <th class="border-0"></th>
            </tr>
            </thead>
            <tbody>
            @foreach($layers as $layer)
                <tr>
                    <td>{{ $layer->name }}</td>
                    <td>
                        @if($layer->subject != null)
                            {{ $layer->subject->name }}
                        @elseif($layer->parentLayer != null)
                            {{ $layer->parentLayer->name }}
                        @endif
                    </td>
                    <td class="text-right">
                        <button class="btn btn-danger" onclick="modalShow('{{ route('admin.layers.restore', ['layer' => $layer]) }}', '{{ $layer->name }}')">
                            <i class="fas fa-trash-restore"></i>
                        </button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <div class="modal" id="layerRestoreModal" tabindex="-1" role="dialog" aria-labelledby="layerRestoreModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 id="layerRestoreModalLabel" class="modal-title">Laag Herstellen</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Weet je zeker dat je <span id="modalLayerName"></span> wil herstellen?</p>
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
            function modalShow(url, name) {
                document.getElementById('modalLayerName').innerText = name;
                document.getElementById('modalSubmit').href = url;

                $('#layerRestoreModal').modal('show');
            }

            function filterLayers() {
                const input = document.getElementById("inputFilter");
                const filter = input.value.toUpperCase();
                const table = document.getElementById("layerTable");

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
