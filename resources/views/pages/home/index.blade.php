<x-map-layout>
    <div class="swapper">
        <div class="swapper-content">
            <livewire:layer-content/>
        </div>
        <div id="subjectmap" class="swapper-map swapper-active"></div>
    </div>

    @push('scripts')
        <script defer>
            window.SubjectMap.renderMap();
            window.SubjectMap.loadSubjects();

            document.addEventListener("DOMContentLoaded", () => {
                window.Layer.loadHash();
            });
        </script>
    @endpush
</x-map-layout>
