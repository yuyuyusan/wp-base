import Splide from '@splidejs/splide';
console.log('splide.ts');


new Splide( '.splide' ).mount();

document.addEventListener( 'DOMContentLoaded', function() {
  var splide = new Splide( '.splide' );
  splide.mount();
} );