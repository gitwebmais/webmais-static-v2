import '../css/main.css';

document.addEventListener('DOMContentLoaded', () => {

  // Glide
  if (document.querySelector('[data-glide]')) {
    import('./modules/glide.js');
  }

  // Lightbox
  if (document.querySelector('.video')) {
    import('./modules/lightbox.js');
  }

  // SVG Sprite
  if (document.querySelector('svg[data-icon]')) {
    import('./modules/sprite.js');
  }

  // Header scroll
  if (document.querySelector('[data-header]')) {
    import('./modules/header-scroll.js').then(m => {
      m.default();
    });
  }

  // Megamenu
  if (document.querySelector('[data-flyout-trigger]')) {
  import('./modules/megamenu.js').then(m => m.default());
  }

  // Menu mobile — apenas mobile
  if (document.querySelector('.menu-mobile')) {
    import('./modules/menu-mobile.js')
      .then(module => module.default())
  }

  // CTA expand
  if (document.querySelector('.cta-expand')) {
    import('./animations/cta.js')
      .then(module => module.default())
  }

});