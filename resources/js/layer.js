window.Layer = {
    load: (layerSlug) => {
        if (document.querySelector('.layer-content')) {
            window.location.hash = layerSlug;
            Livewire.emit('layerChanged', layerSlug);
            window.Swapper.loadContent();
            window.SideMenu.close();
        }
    }
}

if (window.location.hash) {
    const layerSlug = window.location.hash.substr(1);
    window.Swapper.loadContent();
    document.addEventListener("DOMContentLoaded", () => {
        window.Layer.load(layerSlug);
    });
}
