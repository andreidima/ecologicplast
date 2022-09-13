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

            nume_camp: '',
            valoare_camp: '',
            carti_lista_autocomplete: [],

            autor_autocomplete: autor,
            // autor: autor,
            carti_lista_autor_autocomplete: [],
            editura_autocomplete: editura,
            carti_lista_editura_autocomplete: [],
            loc_publicare_autocomplete: loc_publicare,
            carti_lista_loc_publicare_autocomplete: [],
            subiecte_autocomplete: subiecte,
            carti_lista_subiecte_autocomplete: [],
            limba_autocomplete: limba,
            carti_lista_limba_autocomplete: [],
            tip_material_autocomplete: tip_material,
            carti_lista_tip_material_autocomplete: [],
            locatie_autocomplete: locatie,
            carti_lista_locatie_autocomplete: [],
        }
    },
    watch: {
        autor_autocomplete: function () {
            // this.autocomplete();
        },
    },
    created: function () {
    },
    methods: {
        // autocomplete($value) {
        autocomplete() {
            this.carti_lista_autocomplete = [];
            var nume_camp = this.nume_camp;
            var valoare_camp = this.valoare_camp.split(/[\s,]+/).pop(); // se imparte stringul dupa virgule, si se ia ultimul element
            for (var i = 0; i < this.carti.length; i++) { // se parcurg toate cartile
                if (this.carti[i][nume_camp]) { // daca respectiva carte are valoare in respectivul camp
                    for (const element of this.carti[i][nume_camp].split(/[\s,]+/)) { // se imparte campul, dupa virgula, in elemente
                        if (valoare_camp && element.toLowerCase().includes(valoare_camp.toLowerCase())) { // daca elementul are stringul de cautare
                            if (!this.carti_lista_autocomplete.includes(element)) { // daca elementul nu este deja inclus
                                this.carti_lista_autocomplete.push(element); // se adauga elementul in array
                            }
                        }
                    }
                }
            }
        },
        // Autocomplete pentru autor folosind carti trimise din start in vuejs
        autorAutoComplete: function () {
            this.carti_lista_autor_autocomplete = [];
            var autor_autocomplete = this.autor_autocomplete.split(/[\s,]+/).pop(); // se imparte stringul dupa virgule, si se ia ultimul element
            if (autor_autocomplete.length > 2) {
                for (var i = 0; i < this.carti.length; i++) {
                    if (this.carti[i].autor){
                        for (const autor of this.carti[i].autor.split(/[\s,]+/)) {
                            if (autor.toLowerCase().includes(autor_autocomplete.toLowerCase()) &&
                                !this.carti_lista_autor_autocomplete.includes(autor) ) {
                                this.carti_lista_autor_autocomplete.push(autor);
                            }
                        }
                    }
                }
            }
        },
        // Autocomplete pentru editura folosind carti trimise din start in vuejs
        edituraAutoComplete: function () {
            this.carti_lista_editura_autocomplete = [];
            var editura_autocomplete = this.editura_autocomplete.split(/[\s,]+/).pop(); // se imparte stringul dupa virgule, si se ia ultimul element
            if (editura_autocomplete.length > 2) {
                for (var i = 0; i < this.carti.length; i++) {
                    if (this.carti[i].editura) {
                        for (const editura of this.carti[i].editura.split(/[\s,]+/)) {
                            if (editura.toLowerCase().includes(editura_autocomplete.toLowerCase()) &&
                                !this.carti_lista_editura_autocomplete.includes(editura)) {
                                this.carti_lista_editura_autocomplete.push(editura);
                            }
                        }
                    }
                }
            }
        },
        // Autocomplete pentru loc_publicare folosind carti trimise din start in vuejs
        loc_publicareAutoComplete: function () {
            this.carti_lista_loc_publicare_autocomplete = [];
            var loc_publicare_autocomplete = this.loc_publicare_autocomplete.split(/[\s,]+/).pop(); // se imparte stringul dupa virgule, si se ia ultimul element
            if (loc_publicare_autocomplete.length > 2) {
                for (var i = 0; i < this.carti.length; i++) {
                    if (this.carti[i].loc_publicare) {
                        for (const loc_publicare of this.carti[i].loc_publicare.split(/[\s,]+/)) {
                            if (loc_publicare.toLowerCase().includes(loc_publicare_autocomplete.toLowerCase()) &&
                                !this.carti_lista_loc_publicare_autocomplete.includes(loc_publicare)) {
                                this.carti_lista_loc_publicare_autocomplete.push(loc_publicare);
                            }
                        }
                    }
                }
            }
        },
        // Autocomplete pentru subiecte folosind carti trimise din start in vuejs
        subiecteAutoComplete: function () {
            this.carti_lista_subiecte_autocomplete = [];
            var subiecte_autocomplete = this.subiecte_autocomplete.split(/[\s,]+/).pop(); // se imparte stringul dupa virgule, si se ia ultimul element
            if (subiecte_autocomplete.length > 2) {
                for (var i = 0; i < this.carti.length; i++) {
                    if (this.carti[i].subiecte) {
                        for (const subiecte of this.carti[i].subiecte.split(/[\s,]+/)) {
                            if (subiecte.toLowerCase().includes(subiecte_autocomplete.toLowerCase()) &&
                                !this.carti_lista_subiecte_autocomplete.includes(subiecte)) {
                                this.carti_lista_subiecte_autocomplete.push(subiecte);
                            }
                        }
                    }
                }
            }
        },
        // Autocomplete pentru limba folosind carti trimise din start in vuejs
        limbaAutoComplete: function () {
            this.carti_lista_limba_autocomplete = [];
            var limba_autocomplete = this.limba_autocomplete.split(/[\s,]+/).pop(); // se imparte stringul dupa virgule, si se ia ultimul element
            if (limba_autocomplete.length > 2) {
                for (var i = 0; i < this.carti.length; i++) {
                    if (this.carti[i].limba) {
                        for (const limba of this.carti[i].limba.split(/[\s,]+/)) {
                            if (limba.toLowerCase().includes(limba_autocomplete.toLowerCase()) &&
                                !this.carti_lista_limba_autocomplete.includes(limba)) {
                                this.carti_lista_limba_autocomplete.push(limba);
                            }
                        }
                    }
                }
            }
        },
        // Autocomplete pentru tip_material folosind carti trimise din start in vuejs
        tip_materialAutoComplete: function () {
            this.carti_lista_tip_material_autocomplete = [];
            var tip_material_autocomplete = this.tip_material_autocomplete.split(/[\s,]+/).pop(); // se imparte stringul dupa virgule, si se ia ultimul element
            if (tip_material_autocomplete.length > 2) {
                for (var i = 0; i < this.carti.length; i++) {
                    if (this.carti[i].tip_material) {
                        for (const tip_material of this.carti[i].tip_material.split(/[\s,]+/)) {
                            if (tip_material.toLowerCase().includes(tip_material_autocomplete.toLowerCase()) &&
                                !this.carti_lista_tip_material_autocomplete.includes(tip_material)) {
                                this.carti_lista_tip_material_autocomplete.push(tip_material);
                            }
                        }
                    }
                }
            }
        },
        // Autocomplete pentru locatie folosind carti trimise din start in vuejs
        locatieAutoComplete: function () {
            this.carti_lista_locatie_autocomplete = [];
            var locatie_autocomplete = this.locatie_autocomplete.split(/[\s,]+/).pop(); // se imparte stringul dupa virgule, si se ia ultimul element
            if (locatie_autocomplete.length > 2) {
                for (var i = 0; i < this.carti.length; i++) {
                    if (this.carti[i].locatie) {
                        for (const locatie of this.carti[i].locatie.split(/[\s,]+/)) {
                            if (locatie.toLowerCase().includes(locatie_autocomplete.toLowerCase()) &&
                                !this.carti_lista_locatie_autocomplete.includes(locatie)) {
                                this.carti_lista_locatie_autocomplete.push(locatie);
                            }
                        }
                    }
                }
            }
        },
    }
});

carte.mount('#carte');
