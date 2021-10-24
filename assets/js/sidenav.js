const sidenavOpenBtn = document.getElementById('btn-bars');
const sidenav = document.querySelector('.sidenav');

sidenavOpenBtn.addEventListener('click', () => {
    sidenav.classList.toggle('open');
    sidenavOpenBtn.classList.toggle('fa-bars')
    sidenavOpenBtn.classList.toggle('fa-times')
});


/**
 * Easter Egg
 */
const t = document.querySelector('.svg-container .fa-laugh-beam')?
    document.querySelector('.svg-container .fa-laugh-beam')
        .addEventListener('click', () => {
        window.location.replace('https://wordus.xyz');
    }) :
    null;
