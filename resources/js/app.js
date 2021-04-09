require('./bootstrap');

import { InertiaProgress } from '@inertiajs/progress';
import { App, plugin } from '@inertiajs/inertia-vue'
import Vue from 'vue'
import vuetify from './plugins/vuetify'
import ButtonSubmit from "@/Components/Button";
import Admin from "@/Layouts/Admin";

Vue.use(plugin)
Vue.mixin({ methods: { route } })
Vue.component('button-submit', ButtonSubmit)
Vue.component('admin-layout', Admin)

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
