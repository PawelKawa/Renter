// import './bootstrap';

import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/vue3'
import '../css/app.css'
import { Link } from '@inertiajs/vue3'
import {ZiggyVue} from 'ziggy'
import { InertiaProgress } from '@inertiajs/progress'
InertiaProgress.init({
    delay:0,
    // color: '#29d',
    includeCSS: true,
    showSpinner: true
})
createInertiaApp({
    resolve: (name) => {
        const pages = import.meta.glob('./Pages/**/*.vue', { eager: true })
        return pages[`./Pages/${name}.vue`]
    },
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .component('Link', Link)
            .use(plugin)
            .use(ZiggyVue)
            .mount(el)
    },
})
