import '@popperjs/core';
// // importer bootstrap.js
import 'bootstrap';


// importer le css de bootstrap
import 'bootstrap/dist/css/bootstrap.min.css';

// import { startStimulusApp } from '@symfony/stimulus-bridge';

// export const app = startStimulusApp(require.context(
//     '@symfony/stimulus-bridge/lazy-controller-loader!./controllers',
//     true,
//     /\.(j|t)sx?$/
// ));


/*
 * Welcome to your app's main JavaScript file!
 *
 * This file will be included onto the page via the importmap() Twig function,
 * which should already be in your base.html.twig.
 */
import '@symfony/stimulus-bridge';
// import './styles/app.css';



// import { createApp } from 'vue';
// import app from './components/Hello-World.vue';

// const app = createApp({});
// app.component('hello-world', HelloWorld);

// app.mount('#app');


// const $ = require('jquery'); Par défaut
// this "modifies" the jquery module: adding behavior to it
// the bootstrap module doesn't export/return anything
// require('bootstrap'); par défaut

// or you can include specific pieces
// require('bootstrap/js/dist/tooltip');
// require('bootstrap/js/dist/popover');

$(document).ready(function() {
    $('[data-toggle="popover"]').popover();
});
// assets/app.js  
// import './styles/app.css'; // A voir plus tard

const entreeSortie = document.getElementById('entreeSortie');

loginBtn.addEventListener('click', () => {
    if (entreeSortie.textContent === 'Connexion') {
        // Rediriger vers la page de connexion
        window.location.href = '/login';
    } else {
        // Déconnecter l'utilisateur
        fetch('/logout', {
            method: 'POST'
        })
        .then(() => {
            // Actualiser la page après la déconnexion
            window.location.reload();
        })
        .catch((error) => {
            console.error('Error:', error);
        });
    }
});





