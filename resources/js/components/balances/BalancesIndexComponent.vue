<template>
    <div class="container my-5">
        <div class="row">
            <template v-if="balances">
                <div class="col-12">
                    <div>
                        <h2>Actualmente tienes {{ meta.total }} balance<span v-if="meta.total != 1">s</span></h2>
                        <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal"
                            :data-bs-target="'#' + modalCreateBalanceId">
                            Crear Balance
                        </button>
                        <pagination-component :prop_prev="links.prev" :prop_next="links.next"
                            :prop_current_page="meta.current_page" :prop_last="meta.last_page" @prevPage="getData"
                            @nextPage="getData"></pagination-component>
                    </div>
                </div>
                <div class="col-12 col-lg-6" v-for="(balance, index) in balances" :key="index">
                    <balance-card-component :prop_card_id="balance.id" :prop_card_title="balance.title"
                        :prop_card_amount="balance.amount" :prop_card_bg="balance.background"
                        :prop_card_last_movement="balance.last_movement" :prop_card_symbol="balance.currency"></balance-card-component>
                </div>
                <pagination-component :prop_prev="links.prev" :prop_next="links.next"
                    :prop_current_page="meta.current_page" :prop_last="meta.last_page" @prevPage="getData"
                    @nextPage="getData"></pagination-component>
            </template>
            <div class="card my-4 mx-auto p-4 rounded-medium text-center" v-else>
                <img width="100px" class="mx-auto" :src="$root.base_url+'/images/empty.png'" alt="Empty image owconomy">
                <p class="fs-4 mt-3">Ups... Parece que no tienes ningun balance</p>
                <p class="text-muted">Da click en el boton para crear uno, y llevar el control de tus gastos.</p>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                    :data-bs-target="'#' + modalCreateBalanceId">
                    Crear Balance
                </button>
            </div>
            <modal-component :prop_id="modalCreateBalanceId" prop_title="Crear Balance">
                <div class="modal-body">
                    <balances-form-component @saveData="refreshData"></balances-form-component>
                </div>
            </modal-component>
        </div>
    </div>
</template>

<script>
export default {
    mounted() {
        this.getData()
        console.log("Component Balance Index")
    },
    data: function () {
        return {
            /* Constants */
            base_url: this.$root.base_api_url,
            modalCreateBalanceId: 'modalCreateBalance',
            /* Data */
            balances: [],
            /* Pagination */
            links: {},
            meta: {}
        }
    },
    methods:
    {
        getData(page = null) {
            axios.get(this.base_url + 'balances', {
                params: {
                    user_id: this.$root.user_id,
                    page: page
                }
            })
                .then((response) => {
                    this.balances = response.data.data
                    this.links = response.data.links
                    this.meta = response.data.meta
                })
                .catch((error) => {
                    console.log(error)
                })
        },
        refreshData() {
            this.getData()
            let modal = bootstrap.Modal.getInstance("#" + this.modalCreateBalanceId)
            modal.toggle()
        }
    }
}
</script>
