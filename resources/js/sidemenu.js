const sideMenu = document.querySelector('nav.sidemenu')

window.SideMenu = {
    toggle: () => {
        if (sideMenu) {
            sideMenu.classList.toggle('active');
        }
    },
    open: () => {
        if (sideMenu) {
            sideMenu.classList.remove('active');
        }
    },
    close: () => {
        if (sideMenu) {
            sideMenu.classList.add('active');
        }
    }
}
