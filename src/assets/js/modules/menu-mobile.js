export default function menuMobile() {
  const toggle = document.querySelector('.menu-toggle')
  const menu = document.querySelector('.menu-mobile')
  const overlay = document.querySelector('.menu-overlay')

  if (!toggle || !menu || !overlay) return

  const submenuToggles = menu.querySelectorAll('.submenu-toggle')

  const openMenu = () => {
    menu.classList.add('is-open')
    overlay.classList.add('is-active')
    toggle.setAttribute('aria-expanded', 'true')
    menu.setAttribute('aria-hidden', 'false')
    document.body.style.overflow = 'hidden'
  }

  const closeMenu = () => {
    menu.classList.remove('is-open')
    overlay.classList.remove('is-active')
    toggle.setAttribute('aria-expanded', 'false')
    menu.setAttribute('aria-hidden', 'true')
    document.body.style.overflow = ''
  }

  toggle.addEventListener('click', openMenu)
  overlay.addEventListener('click', closeMenu)

  submenuToggles.forEach(btn => {
  btn.addEventListener('click', () => {
    const currentItem = btn.closest('.has-submenu')
    if (!currentItem) return

    // Fecha todos os outros submenus
    menu.querySelectorAll('.has-submenu.is-open').forEach(item => {
      if (item !== currentItem) {
        item.classList.remove('is-open')
      }
    })

    // Alterna o atual
    currentItem.classList.toggle('is-open')
    })
  })
}
