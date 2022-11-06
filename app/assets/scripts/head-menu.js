let nav = document.querySelector('.navbar');
  let menu = document.querySelector('.menu');
  btnmenu.onclick = function() {
    nav.classList.toggle('nav-active');
    menu.classList.toggle('menu-text');
};
