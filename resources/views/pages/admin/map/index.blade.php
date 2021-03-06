<x-app-layout :has-container="false" body-classes="d-flex flex-column full-height" main-classes="flex-auto">
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            {{ __('Map') }}
            <button class="btn btn-primary float-right mx-1" data-toggle="modal" data-target="#subjectModal">{{ __('Onderwerp toevoegen') }}</button>
            <button class="btn btn-primary float-right " data-toggle="modal" data-target="#subjectModalDestroy">{{ __('Onderwerp verwijderen') }}</button>
            <button class="btn btn-primary float-right mx-1" id="saveLocations" onclick="saveLocations()" >{{ __('Locaties opslaan') }}</button>

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
                        <li>Sleep de poppetjes om hen van locatie te veranderen.</li>
                        <li>Vergeet niet op de "Locaties opslaan" knop te drukken om de wijzingen door te voeren.</li>
                        <li>Voeg een nieuw onderwerp toe door op de "Onderwerp toevoegen" knop te drukken.</li>
                        <li>Het is mogelijk om een onderwerp te verwijderen door op de knop "Onderwerpen verwijderen" te drukken.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="subjectModalDestroy" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Onderwerp toevoegen</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('admin.map.destroy') }}">
                        @csrf
                        <div class="form-group">
                            <label for="inputSubject">Naam</label>
                            <select for="subjectChoice" name="subjectChoice" id="subjectChoice"class="form-control">
                                @foreach($subjects as $subject)
                                    <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                                @endforeach
                            </select>
                            @error('subject')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <button class="btn btn-danger btn-success-axe float-right" type="submit">Verwijderen</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="subjectModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Onderwerp toevoegen</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('admin.map.store') }}">
                        @csrf

                        <div class="form-group">
                            <label for="inputName">Naam</label>
                            <input required type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="inputName" autocomplete="name">
                            @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="inputDescription">Beschrijving</label>
                            <input required type="text" name="description" class="form-control @error('description') is-invalid @enderror" id="inputDescription">
                            @error('description')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="inputDomain">Domein</label>
                            <select name="domain_id" class="form-control">
                                @foreach($domains as $domain)
                                    <option value="{{ $domain->id }}">{{ $domain->name }}</option>
                                @endforeach
                            </select>
                            @error('domain')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <button class="btn btn-success btn-success-axe float-right" type="submit">Toevoegen</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div id="subjectmap"></div>

    @push('scripts')
        <script defer>
            window.SubjectMap.renderMap(true);
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
