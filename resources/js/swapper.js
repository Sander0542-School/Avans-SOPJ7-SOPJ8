window.Swapper = {
    get map() {
        return document.querySelector(".swapper .swapper-map");
    },
    get content() {
        return document.querySelector(".swapper .swapper-content");
    },
    toggle: () => {
        if (window.Swapper.content && window.Swapper.map) {
            window.Swapper.map.classList.toggle('swapper-active');
            window.Swapper.content.classList.toggle('swapper-active');
        }
    },
    loadContent: () => {
        if (window.Swapper.content && window.Swapper.map) {
            window.Swapper.map.classList.remove('swapper-active');
            window.Swapper.content.classList.add('swapper-active');
        }
    },
    loadMap: () => {
        if (window.Swapper.content && window.Swapper.map) {
            window.Swapper.map.classList.add('swapper-active');
            window.Swapper.content.classList.remove('swapper-active');
        }
    }
}
