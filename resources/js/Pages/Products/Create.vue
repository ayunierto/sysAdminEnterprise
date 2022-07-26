<template>
    <admin-layout>
        <v-container>

            <form @submit.prevent="submit()">
                <v-card>
                    <v-card-title>
                        <span class="text-h5">Agregar producto</span>
                    </v-card-title>

                    <v-card-text>
                        <v-container>
                            <v-row>
                                <v-col cols="12" sm="6" md="4" >
                                    <v-text-field
                                    v-model="form.name"
                                    label="Nombre"
                                    required
                                    ></v-text-field>
                                    <div v-if="form.errors.name">{{ form.errors.name }}</div>

                                </v-col>

                                <v-col cols="12" sm="6" md="4" >
                                    <v-text-field
                                    v-model="form.code"
                                    label="Código"
                                    required
                                    ></v-text-field>
                                    <div v-if="form.errors.code">{{ form.errors.code }}</div>
                                </v-col>

                                <v-col cols="12" sm="6" md="4" >
                                    <v-text-field
                                    v-model="form.bar_code"
                                    label="Código de barra"
                                    required
                                    ></v-text-field>
                                    <div v-if="form.errors.bar_code">{{ form.errors.bar_code }}</div>
                                </v-col>

                                <v-col cols="12" m="6" md="4" >
                                    <v-text-field
                                    v-model="form.stock"
                                    label="Stock"
                                    required
                                    ></v-text-field>
                                    <div v-if="form.errors.stock">{{ form.errors.stock }}</div>
                                </v-col>

                                <v-col cols="12" m="6" md="4" >
                                    <v-text-field
                                    v-model="form.purchase_price"
                                    label="Precio de venta"
                                    required
                                    ></v-text-field>
                                    <div v-if="form.errors.purchase_price">{{ form.errors.purchase_price }}</div>
                                </v-col>

                                <v-col cols="12" m="6" md="4" >
                                    <v-text-field
                                    v-model="form.sale_price"
                                    label="Precio de compra"
                                    required
                                    ></v-text-field>
                                    <div v-if="form.errors.sale_price">{{ form.errors.sale_price }}</div>
                                </v-col>

                                <!-- <v-col cols="12" m="6" md="4" >
                                    <v-text-field
                                    v-model="form.state"
                                    label="Estado"
                                    ></v-text-field>
                                </v-col> -->

                                <v-col cols="12" sm="6" md="4" >
                                    <v-text-field
                                    v-model="form.expiration_date"
                                    label="Fecha de vencimiento"
                                    required
                                    ></v-text-field>
                                    <!-- <v-date-picker v-model="form.expiration_date"></v-date-picker> -->
                                    <div v-if="form.errors.expiration_date">{{ form.errors.expiration_date }}</div>
                                </v-col>

                                <v-col cols="12" m="6" md="4" >
                                    <v-select
                                    v-model="form.category"
                                    :items="categories"
                                    hint="Seleccione Categoría"
                                    item-text="name"
                                    item-value="id"
                                    label="Categoría"
                                    return-object
                                    single-line
                                    required
                                    :menu-props="{ top: true, offsetY: true }"
                                    ></v-select>
                                    <div v-if="form.errors.category">{{ form.errors.category }}</div>
                                </v-col>

                                <v-col cols="12" sm="6" md="4" >
                                    <v-select
                                    v-model="form.mark"
                                    :items="marks"
                                    hint="Seleccione Marca"
                                    item-text="name"
                                    item-value="id"
                                    label="Marca"
                                    return-object
                                    single-line
                                    required
                                    :menu-props="{ top: true, offsetY: true }"
                                    ></v-select>
                                    <div v-if="form.errors.mark">{{ form.errors.mark }}</div>
                                </v-col>

                                <v-col cols="12" sm="6" md="4" >
                                    <v-select
                                    v-model="form.measure"
                                    :items="measures"
                                    hint="Seleccione Medida"
                                    item-text="name"
                                    item-value="id"
                                    label="Medida"
                                    return-object
                                    single-line
                                    required
                                    :menu-props="{ top: true, offsetY: true }"
                                    ></v-select>
                                    <div v-if="form.errors.measure">{{ form.errors.measure }}</div>
                                </v-col>

                                <v-col cols="12" sm="6" md="4" >
                                    <v-select
                                    v-model="form.provider"
                                    :items="providers"
                                    hint="Seleccione proveedor"
                                    item-text="name"
                                    item-value="id"
                                    label="Proveedor"
                                    return-object
                                    single-line
                                    required
                                    :menu-props="{ top: true, offsetY: true }"
                                    ></v-select>
                                    <div v-if="form.errors.provider">{{ form.errors.provider }}</div>
                                </v-col>

                                <v-col cols="12" sm="6" md="4" >
                                    <v-select
                                    v-model="form.presentation"
                                    :items="presentations"
                                    hint="Seleccione presentación"
                                    item-text="name"
                                    item-value="id"
                                    label="Presentación"
                                    return-object
                                    single-line
                                    required
                                    :menu-props="{ top: true, offsetY: true }"
                                    ></v-select>
                                    <div v-if="form.errors.presentation">{{ form.errors.presentation }}</div>
                                </v-col>

                                <v-col cols="12" sm="6" md="4" >
                                    <v-select
                                    v-model="form.batch"
                                    :items="batches"
                                    hint="Seleccione Lote"
                                    item-text="code"
                                    item-value="id"
                                    label="Lote"
                                    return-object
                                    single-line
                                    required
                                    :menu-props="{ top: true, offsetY: true }"
                                    ></v-select>
                                    <div v-if="form.errors.batch">{{ form.errors.batch }}</div>
                                </v-col>
                                
                                <v-col cols="12" sm="6" md="4" >
                                    <v-select
                                    v-model="form.company"
                                    :items="companies"
                                    hint="Seleccione Compañía"
                                    item-text="name"
                                    item-value="id"
                                    label="Compañías"
                                    return-object
                                    single-line
                                    required
                                    :menu-props="{ top: true, offsetY: true }"
                                    ></v-select>
                                    <div v-if="form.errors.company">{{ form.errors.company }}</div>
                                </v-col>

                                <v-col cols="12" m="12" md="12" >
                                    <!-- <v-text-field
                                    v-model="form.description"
                                    label="Descripción"
                                    ></v-text-field> -->

                                    <v-textarea
                                    counter
                                    label="Descripción"
                                    v-model="form.description"
                                    :value="form.description"
                                    required
                                    ></v-textarea>
                                </v-col>
                            </v-row>
                        </v-container>
                    </v-card-text>

                    <v-card-actions>
                        <v-spacer></v-spacer>

                        <v-btn color="primary" dark class="mb-2" type="submit" 
                        :disabled="form.processing" 
                        :loading="form.processing">
                            Agregar
                        </v-btn>
                    </v-card-actions>
                </v-card>


            </form>

        </v-container>
    </admin-layout>
</template>

<script>
    import AdminLayout from "@/Layouts/AdminLayout";

    export default {

        props: [
            'companies', 
            'categories', 
            'marks',
            'measures',
            'providers',
            'presentations',
            'batches',
        ],
        components: {
            AdminLayout
        },
        data() {
            return {

                form: this.$inertia.form({
                    name: '',
                    code: '',
                    bar_code: '',
                    stock: '',
                    purchase_price: '',
                    sale_price: '',
                    description: '',
                    state: 1,
                    expiration_date: (new Date(Date.now() - (new Date()).getTimezoneOffset() * 60000)).toISOString().substr(0, 10),

                    category: '',
                    mark: '',
                    measure: '',
                    provider: '',
                    presentation: '',
                    batch: '',
                    company: '',                    
                }),

            }

        },

        methods: {
            submit() {
                this.form.post(this.route('products.store'), {
                    onFinish: () => this.form.reset(),
                });
            },
        }
    }

</script>