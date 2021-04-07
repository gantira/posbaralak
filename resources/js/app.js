require('./bootstrap');

import { InertiaProgress } from '@inertiajs/progress';
import { App, plugin } from '@inertiajs/inertia-vue'
import Vue from 'vue'
import vuetify from './plugins/vuetify'

Vue.use(plugin)
Vue.mixin({ methods: { route } })

const el = document.getElementById('app')

new Vue({
    vuetify,
    render: h => h(App, {
        props: {
            initialPage: JSON.parse(el.dataset.page),
            resolveComponent: name => require(`./Pages/${name}`).default,
        },
    }),
})

    .$mount(el)

InertiaProgress.init({ color: 'red' });
