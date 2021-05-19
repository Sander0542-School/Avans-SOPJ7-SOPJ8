window.Swapper = {
    get content() {
        return document.querySelector(".swapper .swapper-content");
    },
    toggle: () => {
        if (window.Swapper.content) {
            window.Swapper.content.classList.toggle('swapper-active');
        }
    },
    loadContent: () => {
        if (window.Swapper.content) {
            window.Swapper.content.classList.add('swapper-active');
        }
    },
    loadMap: () => {
        if (window.Swapper.content) {
            window.Swapper.content.classList.remove('swapper-active');
        }
        window.SubjectMap.zoomMarker();
    }
}
