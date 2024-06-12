// Récupérer la liste des Pokémon
fetch('https://pokeapi.co/api/v2/pokemon/')
  .then(response => response.json())
  .then(data => {
    // Afficher les Pokémon dans l'interface utilisateur
    const pokemonList = data.results.map(pokemon => `<option value="${pokemon.url}">${pokemon.name}</option>`).join('');
    document.getElementById('pokemon-select').innerHTML = pokemonList;
  });

// Ajouter un Pokémon au panier
const cart = [];
const addToCart = url => {
  fetch(url)
    .then(response => response.json())
    .then(pokemonData => {
      const pokemon = {
        name: pokemonData.name,
        sprite: pokemonData.sprites.front_default
      };
      cart.push(pokemon);
      // Afficher le contenu du panier
      displayCart();
    });
};

// Afficher le contenu du panier
const displayCart = () => {
  const cartList = cart.map(pokemon => `<li>${pokemon.name} <img src="${pokemon.sprite}" /></li>`).join('');
  document.getElementById('cart').innerHTML = cartList;
};
