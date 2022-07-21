require('./bootstrap');
window.Vue = require('vue').default;
/* --- Commons --- */
/* ------ Forms ------ */
Vue.component('form-basic-input-component', require('./components/commons/inputs/BasicInputComponent.vue').default);
/* --- Auth --- */
Vue.component('login-component', require('./components/auth/LoginComponent.vue').default);
const app = new Vue({
    el: '#app'
}).$mount('#app')
