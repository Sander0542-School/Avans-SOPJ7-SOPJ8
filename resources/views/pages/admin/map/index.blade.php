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

    <div>
        <div id="myModal" class="modal">
            <div class="modal-content">
                <div class="modal-header">
                    <h2>Map uitleg</h2>
                    <span class="close">&times;</span>
                </div>
                <div class="modal-body">
                    <p>- Sleep de poppetjes om hen van locatie te veranderen.</p>
                    <p>- Vergeet niet op de "Locaties opslaan" knop te drukken om de wijzingen door te voeren.</p>
                </div>
            </div>
        </div>
        <button id="myBtn" class="information info-tooltip map-z">
            <i class="fa fa-info-circle my-float" ></i>
        </button>
    </div>

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
