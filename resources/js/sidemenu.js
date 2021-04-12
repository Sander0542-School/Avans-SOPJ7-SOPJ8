window.SideMenu = {
    get menu() {
        return document.querySelector("nav.sidemenu") || document.createElement('div');
    },
    get menuControl() {
        return document.querySelector(".sidemenu-control") || document.createElement('div');
    },
    toggle: () => {
        window.SideMenu.menu.classList.toggle('active');
        window.SideMenu.menuControl.classList.toggle('active');
    },
    open: () => {
        window.SideMenu.menu.classList.add('active');
        window.SideMenu.menuControl.classList.add('active');
    },
    close: () => {
        window.SideMenu.menu.classList.remove('active');
        window.SideMenu.menuControl.classList.remove('active');
    }
}
