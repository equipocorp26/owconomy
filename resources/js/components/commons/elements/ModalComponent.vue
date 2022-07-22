<template>
    <div class="modal fade" :id="prop_id" tabindex="-1" :aria-labelledby="prop_id+'Label'" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" :id="prop_id+'Label'">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        prop_id: {
            type: String,
        }
    },
    mounted() {
        console.log("Modal Basic Input")
        console.log(this.$props)
    },
    data: function () {
        return {
            value: '',
            error: null
        }
    },
    methods:
    {
    }
}
</script>
