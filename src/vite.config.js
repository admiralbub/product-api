import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
     server: {
        host: '0.0.0.0',
        port: 3000,
        hmr: {
            host: '192.168.2.132'
        }
    },
    css: {
        preprocessorOptions: {
          scss: {
            silenceDeprecations: ["legacy-js-api"],
          },
        },
      },
    plugins: [
        laravel({
            input: [
                'resources/scss/app.scss',
                'resources/scss/admin/app.scss', 
                'resources/js/admin/admin.js',
                'resources/js/app.js'
            ],
            refresh: true,
        }),
    ],

    
});
