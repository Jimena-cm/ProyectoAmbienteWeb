document.addEventListener('DOMContentLoaded', function () {

  const revealTargets = document.querySelectorAll(
    '.cdp-servicio-card, .cdp-historia-texto'
  );

  if ('IntersectionObserver' in window && revealTargets.length) {
    const observer = new IntersectionObserver((entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          entry.target.classList.add('cdp-visible');
          observer.unobserve(entry.target);
        }
      });
    }, { threshold: 0.2 });

    revealTargets.forEach((el, index) => {
      if (el.classList.contains('cdp-servicio-card')) {
        el.style.setProperty('--reveal-delay', (index * 0.12) + 's');
      }
      observer.observe(el);
    });
  } else {
    revealTargets.forEach((el) => el.classList.add('cdp-visible'));
  }
  const carouselEl = document.getElementById('cdpCarruselPlacas');
  if (carouselEl && window.bootstrap) {
    const carousel = window.bootstrap.Carousel.getOrCreateInstance(carouselEl, {
      interval: 5500,
      pause: false,
      touch: true
    });

    carouselEl.addEventListener('mouseenter', () => carousel.pause());
    carouselEl.addEventListener('mouseleave', () => carousel.cycle());
  }

});