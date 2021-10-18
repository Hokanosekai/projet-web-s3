const sidenavOpenBtn = document.getElementById('btn-bars');
const sidenav = document.querySelector('.sidenav');

sidenavOpenBtn.addEventListener('click', () => {
    sidenav.classList.toggle('open');
    sidenavOpenBtn.classList.toggle('fa-bars')
    sidenavOpenBtn.classList.toggle('fa-times')
});