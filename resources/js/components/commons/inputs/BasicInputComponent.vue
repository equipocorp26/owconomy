<template>
    <div class="form-group my-4">
        <label v-if="prop_label" v-text="prop_required ? prop_label : prop_label + ' (opcional)'"></label>
        <!-- Si es text -->
        <input type="text" class="form-control" v-if="prop_type == 'text'" v-model="value"
            :placeholder="prop_placeholder" :required="prop_required" :minlength="prop_min_length"
            :maxlength="prop_max_length" @blur="local_validate">
        <input type="number" class="form-control" v-else-if="prop_type == 'number'" v-model="value"
            :placeholder="prop_placeholder" :required="prop_required" :min="prop_min" :max="prop_max" :step="prop_step"
            @blur="local_validate">
        <!-- Mensaje de error -->
        <small class="text-danger" v-text="error" v-if="error"></small>
    </div>
</template>

<script>
    export default {
        props: {
            prop_name: {
                type: String,
            },
            prop_type: {
                type: String,
                default: 'text'
            },
            prop_label: {
                type: String,
                default: null
            },
            prop_placeholder: {
                type: String,
                default: null
            },
            prop_required: {
                type: Boolean,
                default: false
            },
            prop_min_length: {
                type: Number,
                default: 3
            },
            prop_max_length: {
                type: Number,
                default: 150
            },
            prop_min: {
                type: Number,
                default: null
            },
            prop_max: {
                type: Number,
                default: null
            },
            prop_step: {
                type: Number,
                default: 0.01
            }
        },
        mounted() {
            console.log("Component Basic Input")
        },
        data: function () {
            return {
                value: '',
                error: null
            }
        },
        methods:
        {
            local_validate() {
                let validate    = true
                this.error      = null
                /* Valida si es requerido */
                validate = this.prop_required ? (this.value != null && this.value != "") : true
                if (validate) {
                    switch (this.prop_type) {
                        case "text":
                            /* Valida si es menor a minl */
                            validate = this.prop_min_length != null ? (this.value.length >= this.prop_min_length) : true
                            if (validate) {
                                /* Valida si es mayor al maxl */
                                validate = this.prop_max_length != null ? (this.value.length <= this.prop_max_length) : true
                                /* Si es mayor a max */
                                if (!validate) {
                                    this.error = 'Debe tener maximo ' + this.prop_max_length + ' caracteres'
                                }
                            }
                            /* Si es menor a min */
                            else {
                                this.error = 'Debe tener al menos ' + this.prop_min_length + ' caracteres'
                            }
                            break;
                        case "number":
                            /* Valida si es menor a min */
                            validate = this.prop_min != null ? (this.value >= this.prop_min) : true
                            if (validate) {
                                /* Valida si es mayor al max */
                                validate = this.prop_max != null ? (this.value <= this.prop_max) : true
                                /* Si es mayor a max */
                                if (!validate) {
                                    this.error = 'Debe ser nemor o igual a ' + this.prop_max
                                }
                            }
                            /* Si es menor a min */
                            else {
                                this.error = 'Debe ser mayor o igual a ' + this.prop_min
                            }
                            break;
                        default:
                            break;
                    }
                } else {
                    this.error = 'Este campo es requerido'
                }
                /* Final */
                if (validate) {
                    this.$emit('basic-input-valid',{
                        name:this.prop_name,
                        value:this.value
                    })
                }
                return validate;
            }
        }
    }
</script>
