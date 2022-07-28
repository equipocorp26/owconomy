<template>
    <table class="table">
        <tr>
            <td>Motivo</td>
            <td>{{movement.title}}</td>
        </tr>
        <tr>
            <td>Fecha</td>
            <td>{{movement.date}}</td>
        </tr>
        <tr>
            <td>Ref</td>
            <td>{{movement.reference}}</td>
        </tr>
        <tr>
            <td>Monto</td>
            <td>{{movement.amount}}</td>
        </tr>
        <tr>
            <td>Detail</td>
            <td>{{movement.detail}}</td>
        </tr>
    </table>
</template>

<script>
export default {
    mounted() {
        console.log("Component Movement Detail")
        this.getCurrencies()
    },
    data: function () {
        return {
            movement: {
                amount:null,
                title: '',
                date: null,
                detail: null,
                reference:null,
            }
        }
    }
}
</script>
