require('./bootstrap');

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress';
import globalView_ from './Globales/globalView.vue';
import global_ from './Globales/global.vue';

const Quagga = require('quagga').default;

const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'ADMFPL';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => require(`./Pages/${name}.vue`),
    setup({ el, app, props, plugin }) {
        return createApp({ render: () => h(app, props) })
            .use(plugin)
            .use(globalView_)
            .use(global_)
            .use(Quagga)
            .mixin({ methods: { route } })
            .mount(el);
    },
});

InertiaProgress.init({ color: '#4B5563' });
