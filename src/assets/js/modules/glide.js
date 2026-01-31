import Glide from '@glidejs/glide'
import '@glidejs/glide/dist/css/glide.core.min.css'
import '@glidejs/glide/dist/css/glide.theme.min.css'

document.querySelectorAll('[data-glide]').forEach(slider => {
  const config = slider.dataset.config
    ? JSON.parse(slider.dataset.config)
    : {}

  new Glide(slider, config).mount()
});