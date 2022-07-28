require('./bootstrap');
window.Vue = require('vue').default;
/* --- Commons --- */
/* ------ Forms ------ */
Vue.component('form-basic-input-component', require('./components/commons/inputs/BasicInputComponent.vue').default);
/* ------ Modal ------ */
/* ------ Elements ------ */
Vue.component('balance-card-component', require('./components/commons/elements/BalanceCardComponent.vue').default);
Vue.component('activity-item-component', require('./components/commons/elements/ActivityItemComponent.vue').default);
Vue.component('modal-component', require('./components/commons/elements/ModalComponent.vue').default);
Vue.component('pagination-component', require('./components/commons/elements/PaginationComponent.vue').default);
/* --- Balances --- */
Vue.component('balances-index-component', require('./components/balances/BalancesIndexComponent.vue').default);
Vue.component('balances-show-component', require('./components/balances/BalancesShowComponent.vue').default);
Vue.component('balances-form-component', require('./components/balances/BalancesFormComponent.vue').default);
/* --- Movements --- */
Vue.component('movements-form-component', require('./components/movements/MovementsFormComponent.vue').default);
Vue.component('movements-details-component', require('./components/movements/MovementsDetailsComponent.vue').default);
/* --- Auth --- */
Vue.component('login-component', require('./components/auth/LoginComponent.vue').default);

const app = new Vue({
    el: '#app',
    props:{
        prop_user_id:{
            type:String,
            default:window.token_user
        }
    },
    data() {
        return {
            base_url: window.location.origin,
            base_api_url: window.location.origin+'/api/',
            user_id: this.prop_user_id
        }
    },
}).$mount('#app')
