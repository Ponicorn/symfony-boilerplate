import { defineConfig } from 'vite';

export default defineConfig({
    root: './assets',
    base: '/build/',
    server: {
        port: 3000,
    },
    envDir: '../',
    build: {
        manifest: true,
        assetsDir: '',
        outDir: '../public/build',
        rollupOptions: {
            input: {
                'app.js': './assets/app.js',
            },
        },
    },
});
