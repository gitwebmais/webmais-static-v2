import gsap from 'gsap'

export default function cardsCarousel() {
  const cards = gsap.utils.toArray('.cards li')
  const next = document.querySelector('.next')
  const prev = document.querySelector('.prev')

  if (!cards.length || !next || !prev) return

  let current = 0
  const max = cards.length - 1

  // estado inicial
  gsap.set(cards, {
    opacity: 0,
    scale: 0.7,
    xPercent: 100
  })

  update()

  next.addEventListener('click', () => {
    if (current < max) {
      current++
      update()
    }
  })

  prev.addEventListener('click', () => {
    if (current > 0) {
      current--
      update()
    }
  })

  function update() {
    cards.forEach((card, i) => {
      if (i === current) {
        gsap.to(card, {
          opacity: 1,
          scale: 1,
          xPercent: 0,
          zIndex: 3,
          duration: 0.6,
          ease: 'power3.out'
        })
      } else if (i === current - 1) {
        gsap.to(card, {
          opacity: 0.5,
          scale: 0.85,
          xPercent: -120,
          zIndex: 2,
          duration: 0.6
        })
      } else if (i === current + 1) {
        gsap.to(card, {
          opacity: 0.5,
          scale: 0.85,
          xPercent: 120,
          zIndex: 2,
          duration: 0.6
        })
      } else {
        gsap.to(card, {
          opacity: 0,
          scale: 0.6,
          xPercent: i < current ? -200 : 200,
          zIndex: 1,
          duration: 0.6
        })
      }
    })
  }
}