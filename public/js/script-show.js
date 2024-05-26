const body = document.querySelector('.body-show');
const backgroundImage = body.dataset.background;      

body.style.backgroundImage = `url(${backgroundImage})`;
body.style.backgroundSize = 'cover';
body.style.backgroundPosition = 'center';