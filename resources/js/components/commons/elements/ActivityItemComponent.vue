<template>
    <div class="card my-3 rounded-0 border-start border-0 border-5 border-primary bg-light">
        <div class="card-body">
            <span class="badge fs-6 me-3" :class="prop_amount > 0 ? 'bg-success' : 'bg-danger'">
                {{ prop_amount }}
            </span>
            <span>
                {{ prop_date }} - {{ prop_title }}
            </span>
            <a href="#" class="btn btn-sm btn-primary float-end" @click="$emit('clickButtonShow',true)">
                <img :src="$root.base_url + '/icons/visibility.png'" alt="icon show owconomy">
            </a>
        </div>
    </div>
</template>

<script>
export default {
    mounted() {
        console.log("Component Activity item")
    },
    props: {
        prop_title: {
            default: null
        },
        prop_date: {
            default: null
        },
        prop_amount: {
            default: null
        },
        prop_currency:{
            default:null
        }
    },
    data: function () {
        return {}
    },
    methods: {}
}
</script>
