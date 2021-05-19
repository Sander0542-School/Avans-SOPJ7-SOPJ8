window.Layer = {
    load: (layerSlug, subjectId = null) => {
        if (document.querySelector('.layer-content')) {
            window.location.hash = layerSlug;
            Livewire.emit('layerChanged', layerSlug);
            window.Swapper.loadContent();
            window.SubjectMap.zoomMarker(subjectId);
            window.SideMenu.close();
        }
    },
    loadHash: () => {
        if (window.location.hash) {
            const layerSlug = window.location.hash.substr(1);
            window.Layer.load(layerSlug);
        }
    }
}

