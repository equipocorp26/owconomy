<template>
    <form @submit.prevent="storeData()">
        <!-- Currency -->
        <div class="row mb-4">
            <div class="col-8 col-md-9">
                <!-- Title -->
                <div class="form-group">
                    <label>Nombre</label>
                    <input type="text" class="form-control" v-model="balance.title" placeholder="mi balance" required
                        minlength="3" maxlength="180">
                    <small class="text-danger"></small>
                </div>
            </div>
            <div class="col-4 col-md-3">
                <div class="form-group">
                    <label>Modena</label>
                    <select class="form-control text-center" v-model="balance.currency_id">
                        <option v-for="(item, index) in currencies" :key="'currency-option-'+index" :value="item.symbol">{{ item.symbol + ' - ' + item.name }}
                        </option>
                    </select>
                    <small class="text-danger"></small>
                </div>
            </div>
        </div>
        <!-- Backgrounds -->
        <div class="row justify-content-center">
            <label>Selecciona el fondo de tu balance</label>
            <div v-for="(item, index) in bg_cards" :key="'background-img-'+index" class="col-6">
                <div :style="'background-image: url(' + $root.base_url + '/images/bg-cards/' + item + '.jpg)'"
                    class="my-2 preview-background-card bg-responsive-cover">
                    <input class="m-2" type="radio" v-model="balance.background" :value="item">
                </div>
            </div>
        </div>
        <div class="form-group my-4">
            <button type="reset" class="btn btn-outline-danger float-start" data-bs-dismiss="modal"  @click="clearData">
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
        console.log("Component Balance Form")
        this.getCurrencies()
    },
    data: function () {
        return {
            /* Constants */
            base_url: this.$root.base_api_url,
            /* Data */
            currencies: [],
            bg_cards: [0, 1, 2, 3, 4, 5],
            balance: {
                id: null,
                title: '',
                background: 0,
                currency_id: null
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
            if (this.balance.id) {
                axios.put(this.base_url + 'balances/' + this.balance.id, {
                    user_id: this.$root.user_id,
                    balance: this.balance
                })
                    .then((response) => {
                        this.$emit('saveData', true)
                        this.clearData()
                    })
                    .catch((error) => {
                        console.log(error)
                    })
            } else {
                axios.post(this.base_url + 'balances', {
                    user_id: this.$root.user_id,
                    balance: this.balance
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
            this.balance = {
                id: null,
                title: '',
                background: 0,
                currency_id: null
            }
        }
    }
}
</script>
