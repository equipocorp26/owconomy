<template>
    <div class="modal fade" :id="prop_id" tabindex="-1" :aria-labelledby="prop_id+'Label'" >
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" :id="prop_id+'Label'">{{prop_title}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <slot></slot>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        prop_id: {
            type: String,
        },
        prop_title: {
            type: String,
        }
    },
    mounted() {
        console.log("Modal Basic Input")
        new bootstrap.Modal(document.getElementById(this.prop_id),{backdrop:true})
    },
    data: function () {
        return {
            value: '',
            error: null
        }
    },
    methods:
    {
        toggleModal()
        {
            let modal = bootstrap.Modal.getInstance("#"+this.prop_id)
            modal.toggle()
        }
    }
}
</script>
