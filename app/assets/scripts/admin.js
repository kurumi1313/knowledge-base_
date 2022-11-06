const RightMenuBtn = document.querySelector('.min_menu_btn-right'),
RightMiniMenu = document.querySelector('.admin_header-right_menu');

RightMenuBtn.onclick = () => {
    RightMiniMenu.classList.toggle('show');
}

const MainLeftMenu = document.querySelector('.main-left-menu'),
MenuToggleBtn = document.querySelector('.menu-toggle_btn'),
MainContentBlock = document.querySelector('main');

MainLeftMenu.addEventListener('click', e => {
    if (e.target.className === 'btn-show_inside_menu') {
        let NextElement = e.target.nextElementSibling;

        if (NextElement !== null) {
            NextElement.classList.toggle('show');
        }
    }
})

MenuToggleBtn.onclick = () => {
    MainLeftMenu.classList.toggle('show');
    MainContentBlock.classList.toggle('full');
}



