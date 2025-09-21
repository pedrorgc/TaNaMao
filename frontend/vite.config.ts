import { defineConfig } from 'vite';
import react from '@vitejs/plugin-react';

export default defineConfig({
  plugins: [react()],
  build: {
    outDir: '../backend/public/build',  // Laravel vai servir os assets
    emptyOutDir: true,
    rollupOptions: {
      input: './src/main.tsx',           // Ponto de entrada principal do frontend
    },
  },
});
