/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');



window.Vue = require('vue');
import VueRouter from 'vue-router'
Vue.use(VueRouter)

import { Form, HasError, AlertError, AlertSuccess } from 'vform'

window.Form = Form;
Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)
Vue.component(AlertSuccess.name, AlertSuccess)

// import Gate.js for user authorizations
import Gate from './Gate';
Vue.prototype.$gate = new Gate(window.user);

Vue.component('pagination', require('laravel-vue-pagination'));

import VueProgressBar from 'vue-progressbar'
const options = {
  color: '#bffaf3',
  failedColor: '#874b4b',
  thickness: '5px',
  transition: {
    speed: '0.2s',
    opacity: '0.6s',
    termination: 300
  }
}

Vue.use(VueProgressBar, options)

// axios configurations
const axios = require('axios');
axios.defaults.baseURL = 'http://localhost/uwezo';
// window.axios.defaults.headers.common = {'X-Requested-With': 'XMLHttpRequest'};
// window.axios.defaults.headers['X-CSRF-TOKEN'] = window.Laravel.csrfToken;

// ES6 Modules or TypeScript
import Swal from 'sweetalert2'
// CommonJS
window.swal = Swal;

const Toast = Swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 3000
});

window.Toast = Toast;

// Vue JS Date Time Picker
import datetime from 'vuejs-datetimepicker';
window.datetime = datetime;

import DataTable from "vue-materialize-datatable";
window.DataTable = DataTable

Vue.component('nav-bar', require('./components/common/Navbar.vue').default);
Vue.component('start-trip', require('./components/common/Trip.vue').default);
Vue.component('not-found', require('./components/errors/NotFound.vue').default);

var VueTruncate = require('vue-truncate-filter')
Vue.use(VueTruncate)

import vSelect from 'vue-select'
Vue.component('v-select', vSelect)
import 'vue-select/dist/vue-select.css';

import numFormat from 'vue-filter-number-format'; 
Vue.filter('numFormat', numFormat);

// moment js
Vue.use(require('vue-moment'));

//element JS
import Vue from 'vue'
import Element from 'element-ui'
import 'element-ui/lib/theme-chalk/index.css';

Vue.use(Element)

// Vue Ctk Date-Time Picker
import VueCtkDateTimePicker from 'vue-ctk-date-time-picker';
import 'vue-ctk-date-time-picker/dist/vue-ctk-date-time-picker.css';

Vue.component('vue-date-picker', VueCtkDateTimePicker);




//Register the view routes

// 2. Define some routes
// Each route should map to a component. The "component" can
// either be an actual component constructor created via
// `Vue.extend()`, or just a component options object.
// We'll talk about nested routes later.
let routes = [
    

    // REAL ESTATE ROUTES

    { path: '/properties', component: require('./components/properties/Index.vue').default},
    { path: '/properties/create', component: require('./components/properties/Create.vue').default},
    { path: '/properties/types', component: require('./components/properties/Types.vue').default},
    { path: '/properties/:id/show', component: require('./components/properties/Show.vue').default},
    { path: '/properties/:id/edit', component: require('./components/properties/Edit.vue').default},
    { path: '/properties/:id/units', component: require('./components/properties/Units.vue').default},

    { path: '/activities', component: require('./components/maintenance/Index.vue').default},
    { path: '/providers', component: require('./components/providers/Index.vue').default},
    { path: '/work_orders', component: require('./components/providers/Orders.vue').default},

    { path: '/landlords', component: require('./components/landlords/Index.vue').default},
    { path: '/landlords/create', component: require('./components/landlords/Create.vue').default},
    { path: '/landlords/:id/show', component: require('./components/landlords/Show.vue').default},
    { path: '/landlords/:id/edit', component: require('./components/landlords/Edit.vue').default},

    { path: '/tenants', component: require('./components/tenants/Index.vue').default},
    { path: '/tenants/create', component: require('./components/tenants/Create.vue').default},
    { path: '/tenants/:id/show', component: require('./components/tenants/Show.vue').default},
    { path: '/tenants/:id/edit', component: require('./components/tenants/Edit.vue').default},

    { path: '/invoices', component: require('./components/invoices/Index.vue').default},
    { path: '/invoices/tenant', component: require('./components/invoices/Tenant.vue').default},
    { path: '/invoices/landlord', component: require('./components/invoices/Landlord.vue').default},

    { path: '/bills', component: require('./components/bills/Index.vue').default},
    { path: '/receipts', component: require('./components/receipts/Index.vue').default},
    { path: '/payments', component: require('./components/payments/Index.vue').default},

    { path: '/service_charges', component: require('./components/charges/Index.vue').default},

    { path: '/reports/invoices', component: require('./components/reports/invoices/Index.vue').default},
    { path: '/reports/invoice/:id', component: require('./components/windows/Invoice.vue').default},
    { path: '/reports/tenants/:id/invoice', component: require('./components/tenants/Invoice.vue').default},


    // END REAL ESTATE ROUTES   

  ]

// 3. Create the router instance and pass the `routes` option
// You can pass in additional options here, but let's
// keep it simple for now.
const router = new VueRouter({
    base: '/uwezo/',
    mode: 'history',
    routes // short for `routes: routes`
})

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component('example-component', require('./components/ExampleComponent.vue').default);


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    router,
    data:{
      counter: 0,
    },

    props: {
      userName: String,
    }
});
