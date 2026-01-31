export default function headerScroll() {
  const header = document.querySelector('[data-header]');
  if (!header) return;

  let lastScroll = window.scrollY;
  let isHidden = false;

  function onScroll() {
    if (document.body.classList.contains('menu-open')) return;

    const currentScroll = window.scrollY;
    if (Math.abs(currentScroll - lastScroll) < 10) return;

    if (currentScroll > lastScroll && currentScroll > 100) {
      if (!isHidden) {
        header.classList.add('-translate-y-full');
        isHidden = true;
      }
    } else {
      if (isHidden) {
        header.classList.remove('-translate-y-full');
        isHidden = false;
      }
    }

    lastScroll = currentScroll;
  }

  window.addEventListener('scroll', onScroll, { passive: true });
}