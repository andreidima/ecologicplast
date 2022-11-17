/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

// require('./bootstrap');
import './bootstrap';

import '../sass/app.scss'
import '../css/andrei.css'


import { createApp } from 'vue/dist/vue.esm-bundler.js'

// import App from './App.vue'

// createApp(App).mount("#app")

// window.Vue = require('vue').default;
// window.Vue = import ('vue').default;

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

import VueDatepickerNext from './components/DatePicker.vue';

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// if (document.querySelector('#app')) {
//     const app = new Vue({
//         el: '#app',
//     });
// }


const client = createApp({
    // el: '#client',
    data() {
        return {
        }
    },
    components: {
        'vue-datepicker-next': VueDatepickerNext,
        // 'example-component-2': VueDatepickerNext,
    },
});

if (document.getElementById('client') != null) {
    client.mount('#client');
}
