<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            {{ __('Laag Geschiedenis') }}
        </h2>
    </x-slot>

    <button type="button" class="btn btn-primary information" data-toggle="modal" data-target="#infoModal">
        <i class="fa fa-info-circle my-float" ></i>
    </button>

    <div class="card">
        <table id="layerTable" class="table m-0">
            <thead>
            <tr>
                <th class="border-0">Naam</th>
                <th class="border-0">Actie</th>
                <th class="border-0">Wie</th>
                <th class="border-0">Wanneer</th>
            </tr>
            </thead>
            <tbody>
            @foreach($changes as $change)
                <tr>
                    <td>{{$change->name}}</td>
                    <td>{{$change->action}}</td>
                    <td>{{$change->user->name}}</td>
                    <td>{{$change->updated_at}}</td>
                    <td class="text-right">
                        <a class="btn btn-warning" href="{{ route('admin.layers.changes', ['change' => $change]) }}"><i class="fas fa-eye"></i></a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
