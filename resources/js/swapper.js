document.addEventListener('keydown', function (event) {
    if (event.keyCode === 38) {
        window.Swapper.toggle();
    }
    if (event.keyCode === 37) {
        window.Swapper.loadContent();
    }
    if (event.keyCode === 39) {
        window.Swapper.loadMap();
    }
});

const swapperContent = document.querySelector(".swapper .swapper-content");
const swapperMap = document.querySelector(".swapper .swapper-map");

window.Swapper = {
    toggle: () => {
        if (swapperContent && swapperMap) {
            swapperMap.classList.toggle('swapper-active');
            swapperContent.classList.toggle('swapper-active');
        }
    },
    loadContent: () => {
        if (swapperContent && swapperMap) {
            swapperMap.classList.remove('swapper-active');
            swapperContent.classList.add('swapper-active');
        }
    },
    loadMap: () => {
        if (swapperContent && swapperMap) {
            swapperMap.classList.add('swapper-active');
            swapperContent.classList.remove('swapper-active');
        }
    }
}
