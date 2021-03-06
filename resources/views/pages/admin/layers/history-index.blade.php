<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            {{ __('Laag Geschiedenis') }}
        </h2>
    </x-slot>

    <button type="button" class="btn btn-primary information" data-toggle="modal" data-target="#infoModal">
        <i class="fa fa-info-circle my-float" ></i>
    </button>

    <div class="modal fade" id="infoModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Geschiedenis uitleg</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <ul>
                        <li>Op deze pagina kan worden ingezien welke aanpassingen een specifieke laag heeft doorgaan.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <table id="layerTable" class="table m-0">
            <thead>
            <tr>
                <th class="border-0">Laag</th>
                <th class="border-0">Actie</th>
                <th class="border-0">Wie</th>
                <th class="border-0" onclick="window.ChangeFilter.FilterBy.date()">Wanneer<i class="fas fa-sort ml-1" role="button"></i></th>
            </tr>
            </thead>
            <tbody>
            @foreach($changes as $change)
                <tr>
                    <td>{{$change->name}}</td>
                    <td>{{$change->action}}</td>
                    <td>{{$change->user->email}}</td>
                    <td id="date">{{$change->updated_at}}</td>
                    <td class="text-right">
                        <a class="btn btn-warning" href="{{ route('admin.layers.changes', ['change' => $change]) }}"><i class="fas fa-eye"></i></a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
