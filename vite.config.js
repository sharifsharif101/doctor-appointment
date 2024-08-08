import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
    ],
    resolve: {
        alias: {
            vue: 'vue/dist/vue.esm-bundler.js',
        },
    },
});

// الدورة للبرنامج انو الزول يسجل اول حاجة 
// الدكتور لازم يعرض المواعيد بتاعتو المتاحة 
// المواعيد بتظهر للبزبون 
// المواعيد لاتظهر للدكتور مالم يوافق عليها الادمن 
// اذا وافق الادمن يقدر يضيف الوصفة التي يريدها الدكتور
//تعريب البرنامج
//اضافة امكانية ان الدكتور يقدر يعدل على الببرسكربشن او الوصفة


 
