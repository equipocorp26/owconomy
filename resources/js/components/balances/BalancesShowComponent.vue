<template>
    <div class="container my-5">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header p-5 text-white text-center bg-responsive-cover"
                        :style="'background-image: url('+balance.background+')'">
                        <h2 class="h1 py-5">{{ balance.title }}</h2>
                        <button class="btn border btn-sm py-1 border-light btn-link btn-edit-header" @click="setComponenetModal('editFormBalance')">
                            <img :src="$root.base_url + '/icons/edit.png'" alt="edit icon">
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="row my-5">
                            <div class="col-12 col-md-6 my-3">
                                <table class="table">
                                    <tr>
                                        <td colspan="2">Balance Total</td>
                                        <td class="text-center">{{ balance.amount + ' ' + balance.currency }}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">Balance del mes</td>
                                        <td class="text-center">{{ month_data.balance + ' ' + balance.currency }}</td>
                                    </tr>
                                    <tr>
                                        <td>Ult Movimiento</td>
                                        <td class="text-center">{{ balance.last_movement_date ?
                                                balance.last_movement_date : '-'
                                        }}</td>
                                        <td class="text-center">{{ balance.last_movement ? balance.last_movement + ' ' + balance.currency : '-' }}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="text-center col-12 col-md-6">
                                aqui va una grafica
                            </div>
                            <div class="col-12 my-3">
                                <hr>
                            </div>
                            <div class="col-12 my-3">
                                <h3 class="h2  text-center">Movimientos del mes <button class="btn border btn-sm py-1 btn-primary" @click="setComponenetModal('createFormMovement')"><img :src="$root.base_url + '/icons/plus.png'" alt="edit icon"></button></h3>
                                <div v-if="month_data.movements.length">
                                    <activity-item-component v-for="(item, index) in month_data.movements" :key="index"
                                        :prop_amount="item.amount" :prop_date="item.date" :prop_title="item.title" @clickButtonShow="setComponenetModal('detailsMovement',item)">
                                    </activity-item-component>
                                    <a  :href="$root.base_url+'/balances/'+balance.id+'/movements'" class="btn btn-primary float-end">Ver todos</a>
                                </div>
                                <div v-else>
                                    <p class="h5 text-muted mt-5 text-center">No tienes registros todavia.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <modal-component :prop_id="modalRefId" :prop_title="modal.title" :ref="modalRefId">
            <div class="modal-body">
                <balances-form-component @saveData="refreshData" ref="editFormBalance" v-show="modalActionId == 'editFormBalance'"></balances-form-component>
                <movements-form-component @saveData="refreshData" ref="createFormMovement" v-show="modalActionId == 'createFormMovement'"></movements-form-component>
                <movements-details-component ref="detailsMovement" v-show="modalActionId == 'detailsMovement'"></movements-details-component>
            </div>
        </modal-component>
    </div>
</template>

<script>
export default {
    mounted() {
        console.log("Component Balance Show")
        /* Get data view */
        this.getData()
    },
    props: ['prop_balance_id'],
    data: function () {
        return {
            /* Constants */
            base_url: this.$root.base_api_url,
            /* Modal Data */
            modal:{
                title:null
            },
            modalRefId: 'modalActionsBalance',
            modalActionId:'editFormBalance',
            /* Data */
            balance: {},
            month_data: {
                movements: []
            }
        }
    },
    methods:
    {
        getData() {
            axios.get(this.base_url + 'balances/' + this.prop_balance_id)
                .then((response) => {
                    this.balance = response.data.data.balance
                    this.month_data = response.data.data.month_data
                })
                .catch((error) => {
                    console.log(error)
                })
        },
        setComponenetModal(component,data = null)
        {
            this.modalActionId = component
            switch (component) {
                case "editFormBalance":
                        /* Set balance data */
                        this.$refs.editFormBalance.balance = {
                            id          : this.balance.id,
                            title       : this.balance.title,
                            background  : this.balance.background,
                            currency_id : this.balance.currency
                        }
                        /* Modal */
                        this.modal.title = 'Editar Balance'
                    break;
                case "createFormMovement":
                        /* Set movement data */
                        this.$refs.createFormMovement.movement.balance_id = this.balance.id
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
    }
}
</script>
