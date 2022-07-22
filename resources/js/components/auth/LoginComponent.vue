<template>
    <form class="form-row" @submit.prevent="sendMainForm">
        <div class="col-12 my-4">
            <div class="form-group">
                <label class="text-white h4" for="email">Correo electrónico</label>
                <input type="email" class="form-control" placeholder="Correo electrónico" v-model="login.email">
                <small class="text-white px-2" v-if="errors.email" v-text="errors.email"></small>
            </div>
        </div>
        <div class="col-12 my-4">
            <div class="form-group">
                <label class="text-white h4" for="password">Contraseña</label>
                <input type="password" class="form-control" placeholder="Contraseña" v-model="login.password">
                <small class="text-white px-2" v-if="errors.password" v-text="errors.password"></small>
            </div>
        </div>
        <div class="col-12 my-4">
            <input type="checkbox" class="mr-2" v-model="login.remember"> <span class="text-white">Recuerdame</span>
            <small class="text-white px-2" v-if="errors.remember" v-text="errors.remember"></small>
        </div>
        <div class="col-12 my-4 text-center">
            <button class="btn btn-primary btn-block py-2">Ingresar</button>
        </div>
    </form>
</template>

<script>
    export default {
        mounted() {
            console.log("Component Login")
        },
        data: function () {
            return {
                base_url: window.location.origin,
                login: {
                    email: '',
                    password: '',
                    remember: false
                },
                errors: {
                    email: '',
                    password: '',
                    remember: ''
                },
            }
        },
        methods:
        {
            sendMainForm() {
                axios.post(this.base_url + '/login', this.login)
                    .then((response) => {
                        window.location.reload()
                    })
                    .catch((error) => {
                        if (error.response.data) {
                            if (error.response.data.errors) {
                                this.errors.email = error.response.data.errors['email'] ? error.response.data.errors['email'][0] : ''
                                this.errors.password = error.response.data.errors['password'] ? error.response.data.errors['password'][0] : ''
                                this.errors.remember = error.response.data.errors['remember'] ? error.response.data.errors['remember'][0] : ''
                            }
                        }
                    })
            }
        }
    }
</script>
