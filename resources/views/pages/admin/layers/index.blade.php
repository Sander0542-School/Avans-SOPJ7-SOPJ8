<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            {{ __('Lagen') }}
            <a id="newLayer" href="{{ route('admin.layers.create') }}" class="btn btn-primary float-right">{{ __('Nieuwe laag') }}</a>
        </h2>
    </x-slot>

    <div class="card">
        <div class="card-body">
            <div class="form-group m-0">
                <input type="text" id="inputFilter" class="form-control" onkeyup="filterLayers()" placeholder="Zoek door lagen">
            </div>
        </div>
    </div>
    <br/>

    <div class="card">
        <table id="layerTable" class="table m-0">
            <thead>
            <tr>
                <th class="border-0">Naam</th>
                <th class="border-0">Bovenliggend</th>
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
                        <a class="btn btn-warning" href="{{ route('admin.layers.edit', ['layer' => $layer]) }}"><i class="fas fa-edit"></i></a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    @push('scripts')
        <script>
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
