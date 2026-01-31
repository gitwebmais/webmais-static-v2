document.querySelectorAll('svg[data-icon]').forEach(el => {
  const [sprite, name] = el.dataset.icon.split(':')

  el.innerHTML = `
    <use href="/dist/icons/${sprite}.svg?v=2#${name}"></use>
  `
});