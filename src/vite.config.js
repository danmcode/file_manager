import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    server: {
        host: true,       // ← importante
        port: 5173,       // puerto que abrimos en docker-compose
        hmr: {
            host: 'localhost', // o el dominio que uses
        },
    },
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
});
