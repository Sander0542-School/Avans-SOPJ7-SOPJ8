<x-app-layout>
    <x-slot name="header">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.12/datatables.min.css"/>
        <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"/>
    </x-slot>

    <div class="row mt-5">
        <div class="col-md-10 offset-md-1">
            <h3 class="text-center mb-4">Menu index</h3>
            <table id="table" class="table table-bordered">
                <thead>
                <tr>
                    <th width="30px">#</th>
                    <th>Naam</th>
                    <th>Domein</th>
                    <th>Lengtegraad</th>
                    <th>Breedtegraad</th>
                </tr>
                </thead>
                <tbody id="tablecontents">
                @foreach($subjects as $subject)
                    <tr class="row1" data-id="{{ $subject->id }}">
                        <td class="pl-3"><i class="fa fa-sort"></i></td>
                        <td>{{ $subject->name }}</td>
                        <td>{{ $subject->domain_name }}</td>
                        <td>{{ $subject->lat }}</td>
                        <td>{{ $subject->lon }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <hr>
            <div class="col-span-1 text-left">
                <a href="{{ route('admin.menu.getEdit') }}" class="bg-white hover:bg-gray-100 text-gray-800 py-2 px-4 border border-gray-400 rounded shadow">
                    Bewerk
                </a>
            </div>
        </div>
    </div>

    <script type="text/javascript">

        $( "#tablecontents" ).sortable({
            revert: true,
            items: "tr",
            cursor: 'move',
            opacity: 0.6,
            update: function() {
                sendOrderToServer();
            }
        });

        function sendOrderToServer() {
            var order = [];
            var token = $('meta[name="csrf-token"]').attr('content');
            $('tr.row1').each(function(index,element) {
                order.push({
                    id: $(this).attr('data-id'),
                    position: index+1
                });
            });

            $.ajax({
                type: "POST",
                dataType: "json",
                url: "{{ url('menu-sortable') }}",
                data: {
                    order: order,
                    _token: token
                },
                success: function(response) {
                    if (response.status == "success") {
                        console.log(response);
                    } else {
                        console.log(response);
                    }
                }
            });
        }
    </script>
</x-app-layout>
