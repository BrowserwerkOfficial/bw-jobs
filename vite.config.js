import { defineConfig } from 'vite';

// eslint-disable-next-line import/no-default-export
export default defineConfig({
  build: {
    outDir: './Resources/Public/JavaScript',
    emptyOutDir: true,
    minify: true,
    rollupOptions: {
      input: ['./Resources/Private/JavaScript/jobs-list.js'],
      output: {
        entryFileNames: '[name].js',
        chunkFileNames: '[name].js',
        assetFileNames: '[name].[ext]',
      },
    },
  },
});
