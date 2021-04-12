<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            {{ __('Menu') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="d-flex  w-50">
                <a href="{{ route('admin.menu.getEdit') }}" class="bg-white hover:bg-gray-100 text-gray-800 py-2 px-4 border border-gray-400 rounded shadow">Bewerk</a>
            </div>
            <br>

            <div>
                @foreach($subjects as $subject)
                    <div class="p-xl-5 bg-white border-b border-gray-200">
                        <div class="d-flex flex-column w-50">
                            <b>{{ $subject['name'] }}</b>
                            <b>Order: {{ $subject['order'] }}</b>
                            <b>Domein: {{ $subject['domain_id'] }}</b>
                        </div>
                    </div>
                    <br>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
