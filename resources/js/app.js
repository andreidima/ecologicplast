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


const carte = createApp({
    el: '#carte',
    data() {
        return {
            carti: carti,

            autor_autocomplete: autor,
            carti_lista_autor_autocomplete: [],
            editura_autocomplete: editura,
            carti_lista_editura_autocomplete: [],
            loc_publicare_autocomplete: loc_publicare,
            carti_lista_loc_publicare_autocomplete: [],
            limba_autocomplete: limba,
            carti_lista_limba_autocomplete: [],
            tip_material_autocomplete: tip_material,
            carti_lista_tip_material_autocomplete: [],
            locatie_autocomplete: locatie,
            carti_lista_locatie_autocomplete: [],
            // fisa_de_tratament_id: fisaDeTratamentIdVechi,
        }
    },
    created: function () {
    },
    methods: {
        // Autocomplete pentru autor folosind carti trimise din start in vuejs
        autorAutoComplete: function () {
            this.carti_lista_autor_autocomplete = [];
            if (this.autor_autocomplete.length > 2) {
                for (var i = 0; i < this.carti.length; i++) {
                    if (this.carti[i].autor.toLowerCase().includes(this.autor_autocomplete.toLowerCase())) {
                        this.carti_lista_autor_autocomplete.push(this.carti[i]);
                    }
                }
            }
        },
        // Autocomplete pentru editura folosind carti trimise din start in vuejs
        edituraAutoComplete: function () {
            this.carti_lista_editura_autocomplete = [];
            if (this.editura_autocomplete.length > 2) {
                for (var i = 0; i < this.carti.length; i++) {
                    if (this.carti[i].editura.toLowerCase().includes(this.editura_autocomplete.toLowerCase())) {
                        this.carti_lista_editura_autocomplete.push(this.carti[i]);
                    }
                }
            }
        },
        // Autocomplete pentru loc_publicare folosind carti trimise din start in vuejs
        loc_publicareAutoComplete: function () {
            this.carti_lista_loc_publicare_autocomplete = [];
            if (this.loc_publicare_autocomplete.length > 2) {
                for (var i = 0; i < this.carti.length; i++) {
                    if (this.carti[i].loc_publicare.toLowerCase().includes(this.loc_publicare_autocomplete.toLowerCase())) {
                        this.carti_lista_loc_publicare_autocomplete.push(this.carti[i]);
                    }
                }
            }
        },
        // Autocomplete pentru limba folosind carti trimise din start in vuejs
        limbaAutoComplete: function () {
            this.carti_lista_limba_autocomplete = [];
            if (this.limba_autocomplete.length > 2) {
                for (var i = 0; i < this.carti.length; i++) {
                    if (this.carti[i].limba.toLowerCase().includes(this.limba_autocomplete.toLowerCase())) {
                        this.carti_lista_limba_autocomplete.push(this.carti[i]);
                    }
                }
            }
        },
        // Autocomplete pentru tip_material folosind carti trimise din start in vuejs
        tip_materialAutoComplete: function () {
            this.carti_lista_tip_material_autocomplete = [];
            if (this.tip_material_autocomplete.length > 2) {
                for (var i = 0; i < this.carti.length; i++) {
                    if (this.carti[i].tip_material.toLowerCase().includes(this.tip_material_autocomplete.toLowerCase())) {
                        this.carti_lista_tip_material_autocomplete.push(this.carti[i]);
                    }
                }
            }
        },
        // Autocomplete pentru locatie folosind carti trimise din start in vuejs
        locatieAutoComplete: function () {
            this.carti_lista_locatie_autocomplete = [];
            if (this.locatie_autocomplete.length > 2) {
                for (var i = 0; i < this.carti.length; i++) {
                    if (this.carti[i].locatie.toLowerCase().includes(this.locatie_autocomplete.toLowerCase())) {
                        this.carti_lista_locatie_autocomplete.push(this.carti[i]);
                    }
                }
            }
        },
    }
});

carte.mount('#carte');
