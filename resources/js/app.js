require('./bootstrap');

import Vue from 'vue'

import App from './App.vue'
import VueAxios from 'vue-axios';
import axios from 'axios';

import CreateColumns from './components/CreateColumns'

// creating a vue instance
Vue.use(VueAxios, axios);

const app = new Vue({
    el: '#app',
    components: {
        CreateColumns
    },
    render: h => h(App),

});

