import { defineConfig } from 'vite'
import vue from '@vitejs/plugin-vue'

// https://vitejs.dev/config/
export default defineConfig({
  plugins: [vue()],
  server: {
    host: true,
    hmr: {port: 80},
    port: 8080,
    watch: {
      usePolling: true
    }
  }
})
