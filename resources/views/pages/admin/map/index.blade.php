<x-app-layout :has-container="false" body-classes="d-flex flex-column full-height" main-classes="flex-auto">
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            {{ __('Map') }}
            <button id="saveLocations" onclick="saveLocations()" class="btn btn-primary float-right">{{ __('Locaties opslaan') }}</button>
        </h2>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form id="subjectsForm" method="post" action="{{ route('admin.map.update') }}">
            @csrf
        </form>
    </x-slot>
    <div id="subjectmap"></div>

    @push('scripts')
        <script defer>
            window.SubjectMap.renderMap(true);
            window.SubjectMap.loadSubjects(true);
        </script>

        <script>
            function saveLocations() {
                const subject = window.SubjectMap.getSubjects();

                fillForm(subject);

                document.getElementById('subjectsForm').submit();
            }

            function fillForm(subjects) {
                const form = document.getElementById('subjectsForm');

                subjects.forEach((subject, index) => {
                    const inputId = createInput(index, 'id', subject.id)
                    const inputLat = createInput(index, 'lat', subject.lat)
                    const inputLon = createInput(index, 'lon', subject.lon)

                    form.append(inputId, inputLat, inputLon);
                });
            }

            function createInput(id, name, value) {
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = `subjects[${id}][${name}]`;
                input.value = value;

                return input;
            }
        </script>
    @endpush
</x-app-layout>
