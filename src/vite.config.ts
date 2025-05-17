import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';
import path from 'path';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.ts'],
            refresh: true,
        }),
        vue()
    ],
    resolve: {
        alias: {
            '@': path.resolve(__dirname, 'resources/js'),
            ziggy: path.resolve('vendor/tightenco/ziggy'),
        },
    },
    server: {
        host: '0.0.0.0',
        port: 5173,
        strictPort: true,

        origin: 'http://localhost:5173',

        cors: {
            origin: ['http://localhost:8000'],
            credentials: true,
        },

        hmr: {
            protocol: 'ws',
            host: 'localhost',
            port: 5173,
            clientPort: 5173,
        },

        proxy: {
            '/api': {
                target: 'http://localhost:8000',
                changeOrigin: true,
                secure: false,
            },
            '^/(login|logout|sanctum|register)': {
                target: 'http://localhost:8000',
                changeOrigin: true,
                secure: false,
            }
        },
    },
});
