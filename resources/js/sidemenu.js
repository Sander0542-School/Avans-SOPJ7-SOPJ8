window.SideMenu = {
    get menu() {
        return document.querySelector("nav.sidemenu");
    },
    toggle: () => {
        if (window.SideMenu.menu) {
            window.SideMenu.menu.classList.toggle('active');
        }
    },
    open: () => {
        if (window.SideMenu.menu) {
            window.SideMenu.menu.classList.remove('active');
        }
    },
    close: () => {
        if (window.SideMenu.menu) {
            window.SideMenu.menu.classList.add('active');
        }
    }
}
