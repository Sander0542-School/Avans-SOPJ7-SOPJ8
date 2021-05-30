<x-map-layout>
    <div class="swapper">
        <div class="swapper-back">
            <div id="subjectmap"></div>
        </div>
        <div class="swapper-content">
            <div class="container py-4 h-100">
                <div class="card h-100 overflow-y">
                    <livewire:layer-content/>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script defer>
            window.SubjectMap.renderMap();

            document.addEventListener("DOMContentLoaded", () => {
                window.Layer.loadHash();
            });
        </script>
    @endpush
</x-map-layout>
