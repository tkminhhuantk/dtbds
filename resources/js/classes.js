//Menu
export class Menu {
    constructor() {
        this.active = false;
        this.overlay = null;
        this.button = document.querySelector('.header-toggle');
        this.sidebar = document.querySelector('.main-menu');
        this.dismiss = document.querySelector('.header-dismiss button');
        this.dropdown = document.querySelectorAll('.menu-dropdown');
        this.listenerEvent();
    }

    initOverlay() {
        this.overlay = document.createElement('div');
        this.overlay.id = 'bg-overlay';
    }

    destroyOverlay() {
        this.overlay.remove();
    }

    show() {
        this.initOverlay();
        document.body.appendChild(this.overlay);
        this.sidebar.classList.toggle('active');
        if (this.sidebar.classList.contains('active')) {
            this.active = true;
            this.overlay.addEventListener('click', (e) => this.destroy());
        } else {
            this.active = false;
        }
    }

    dropDown(e) {
        let $this = e.currentTarget;
        let subMenu = $this.nextElementSibling;

        $this.classList.toggle('active');
        subMenu.classList.toggle('active');
    }

    destroy() {
        this.active = false;
        this.sidebar.classList.remove('active');
        this.destroyOverlay();
    }

    listenerEvent() {
        this.button.addEventListener('click', (e) => this.show());
        this.dismiss.addEventListener('click', (e) => this.destroy());
        this.dropdown.forEach(item => {
            item.addEventListener('click', (e) => this.dropDown(e));
        });
    }
}