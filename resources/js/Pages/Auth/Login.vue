<template>
    <v-app>
        <v-main>
            <v-container fluid fill-height>
                <v-layout align-center justify-center row fill-height style="height: 100vh">
                    <v-flex xs10 sm4 md2 xl2>
                        <v-card elevation="24">
                            <v-img
                                style="height: 250px;"
                                src="https://picsum.photos/510/300?random"
                                aspect-ratio="1"
                            ></v-img>
                        </v-card>
                    </v-flex>
                    <v-flex xs10 sm4 md3 xl3 ma-1>
                        <v-card style="height: 250px" elevation="24" color="#ECEFF1" >
                            <form @submit.prevent="submit">
                                <v-container>
                                    <v-card-text>
                                        <div v-if="status">
                                            {{ status }}
                                        </div>

                                        <v-text-field
                                            label="Correo"
                                            type="email"
                                            v-model="form.email" 
                                            required 
                                            autofocus>
                                        </v-text-field>
                                            
                                        <v-alert v-if="errors.email">
                                            {{ errors.email }}
                                        </v-alert>

                                        <v-text-field
                                            counter
                                            @click:append="show1 = !show1"
                                            :append-icon="show1 ? 'mdi-eye' : 'mdi-eye-off'"
                                            :type="show1 ? 'text' : 'password'"
                                            label="Contraseña"
                                            v-model="form.password" 
                                            required 
                                            autocomplete="current-password">
                                        </v-text-field>

                                        <small v-if="errors.password" >
                                            {{ errors.password }}
                                        </small>

                                        <!-- <v-checkbox
                                        name="remember"
                                        v-model="form.remember"
                                        label="Recordame"
                                        ></v-checkbox> -->

                                    </v-card-text>
                                    
                                    <div class="text-center">
                                        <v-hover>
                                            <v-btn 
                                            color="primary" 
                                            type="submit" 
                                            :loading="form.processing" 
                                            :disabled="form.processing"
                                            >
                                                Ingresar
                                            </v-btn>
                                        </v-hover>
                                    </div>
                                </v-container>
                            </form>
                        </v-card>
                    </v-flex>
                </v-layout>
            </v-container>
        </v-main>
    </v-app>
</template>

<script>

    export default {
        components: {
        },

        props: {
            canResetPassword: Boolean,
            status: String,
            errors: Object,
        },

        data() {
            return {
                show1: false,

                form: this.$inertia.form({
                    email: '',
                    password: '',
                    remember: false
                })
            }
        },

        methods: {
            submit() {
                this.form
                    .transform(data => ({
                        ... data,
                        remember: this.form.remember ? 'on' : ''
                    }))
                    .post(this.route('login'), {
                        onFinish: () => this.form.reset('password'),
                    })
            }
        }
    }
</script>
