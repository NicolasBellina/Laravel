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
        manifest: true,  // Activer la génération du manifeste
        outDir: 'public/build',  // Répertoire de sortie pour les fichiers construits
        rollupOptions: {
            input: 'resources/js/app.js',
        },
    },
});
