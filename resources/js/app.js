// resources/js/app.js

require('./bootstrap');

window.Vue = require('vue').default;

import Toast from "vue-toastification";
import "vue-toastification/dist/index.css";

const options = {
  // Puedes agregar opciones de configuración aquí si lo deseas
};

Vue.use(Toast, options);

Vue.component('search', require('./views/Search.vue').default);

const app = new Vue({
    el: '#app',
});
