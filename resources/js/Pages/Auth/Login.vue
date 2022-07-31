<template>
    <v-app>
        <v-content>
            <v-container fluid fill-height>
                <v-layout align-center justify-center>
                    <v-flex xs12 sm8 md4>
                        <v-card class="elevation-12">
                            <v-toolbar dark color="primary">
                                <v-toolbar-title>Identificarse</v-toolbar-title>
                            </v-toolbar>

                                <form @submit.prevent="submit">
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

                                        <v-alert v-if="errors.email" 
                                        dense 
                                        dismissible 
                                        elevation="7" 
                                        outlined 
                                        text type="error">
                                        {{ errors.password }}
                                        </v-alert>

                                        <v-text-field
                                            label="Clave"
                                            type="password"
                                            v-model="form.password" required autocomplete="current-password">
                                        </v-text-field>

                                        <v-alert v-if="errors.password" 
                                        dense 
                                        dismissible 
                                        elevation="7" 
                                        outlined 
                                        text type="error">
                                        {{ errors.password }}
                                        </v-alert>

                                        <v-checkbox
                                        name="remember"
                                        v-model="form.remember"
                                        label="Recordame"
                                        ></v-checkbox>

                                    </v-card-text>
                                    
                                    <v-card-actions>
                                        <v-spacer></v-spacer>

                                        <v-btn color="primary" type="submit" :disabled="form.processing">
                                            Ingresar
                                        </v-btn>
                                    </v-card-actions>
                                </form>


                            

                                <!-- <div>
                                    <jet-input id="email" type="email" class="mt-1 block w-full" 
                                    v-model="form.email" required autofocus />
                                </div> -->

                                <!-- <div class="mt-4">
                                    <jet-label for="password" value="Password" />
                                    <jet-input id="password" type="password" class="mt-1 block w-full" 
                                    v-model="form.password" required autocomplete="current-password" />
                                </div> -->

                                <!-- <div class="block mt-4">
                                    <label class="flex items-center">
                                        <jet-checkbox name="remember" v-model="form.remember" />
                                        <span class="ml-2 text-sm text-gray-600">Remember me</span>
                                    </label>
                                </div> -->

                                <!-- <div class="flex items-center justify-end mt-4">
                                    <inertia-link v-if="canResetPassword" :href="route('password.request')" class="underline text-sm text-gray-600 hover:text-gray-900">
                                        Forgot your password?
                                    </inertia-link>

                                    <jet-button class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                        Ingresar
                                    </jet-button>
                                </div> -->


                        </v-card>
                    </v-flex>
                </v-layout>
            </v-container>
        </v-content>
    </v-app>
</template>

<script>

    export default {
        components: {
        },

        props: {
            canResetPassword: Boolean,
            status: String
        },

        data() {
            return {
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
