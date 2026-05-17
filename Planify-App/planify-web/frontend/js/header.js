const menuToggle = document.getElementById('menuToggle');
const navContent = document.getElementById('navContent');

menuToggle.onclick = function() {
    navContent.classList.toggle('active');
};