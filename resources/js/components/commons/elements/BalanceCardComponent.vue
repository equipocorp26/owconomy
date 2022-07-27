<template>
    <div class="card my-4 text-white bg-responsive p-4 rounded-medium"
        :style="'background-image: url('+prop_card_bg+')'"
    >
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <p class="fs-5">
                            {{ prop_card_title }}
                        </p>
                    </div>
                    <div class="col-6 text-end box-amount-last-movement">
                        <p class="fs-3 fw-bold">
                            {{ prop_card_amount +' '+ prop_card_symbol}}
                        </p>
                        <span class="d-block" v-if="prop_card_last_movement">
                            Ult Mov: <span class="badge fs-6" :class="prop_card_last_movement > 0 ? 'bg-success' : 'bg-danger'" >
                                {{ prop_card_last_movement }}
                            </span>
                        </span>
                    </div>
                    <div class="col-6 mt-5">
                        <a class="btn border btn-sm py-1 border-light btn-link"  title="Movimientos">
                            <img src="icons/transactions.png" alt="transactions icons owconomy">
                        </a>
                        <a class="btn border btn-sm py-1 border-light btn-link"  title="Reservaciones">
                            <img src="icons/reservations.png" alt="transactions icons owconomy">
                        </a>
                        <a class="btn border btn-sm py-1 border-light btn-link"
                            title="Resumen del balance">
                            <img src="icons/balance.png" alt="transactions icons owconomy">
                        </a>
                    </div>
                    <div class="col-6 mt-5 text-end">
                        <a class="btn border btn-sm py-1 border-light btn-link" title="Ver balance" :href="$root.base_url+'/balances/'+prop_card_id">
                            <img :src="$root.base_url+'/icons/visibility.png'" alt="transactions icons owconomy">
                        </a>
                    </div>
                </div>
            </div>
        </div>
</template>

<script>
    export default {
        mounted() {
            console.log("Component Balance Card")
        },
        props:{
            prop_card_id:{type:String},
            prop_card_bg:{type:String},
            prop_card_title:{type:String},
            prop_card_symbol:{type:String},
            prop_card_amount:{type:Number},
            prop_card_last_movement: {
                default: null
            },
        },
        data: function () {
            return {}
        },
        methods:{}
    }
</script>
