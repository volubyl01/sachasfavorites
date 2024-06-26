// app.js
document.addEventListener('DOMContentLoaded', function() {
    const offcanvas = document.getElementById('offcanvas');
    const openOffcanvasBtn = document.getElementById('openOffcanvas');
    const closeOffcanvasBtn = document.getElementById('closeOffcanvas');
    const overlay = document.getElementById('offcanvasOverlay');
    const body = document.body;

    function openOffcanvas() {
        offcanvas.classList.add('active');
        overlay.classList.add('active');
        body.style.overflow = 'hidden'; // Empêche le défilement du body
    }

    function closeOffcanvas() {
        offcanvas.classList.remove('active');
        overlay.classList.remove('active');
        body.style.overflow = ''; // Rétablit le défilement du body
    }

    if (openOffcanvasBtn) {
        openOffcanvasBtn.addEventListener('click', openOffcanvas);
    }

    if (closeOffcanvasBtn) {
        closeOffcanvasBtn.addEventListener('click', closeOffcanvas);
    }

    overlay.addEventListener('click', closeOffcanvas);

    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            closeOffcanvas();
        }
    });
});
