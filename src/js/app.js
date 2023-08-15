const menu = document.getElementById('sideMenu');
const openBtn = document.getElementById('openMenu');
const closeBtn = document.getElementById('closeBtn');

openBtn.addEventListener('click', function() {
    menu.style.width = "250px";
});

closeBtn.addEventListener('click', function() {
    menu.style.width = "0";
});
