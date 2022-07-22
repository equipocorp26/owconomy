require('./bootstrap');
window.Vue = require('vue').default;
/* --- Commons --- */
/* ------ Forms ------ */
Vue.component('form-basic-input-component', require('./components/commons/inputs/BasicInputComponent.vue').default);
/* ------ Modal ------ */
/* ------ Elements ------ */
Vue.component('balance-card-component', require('./components/commons/elements/BalanceCardComponent.vue').default);
Vue.component('modal-component', require('./components/commons/elements/ModalComponent.vue').default);
/* --- Auth --- */
Vue.component('balances-index-component', require('./components/balances/BalancesIndexComponent.vue').default);
/* --- Auth --- */
Vue.component('login-component', require('./components/auth/LoginComponent.vue').default);

const app = new Vue({
    el: '#app'
}).$mount('#app')
