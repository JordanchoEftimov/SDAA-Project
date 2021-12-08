import Vue from 'vue'
import 'bootstrap'
import { createInertiaApp, Link } from '@inertiajs/inertia-vue'
import { InertiaProgress } from '@inertiajs/progress'
import { LMap, LTileLayer, LMarker } from 'vue2-leaflet';
import 'leaflet/dist/leaflet.css';

Vue.component('l-map', LMap);
Vue.component('l-tile-layer', LTileLayer);
Vue.component('l-marker', LMarker);
Vue.component('Link', Link)
Vue.prototype.$route = route;
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
