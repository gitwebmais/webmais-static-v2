import { defineConfig } from 'vite'
import tailwindcss from '@tailwindcss/vite'

export default defineConfig(({ command }) => {
  return {
    plugins: [tailwindcss()],
    // Se for build, desativamos a cópia da pasta public para evitar duplicação
    publicDir: command === 'build' ? false : 'public',
    // Importante: No build, forçamos o prefixo /build/ No dev, mantemos a raiz /
    base: command === 'build' ? '/build/' : '/',
    build: {
      manifest: true,
      outDir: 'public/build',
      emptyOutDir: true,
      rollupOptions: {
        input: 'src/assets/js/main.js',
      }
    },
    server: {
      origin: 'http://localhost:5173', 
      strictPort: true,
      cors: true,
    }
  }
})