<template>
    <div>
        <button class="btn btn-primary" v-if="prop_prev" @click="$emit('prevPage',(prop_current_page - 1))">
            prev
        </button>
        <span>Pagina {{ prop_current_page }} de {{ prop_last }}</span>
        <button class="btn btn-primary" v-if="prop_next" @click="$emit('nextPage',(prop_current_page + 1))">
            next
        </button>
    </div>
</template>

<script>
export default {
    props: {
        prop_prev: {
            type: String,
            default:null
        },
        prop_next: {
            type: String,
            default:null
        },
        prop_current_page: {
            type: Number,
        },
        prop_last: {
            type: Number,
        },
    },
    mounted() {
        console.log("Pagination Component")
    },
    data: function () {
        return {}
    }
}
</script>
