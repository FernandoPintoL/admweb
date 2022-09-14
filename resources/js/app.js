require('./bootstrap');

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress';
import $ from './../../public/js/jquery-3.6.1';
import DataTable from 'datatables.net-vue3';
import globalView from "@/Globales/globalView.vue";
require("jszip");
require("pdfmake");
require("datatables.net-se");
// import 'bootstrap/dist/css/bootstrap.min.css';
import 'flowbite';
// import '@coreui/coreui/dist/css/coreui.min.css'

const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'ADMFPL';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => require(`./Pages/${name}.vue`),
    setup({ el, app, props, plugin }) {
        // var datatable = function (idTable) {
        //     $(document).ready(function () {
        //         $("#tables").DataTable();
        //     });
        // }
        return createApp({ render: () => h(app, props) })
            .use(plugin)
            .use($)
            .use(DataTable)
            .use(globalView)
            // .use(datatable)
            .mixin({ methods: { route } })
            .mount(el);
    },
});

InertiaProgress.init({ color: '#4B5563' });
