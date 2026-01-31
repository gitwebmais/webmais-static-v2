export default function flyoutMenu() {
  const triggers = document.querySelectorAll('[data-flyout-trigger]');

  triggers.forEach(trigger => {
    const id = trigger.dataset.flyout;
    const panel = document.querySelector(
      `[data-flyout-content="${id}"]`
    );

    if (!panel) return;

    let timeout;

    // Abre ao clicar no botão
    trigger.addEventListener('click', () => {
      clearTimeout(timeout);
      panel.classList.remove('hidden');
      trigger.classList.add('is-active');
    });

    // Fecha com delay ao sair do conjunto (botão + painel)
    trigger.parentElement.addEventListener('mouseleave', () => {
      timeout = setTimeout(() => {
        panel.classList.add('hidden');
        trigger.classList.remove('is-active');
      }, 120);
    });

    // Mantém aberto ao entrar no painel
    panel.addEventListener('mouseenter', () => {
      clearTimeout(timeout);
    });

    // Fecha ao sair do painel
    panel.addEventListener('mouseleave', () => {
      timeout = setTimeout(() => {
        panel.classList.add('hidden');
        trigger.classList.remove('is-active');
      }, 120);
    });
  });
}