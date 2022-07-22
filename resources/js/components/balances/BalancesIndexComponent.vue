<template>
    <div class="container">
        <div class="row">
            <template v-if="balances.length > 10">
                <div class="col-12">
                    <div>
                        <h2>Actualmente tienes {{ meta.total }} balance<span v-if="meta.total != 1">s</span></h2>
                        <button class="btn btn-primary" v-if="links.prev" @click="getData(meta.current_page - 1)">
                            prev
                        </button>
                        <span>Pagina {{ meta.current_page }} de {{ meta.last_page }}</span>
                        <button class="btn btn-primary" v-if="links.next" @click="getData(meta.to)">
                            next
                        </button>
                    </div>
                </div>
                <div class="col-12 col-md-6" v-for="(balance, index) in balances" :key="index">
                    <balance-card-component :prop_card_title="balance.title" :prop_card_amount="balance.amount"
                        :prop_card_last_movement="balance.last_movement"></balance-card-component>
                </div>
                <div>
                    <button class="btn btn-primary" v-if="links.prev" @click="getData(meta.current_page - 1)">
                        prev
                    </button>
                    <span>Pagina {{ meta.current_page }} de {{ meta.last_page }}</span>
                    <button class="btn btn-primary" v-if="links.next" @click="getData(meta.to)">
                        next
                    </button>
                </div>
            </template>
            <div class="card my-4 mx-auto p-4 rounded-medium text-center" v-else>
                <img width="100px" class="mx-auto" src="images/empty.png" alt="Empty image owconomy">
                <p class="fs-4 mt-3">Ups... Parece que no tienes ningun balance</p>
                <p class="text-muted">Da click en el boton para crear uno, y llevar el control de tus gastos.</p>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createBalance">
                    Crear Balance
                </button>
                <modal-component prop_id="createBalance"></modal-component>
            </div>
            <!-- Test -->
            <form>
                <form-basic-input-component prop_label="Nombre del balance" prop_placeholder="mi balance"
                    prop_name="title" :prop_required="true" @basic-input-valid="setInput"></form-basic-input-component>
                <form-basic-input-component prop_type="number" prop_label="Monto inicial" prop_name="amount"
                    prop_placeholder="100" :prop_max="100"></form-basic-input-component>
                <div class="form-group my-4">
                    <button type="reset" class="btn btn-outline-danger">
                        Limpiar
                    </button>
                    <button class="btn btn-primary float-end">
                        Agregar
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
export default {
    mounted() {
        console.log("Component Balance Index")
        console.log(this.$data)
        this.getData()
    },
    props: ['prop_user'],
    data: function () {
        return {
            base_url: window.location.origin + '/api/',
            balances: [],
            links: {},
            meta: {},
            /* Balance */
            balance: {}
        }
    },
    methods:
    {
        getData(page = null) {
            axios.get(this.base_url + 'balances', {
                params: {
                    user_id: this.prop_user,
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
        setInput(e) {
            this.balance[e.name] = e.value
        }
    }
}
</script>
