export default function ctaExpand() {
  const cta = document.querySelector('.cta-expand')

  if (!cta) return

  const observer = new IntersectionObserver(
    ([entry]) => {
      if (entry.isIntersecting) {
        cta.classList.add('is-visible')
        observer.disconnect()
      }
    },
    { threshold: 0.4 }
  )

  observer.observe(cta)
}