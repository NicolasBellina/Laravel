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
        manifest: true,  // Assurez-vous que la génération du manifeste est activée
        outDir: 'public/build',  // Indique le dossier de sortie
        rollupOptions: {
            input: 'resources/js/app.js',  // Fichier d'entrée
        },
    },
});
