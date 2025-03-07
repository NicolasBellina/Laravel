import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
    build: {
        manifest: true, // Assure-toi que le manifeste est activé
        outDir: 'public/build', // Vérifie que la sortie est définie vers 'public/build'
        rollupOptions: {
            input: '/resources/js/app.js', // Assure-toi que le fichier d'entrée est correct
        },
    },
});
