/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import "./bootstrap";
import "./eventBus";

import Vue from "vue";
import vSelect from "vue-select";
import { ServerTable, ClientTable, Event } from "vue-tables-2";
import VeeValidate from "vee-validate";

Vue.use(VeeValidate, {
    classes: true,
    classNames: {
        valid: "is-valid",
        invalid: "is-invalid"
    }
});
Vue.use(ClientTable);

window.Vue = require("vue");
window.swal = require("sweetalert");
// import Vuetable from 'vuetable-2'
Vue.component("v-select", vSelect);
Vue.component(
    "form-sales",
    require("./components/module/sales/FormSales.vue").default
);
Vue.component(
    "form-purchases",
    require("./components/module/purchases/FormPurchases.vue").default
);
Vue.component(
    "form-wind-shield",
    require("./components/module/wind_shield/FormWindShield.vue").default
);
Vue.component("chart", require("./components/LineChart.vue").default);
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component(
    "example-component",
    require("./components/ExampleComponent.vue").default
);
Vue.component("vue-select", require("./components/VueSelect.vue").default);
Vue.component(
    "input-multiple-text",
    require("./components/InputMultipleText.vue").default
);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: "#app"
});
