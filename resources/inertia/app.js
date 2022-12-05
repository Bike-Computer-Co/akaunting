import Vue from 'vue'
import { createInertiaApp, Link } from '@inertiajs/inertia-vue'
import { InertiaProgress } from '@inertiajs/progress'
import 'bootstrap'

const moment = require('moment')
Vue.component('Link', Link)
require('moment/locale/mk')
Vue.use(require('vue-moment'), {
    moment
})

Vue.prototype.$route = route;
InertiaProgress.init()
createInertiaApp({
    resolve: name => require(`./Pages/${name}`),
    setup({ el, App, props, plugin }) {
        Vue.use(plugin)

        new Vue({
            render: h => h(App, props),
        }).$mount(el)
    },
})
