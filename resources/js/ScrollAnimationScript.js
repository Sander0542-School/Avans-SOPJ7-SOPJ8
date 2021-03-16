document.addEventListener('keydown', function (event) {
    if (event.keyCode === 38) {
        // const swapperContent = document.querySelector(".frontIMG");
        const swapperContent = document.querySelector(".swapper-content");
        const swapperMap = document.querySelector(".swapper-map");

        swapperContent.classList.toggle('transition');
        swapperMap.classList.toggle('transition');
    }
});
