<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            {{ __('Menu') }}
        </h2>
    </x-slot>

    <div>
        <div id="myModal" class="modal">
            <div class="modal-content">
                <div class="modal-header">
                    <h2>Menu uitleg</h2>
                    <span class="close">&times;</span>
                </div>
                <div class="modal-body">
                    <p>- Gebruik de blauwe pijltoetsen om de onderwerpen te verslepen. Dit past de navigatie menu volgorde aan op de hoofdpagina.</p>
                    <p>- Vergeet niet op de "Opslaan" knop te drukken onderaan de pagina, om de wijzingen door te voeren.</p>
                    <p>- Het linkere veld is de naam van de topic.</p>
                    <p>- Het rechtere veld is het gebied waarmee de topic is geassocieerd.</p>
                </div>
            </div>
        </div>
        <button id="myBtn" class="information info-tooltip">
            <i class="fa fa-info-circle my-float" ></i>
        </button>
    </div>

    <div class="row">
        <form class="col" action="{{ route('admin.menu.update') }}" method="post">
            @csrf

            <div class="sortable">
                @foreach($subjects as $subject)
                    <div id="subjectItem{{ $subject->id }}" class="sortable-item card my-2 w-100">
                        <input type="hidden" data-name="subject_id" name="subjects[{{ $subject->id }}][subject_id]" value="{{ $subject->id }}">
                        <input type="hidden" data-name="order" class="subject-order" name="subjects[{{ $subject->id }}][order]" value="{{ $subject->order }}">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-1">
                                    <span class="btn btn-link" style="cursor: grab">
                                        <i class="fas fa-2x fa-sort" title=
                                            "Sleep het onderwerp in de gewenste volgorde"
                                        ></i>
                                    </span>
                                </div>
                                <div class="col">
                                    <input name="subjects[{{ $subject->id }}][name]" data-name="name" type="text" class="form-control" value="{{ $subject->name }}" placeholder="Onderwerp naam">
                                </div>
                                <div class="col">
                                    <select name="subjects[{{ $subject->id }}][domain_id]" data-name="domain_id" class="form-control">
                                        @foreach($domains as $domain)
                                            <option @if($subject->domain_id == $domain->id) selected @endif value="{{ $domain->id }}">{{ $domain->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="col-span-1 text-right">
                <button type="submit" class="bg-white hover:bg-gray-100 text-gray-800 py-2 px-4 border border-gray-400 rounded shadow">
                    Opslaan
                </button>
            </div>
        </form>
    </div>

    <script defer type="text/javascript">
        $(".sortable").sortable({
            revert: true,
            items: ".sortable-item",
            update: () => {
                listOrderInputs();
            }
        });

        listOrderInputs();

        function listOrderInputs() {
            const subjectElems = document.querySelectorAll('.sortable > .sortable-item');

            subjectElems.forEach((subjectElem, index) => {
                const orderInput = subjectElem.querySelector('input.subject-order');
                orderInput.value = index + 1;
            });
        }
    </script>

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
