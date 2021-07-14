require('./bootstrap');
import Vue from 'vue'

//import components
import App from './App.vue'
import AppTest from './AppTest.vue'

import VueAxios from 'vue-axios';
import axios from 'axios';

//styles
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

import CreateColumns from './components/CreateColumns'


Vue.use(VueAxios, axios);
Vue.config.productionTip = false

// Install BootstrapVue
Vue.use(BootstrapVue)
// Optionally install the BootstrapVue icon components plugin
Vue.use(IconsPlugin)


// creating a vue instance
const app = new Vue({
    el: '#app',
    components: {
        CreateColumns
    },
    render: h => h(AppTest),

});

