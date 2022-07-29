<template>
    <div class="container my-5">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header p-5 text-white text-center bg-responsive-cover"
                        :style="'background-image: url(' + prop_balance_background + ')'">
                        <p class="h1 py-5">
                            Mis Movimientos
                        </p>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 mt-4">
                                <form action="" class="row" @submit.prevent="getData()">
                                    <div class="col-12 col-lg-1 pt-3">
                                        <input v-model="filter.month" type="checkbox" placeholder="Este mes">
                                        <label for="floatingInput">Este mes</label>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-2">
                                        <div class="form-floating mb-3">
                                            <input :disabled="filter.month" v-model="filter.date_start" type="date" class="form-control" id="floatingInput"
                                                placeholder="Fecha inicio">
                                            <label for="floatingInput">Fecha Inicio</label>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-2">
                                        <div class="form-floating mb-3">
                                            <input :disabled="filter.month" v-model="filter.date_end" type="date" class="form-control" id="floatingInput"
                                                placeholder="Fecha fin">
                                            <label for="floatingInput">Fecha Fin</label>
                                        </div>

                                    </div>
                                    <div class="col-12 col-md-6 col-lg-3">
                                        <div class="form-floating mb-3">
                                            <input v-model="filter.reference" name="date_start" type="text" min="3"
                                                max="250" class="form-control" id="floatingInput"
                                                placeholder="Referencia">
                                            <label for="floatingInput">Referencia</label>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-2">
                                        <div class="form-floating mb-3">
                                            <select v-model="filter.type" name="" class="form-control"
                                                id="floatingInput">
                                                <option :value="null">Todos</option>
                                                <option value="+">Solo ingresos</option>
                                                <option value="-">Solo egresos</option>
                                            </select>
                                            <label for="floatingInput">Tipo</label>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 text-center col-lg-1">
                                        <button type="button" class="btn mt-2 btn-warning" @click="clearFilter()">
                                            <img :src="$root.base_url + '/icons/clear-filter.png'"
                                                alt="clear-filter icons owconomy">
                                        </button>
                                    </div>
                                    <div class="col-12 col-md-6 text-center col-lg-1">
                                        <button class="btn mt-2 btn-primary" type="submit">
                                            <img :src="$root.base_url + '/icons/filter.png'"
                                                alt="filter icons owconomy">
                                        </button>
                                    </div>
                                </form>
                            </div>
                            <div class="col-12 d-grid gap-2 my-4">
                                <button type="button" class="btn btn-primary float-end"
                                    @click="setComponenetModal('createFormMovement')">
                                    <img :src="$root.base_url + '/icons/plus.png'" alt="plus icons owconomy"
                                        class="me-2">
                                    Registrar movimiento
                                </button>
                            </div>
                            <template v-if="movements.length">
                                <pagination-component :prop_prev="links.prev" :prop_next="links.next"
                                    :prop_current_page="meta.current_page" :prop_last="meta.last_page"
                                    @prevPage="getData" @nextPage="getData"></pagination-component>
                                <div class="col-12">
                                    <activity-item-component v-for="(item, index) in movements" :key="index"
                                        :prop_amount="item.amount" :prop_date="item.date" :prop_title="item.title"
                                        @clickButtonShow="setComponenetModal('detailsMovement', item)">
                                    </activity-item-component>
                                </div>
                                <pagination-component :prop_prev="links.prev" :prop_next="links.next"
                                    :prop_current_page="meta.current_page" :prop_last="meta.last_page"
                                    @prevPage="getData" @nextPage="getData"></pagination-component>
                            </template>
                            <div v-else>
                                <p class="h5 text-muted mt-5 text-center">No tienes registros todavia.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <modal-component :prop_id="modalActionId" prop_title="Crear Movimiento" :ref="modalRefId">
            <div class="modal-body">
                <movements-form-component @saveData="refreshData" ref="createFormMovement"
                    v-show="modalActionId == 'createFormMovement'"></movements-form-component>
                <movements-details-component ref="detailsMovement" v-show="modalActionId == 'detailsMovement'">
                </movements-details-component>
            </div>
        </modal-component>
    </div>
</template>

<script>
export default {
    mounted() {
        this.getData()
        /* Create modal instance */
        console.log("Component Movement Index")
    },
    props: ['prop_balance_id', 'prop_balance_background'],
    data: function () {
        return {
            /* Constants */
            base_url: this.$root.base_api_url,
            /* Modal Data */
            modal: {
                title: null
            },
            modalRefId: 'modalActionsMovements',
            modalActionId: 'createFormMovement',
            /* Data */
            movements: [],
            filter: {
                month: true,
                date_start: null,
                date_end: null,
                reference: null,
                type: null,
            },
            /* Pagination */
            links: {},
            meta: {}
        }
    },
    methods:
    {
        getData(page = null) {
            axios.get(this.base_url + 'balances/' + this.prop_balance_id + '/movements', {
                params: {
                    user_id: this.$root.user_id,
                    page: page,
                    month: this.filter.month,
                    date_start: this.filter.date_start,
                    date_end: this.filter.date_end,
                    reference: this.filter.reference,
                    type: this.filter.type,
                }
            })
                .then((response) => {
                    this.movements = response.data.data
                    this.links = response.data.links
                    this.meta = response.data.meta
                })
                .catch((error) => {
                    console.log(error)
                })
        },
        setComponenetModal(component, data = null) {
            this.modalActionId = component
            switch (component) {
                case "editFormBalance":
                    /* Set balance data */
                    this.$refs.editFormBalance.balance = {
                        id: this.balance.id,
                        title: this.balance.title,
                        background: this.balance.background,
                        currency_id: this.balance.currency
                    }
                    /* Modal */
                    this.modal.title = 'Editar Balance'
                    break;
                case "createFormMovement":
                    /* Set movement data */
                    this.$refs.createFormMovement.movement.balance_id = this.prop_balance_id
                    /* Modal */
                    this.modal.title = 'Registrar movimiento'
                    break;
                case "detailsMovement":
                    /* Set movement data */
                    this.$refs.detailsMovement.movement = data
                    /* Modal */
                    this.modal.title = 'Detalles del Movimiento'
                    break;

                default:
                    break;
            }
            /* Toggle modal */
            this.$refs[this.modalRefId].toggleModal()
        },
        refreshData() {
            this.getData()
            this.$refs[this.modalRefId].toggleModal()
        },
        clearFilter()
        {
            this.filter= {
                month: true,
                date_start: null,
                date_end: null,
                reference: null,
                type: null,
            }
            this.getData()
        }
    }
}
</script>
