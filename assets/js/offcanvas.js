console.log('Script offcanvas chargé');
document.addEventListener('DOMContentLoaded', function() {
    console.log('DOM chargé');
    const offcanvas = document.getElementById('offcanvas');
    const overlay = document.getElementById('offcanvasOverlay');
    const openBtn = document.getElementById('openOffcanvas');
    const closeBtn = document.getElementById('closeOffcanvas');

    console.log('Éléments :', { 
        offcanvas: offcanvas, 
        overlay: overlay, 
        openBtn: openBtn, 
        closeBtn: closeBtn 
    });

    if (!offcanvas || !overlay || !openBtn || !closeBtn) {
        console.error('Un ou plusieurs éléments nécessaires sont manquants');
        return;
    }

    function openOffcanvas() {
        console.log('Ouverture de l\'offcanvas');
        offcanvas.classList.add('active');
        overlay.classList.add('active');
        document.body.style.overflow = 'hidden';
    }

    function closeOffcanvas() {
        console.log('Fermeture de l\'offcanvas');
        offcanvas.classList.remove('active');
        overlay.classList.remove('active');
        document.body.style.overflow = '';
    }

    openBtn.addEventListener('click', openOffcanvas);
    closeBtn.addEventListener('click', closeOffcanvas);
    overlay.addEventListener('click', closeOffcanvas);

    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            closeOffcanvas();
        }
    });

    console.log('Tous les écouteurs d\'événements ont été ajoutés');
});
