import Vue from 'vue'
import 'bootstrap'
import { createInertiaApp, Link } from '@inertiajs/inertia-vue'
import { InertiaProgress } from '@inertiajs/progress'
Vue.component('Link', Link)
InertiaProgress.init()
createInertiaApp({
    resolve: name => {
        return require(`./Pages/${name}`).default
    },
    setup({el, app, props}) {
        new Vue({
            render: h => h(app, props),
        }).$mount(el)
    },
})
