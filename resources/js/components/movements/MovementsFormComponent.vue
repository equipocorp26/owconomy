<template>
    <form @submit.prevent="storeData()">
        <div class="row mb-4">
            <div class="col-12 my-2">
                <div class="form-group">
                    <label>Titulo</label>
                    <input type="text" class="form-control" v-model="movement.title" placeholder="mi movement" required
                        minlength="3" maxlength="180">
                    <small class="text-danger"></small>
                </div>
            </div>
            <div class="col-12 col-md-6 my-2">
                <div class="form-group">
                    <label>Fecha</label>
                    <input type="date" class="form-control" v-model="movement.date" placeholder="fecha del movimiento" required>
                    <small class="text-danger"></small>
                </div>
            </div>
            <div class="col-12 col-md-6 my-2">
                <div class="form-group">
                    <label>Referencia <small>(Opcional)</small></label>
                    <input type="text" class="form-control" v-model="movement.reference" placeholder="0000001"
                        minlength="3" maxlength="180">
                    <small class="text-danger"></small>
                </div>
            </div>
            <div class="col-12 col-md-4 my-2">
                <div class="form-group">
                    <label>Monto</label>
                    <input type="number" class="form-control" v-model="movement.amount" placeholder="10" step=".01" required>
                    <small class="text-danger"></small>
                </div>
            </div>
            <div class="col-12 col-md-4 my-2">
                <div class="form-group">
                    <p class="mb-1">Tipo</p>
                    <input type="radio" v-model="movement.type" placeholder="0000001" required value="+"> Ingreso
                    <input type="radio" v-model="movement.type" placeholder="0000001" required value="-"> Egreso
                    <small class="text-danger"></small>
                </div>
            </div>
            <div class="col-12 col-md-4 my-2 text-center">
                <label>&nbsp;</label>
                <p class="bg-light px-2 py-1 m-0 border rounded" v-if="movement.amount">{{movement.type+movement.amount}}</p>
            </div>
            <div class="col-12 my-2">
                <div class="form-group">
                    <label>Comentario <small>(Opcional)</small></label>
                    <input type="text" class="form-control" v-model="movement.detail" placeholder="un comentario extra"
                        minlength="3" maxlength="180">
                    <small class="text-danger"></small>
                </div>
            </div>
        </div>
        <div class="form-group my-4">
            <button type="reset" class="btn btn-outline-danger float-start" data-bs-dismiss="modal" @click="clearData">
                Cancelar
            </button>
            <button class="btn btn-primary float-end" type="submit">
                Agregar
            </button>
        </div>
    </form>
</template>

<script>
export default {
    mounted() {
        console.log("Component Movement Form")
        this.getCurrencies()
    },
    data: function () {
        return {
            /* Constants */
            base_url: this.$root.base_api_url,
            /* Data */
            movement: {
                id: null,
                amount:null,
                title: '',
                date: null,
                detail: null,
                reference:null,
                type:'+',
                balance_id:null
            }
        }
    },
    methods:
    {
        getCurrencies() {
            axios.get(this.base_url + 'currencies')
                .then((response) => {
                    this.currencies = response.data.data
                })
                .catch((error) => {
                    console.log(error)
                })
        },
        storeData() {
            if (this.movement.id) {
                axios.put(this.base_url + 'movements/' + this.movement.id, {
                    user_id: this.$root.user_id,
                    movement: this.movement
                })
                    .then((response) => {
                        this.$emit('saveData', true)
                        this.clearData()
                    })
                    .catch((error) => {
                        console.log(error)
                    })
            } else {
                axios.post(this.base_url + 'movements', {
                    user_id: this.$root.user_id,
                    movement: this.movement
                })
                    .then((response) => {
                        this.$emit('saveData', true)
                        this.clearData()
                    })
                    .catch((error) => {
                        console.log(error)
                    })
            }
        },
        clearData() {
            this.movement = {
                id: null,
                amount:null,
                title: '',
                date: null,
                detail: null,
                reference:null,
                type:'+',
                balance_id:null
            }
        }
    }
}
</script>
