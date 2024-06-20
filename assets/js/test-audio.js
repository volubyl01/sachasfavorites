document.addEventListener('DOMContentLoaded', () => {
    const audioElement = document.querySelector(".audio");

    audioElement.addEventListener("canplaythrough", () => {
        // Créer le contexte audio
        const audioCtx = new (window.AudioContext || window.webkitAudioContext)();

        // Créer le nœud source à partir de l'élément audio
        const source = audioCtx.createMediaElementSource(audioElement);

        // Créer le nœud gain
        const gainNode = audioCtx.createGain();

        // Connecter les nœuds
        source.connect(gainNode);
        gainNode.connect(audioCtx.destination);

        // Créer les variables pour stocker la position Y du pointeur et la hauteur de l'écran
        let currentY;
        const height = window.innerHeight;

        // Récupérer les nouvelles coordonnées du pointeur quand la souris est déplacée
        // et définir la nouvelle valeur de gain
        document.onmousemove = (e) => {
            currentY = window.Event
                ? e.pageY
                : event.clientY +
                  (document.documentElement.scrollTop
                    ? document.documentElement.scrollTop
                    : document.body.scrollTop);

            gainNode.gain.value = currentY / height;
        };
    });
});
