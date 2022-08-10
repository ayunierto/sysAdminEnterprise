<template>
    <admin-layout>

        <v-alert type="success" border="left" dismissible v-if="$page.props.flash.message">
            {{ $page.props.flash.message }}
        </v-alert>
        
        <!-- Alertas -->
        <div v-if="$page.props.errorBags.default">
            <div v-for="item in Object.keys($page.props.errors)" :key="item">
                <v-alert type="warning" border="left" dismissible>
                    {{ $page.props.errors[item] }}
                </v-alert>
            </div>
        </div>
        <!-- Fin de Alertas -->
        
        <v-data-table :headers="headers" :items="desserts" sort-by="name" 
        class="elevation-24" :search="search">
            <template v-slot:top>
                <v-toolbar flat >
                    <v-toolbar-title>Listado de Compras</v-toolbar-title>

                    <v-divider class="mx-4" inset vertical ></v-divider>

                    <v-spacer></v-spacer>

                    <v-dialog v-model="dialog" max-width="700px" >
                    
                    <template v-slot:activator="{ on, attrs }">
                        <v-btn color="primary" dark class="mb-2" v-bind="attrs" v-on="on">
                            Nueva Compra
                        </v-btn>
                        <v-spacer></v-spacer>
                        <v-text-field
                            v-model="search"
                            append-icon="mdi-magnify"
                            label="Buscar"
                            single-line
                            hide-details
                        ></v-text-field>
                    </template>

                    <v-card>
                        <v-card-title>
                        <span class="text-h5">{{ formTitle }}</span>
                        </v-card-title>

                        <v-card-text>
                            <v-container>
                                <v-row>
                                    {{ editedItem }}
                                    <v-col cols="12" sm="6" md="6" v-if="$page.props.user.role == 'master'">
                                        <v-select
                                        v-model="editedItem.companies_id"
                                        hint="Seleccione empresa"
                                        :items="companies"
                                        item-text="name"
                                        item-value="id"
                                        label="Seleccione empresa"
                                        single-line
                                        ></v-select>
                                    </v-col>

                                    <v-col cols="12" sm="6" md="6">
                                        <v-select
                                        v-model="editedItem.providers_id"
                                        hint="Seleccione proveedor"
                                        :items="providers"
                                        item-text="name"
                                        item-value="id"
                                        label="Seleccione proveedor"
                                        single-line
                                        ></v-select>
                                    </v-col>

                                    <v-col cols="12" sm="6" md="6">
                                        <v-select
                                        v-model="editedItem.payment_methods_id"
                                        hint="Seleccione método de pago"
                                        :items="payment_methods"
                                        item-text="description"
                                        item-value="id"
                                        label="Seleccione método de pago"
                                        single-line
                                        ></v-select>
                                    </v-col>

                                    <v-col cols="12" sm="6" md="6">
                                        <v-select
                                        v-model="editedItem.proof_payments_id"
                                        hint="Seleccione comprobante"
                                        :items="proof_payments"
                                        item-text="name"
                                        item-value="id"
                                        label="Seleccione comprobante"
                                        single-line
                                        ></v-select>
                                    </v-col>

                                    <v-col cols="12" sm="6" md="6">
                                        <v-select
                                        v-model="editedItem.coins_id"
                                        hint="Seleccione moneda"
                                        :items="coins"
                                        item-text="code"
                                        item-value="id"
                                        label="Seleccione moneda"
                                        single-line
                                        ></v-select>
                                    </v-col>

                                    <v-col cols="12" sm="6" md="6" >
                                        <v-text-field
                                        v-model="editedItem.exchange_rate"
                                        label="Tipo de cambio"
                                        required
                                        ></v-text-field>
                                    </v-col>

                                    <v-col cols="12" sm="6" md="6" >
                                        <v-text-field
                                        v-model="editedItem.date"
                                        label="Fecha"
                                        required
                                        ></v-text-field>
                                    </v-col>

                                    <v-col cols="12" sm="6" md="4">
                                        <v-menu
                                            ref="menu"
                                            v-model="menu"
                                            :close-on-content-click="false"
                                            :return-value.sync="editedItem.date"
                                            transition="scale-transition"
                                            offset-y
                                            min-width="auto" >
                                            
                                            <template v-slot:activator="{ on, attrs }">
                                            <v-text-field
                                                v-model="editedItem.date"
                                                label="Selecione fecha"
                                                readonly
                                                v-bind="attrs"
                                                v-on="on"
                                            ></v-text-field>
                                            </template>
                                            <v-date-picker v-model="editedItem.date" 
                                            no-title scrollable >
                                            <v-spacer></v-spacer>
                                            <v-btn text color="primary" @click="menu = false" >
                                                Cancel
                                            </v-btn>
                                            <v-btn text color="primary" @click="$refs.menu.save(editedItem.date)" >
                                                OK
                                            </v-btn>
                                            </v-date-picker>
                                        </v-menu>
                                    </v-col>

                                    <v-col cols="12" sm="6" md="6" >
                                        <v-text-field
                                        v-model="editedItem.total"
                                        label="Total"
                                        required
                                        ></v-text-field>
                                    </v-col>

                                    <v-col cols="12" sm="6" md="6" >
                                        <v-select
                                        v-model="editedItem.state"
                                        :items="items_state"
                                        item-text="name"
                                        item-value="value"
                                        label="Seleccione estado"
                                        persistent-hint
                                        single-line
                                        ></v-select>
                                    </v-col>

                                    <v-col cols="12" sm="12" md="12">
                                        <v-textarea v-model="editedItem.description" class="mx-2"
                                            label="Descripción" rows="2" hint="Descripción">
                                        </v-textarea>
                                    </v-col>

                                    


                                    details: '',
                                </v-row>
                            </v-container>
                        </v-card-text>

                        <v-card-actions>
                            <v-spacer></v-spacer>

                            <v-btn color="blue darken-1" text @click="close" >
                                Cancelar
                            </v-btn>

                            <v-btn color="blue darken-1" type="submit" text @click="save" >
                                Guardar
                            </v-btn>
                        </v-card-actions>
                    </v-card>
                    </v-dialog>

                    <v-dialog v-model="dialogDelete" max-width="500px">
                    <v-card>
                        <v-card-title class="text-h5">Está seguro que desea eliminar?</v-card-title>
                        <v-card-actions>
                        <v-spacer></v-spacer>

                        <v-btn color="blue darken-1" text @click="closeDelete">Cancelar</v-btn>
                        <v-btn color="blue darken-1" text @click="deleteItemConfirm">OK</v-btn>
                        <v-spacer></v-spacer>
                        </v-card-actions>
                    </v-card>
                    </v-dialog>
                </v-toolbar>
            </template>

            <template v-slot:item.actions="{ item }">
                <v-icon small class="mr-2" @click="viewItem(item)" >
                    mdi-eye
                </v-icon>
                <v-icon small class="mr-2" @click="editItem(item)" >
                        mdi-pencil
                    </v-icon>
                <v-icon small @click="deleteItem(item)" >
                    mdi-delete
                </v-icon>
            </template>

        </v-data-table>

        <template>
            <v-row justify="center">
                <v-dialog v-model="dialog_view" persistent max-width="600">
                
                <v-card>
                    <v-card-title class="text-h5">
                        Vista General de la compra
                    </v-card-title>
                    <v-card-text>
                        <v-list-item two-line>
                            <!-- <v-list-item-content>
                                <v-list-item-title>EMPRESA</v-list-item-title>
                                <v-list-item-subtitle>{{ editedItem.company_name }}</v-list-item-subtitle>
                            </v-list-item-content> -->

                            <v-list-item-content>
                                <v-list-item-title>PROVEEDOR</v-list-item-title>
                                <v-list-item-subtitle>{{ editedItem.provider_name }}</v-list-item-subtitle>
                            </v-list-item-content>

                            <v-list-item-content>
                                <v-list-item-title>METODO PAGO</v-list-item-title>
                                <v-list-item-subtitle>{{ editedItem.payment_method }}</v-list-item-subtitle>
                            </v-list-item-content>

                            <v-list-item-content>
                                <v-list-item-title>COMPROBANTE</v-list-item-title>
                                <v-list-item-subtitle>{{ editedItem.proof_payment }}</v-list-item-subtitle>
                            </v-list-item-content>

                            <v-list-item-content>
                                <v-list-item-title>MONEDA</v-list-item-title>
                                <v-list-item-subtitle>
                                    {{ editedItem.coin }}
                                </v-list-item-subtitle>
                            </v-list-item-content>
                            
                        </v-list-item>

                        <v-list-item>

                            <v-list-item-content>
                                <v-list-item-title>Tipo de cambio</v-list-item-title>
                                <v-list-item-subtitle>
                                    {{ editedItem.exchange_rate }}
                                </v-list-item-subtitle>
                            </v-list-item-content>

                            <v-list-item-content>
                                <v-list-item-title>TOTAL</v-list-item-title>
                                <v-list-item-subtitle>
                                    {{ editedItem.total }}
                                </v-list-item-subtitle>
                            </v-list-item-content>

                            <v-list-item-content>
                                <v-list-item-title>FECHA</v-list-item-title>
                                <v-list-item-subtitle>
                                    {{ editedItem.date }}
                                </v-list-item-subtitle>
                            </v-list-item-content>

                            <v-list-item-content>
                                <v-list-item-title>ESTADO</v-list-item-title>
                                <v-list-item-subtitle>
                                    {{ editedItem.state_name }}
                                </v-list-item-subtitle>
                            </v-list-item-content>
                        </v-list-item>


                        <v-list-item>

                            <v-list-item-content>
                                <v-list-item-title>PRODUCTOS</v-list-item-title>
                                <v-list-item-subtitle>
                                    <v-simple-table>
                                        <template v-slot:default>
                                        <thead>
                                            <tr>
                                                <th class="text-left"> Producto </th>
                                                <th class="text-left"> Cantidad </th>
                                                <th class="text-left"> Precio </th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <tr v-for="item in editedItem.details" :key="item.products_id">
                                                <td>{{ item.product_name }}</td>
                                                <td>{{ item.amount }}</td>
                                                <td>{{ item.price }}</td>
                                            </tr>
                                        </tbody>
                                        </template>
                                    </v-simple-table>   
                                </v-list-item-subtitle>
                            </v-list-item-content>
                        </v-list-item>
                        
                    </v-card-text>
                    <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn color="green darken-1" text @click="dialog_view = false" >
                            Cerrar
                        </v-btn>
                    </v-card-actions>
                </v-card>
                </v-dialog>
            </v-row>
            </template>

            

            <pre>{{ purchases }}</pre>

    </admin-layout>
</template>

<script>
    import AdminLayout from '@/Layouts/AdminLayout'
    import route from '../../../../vendor/tightenco/ziggy/src/js'

    export default {
        props: [
            'companies', 
            'providers', 
            'payment_methods',
            'proof_payments',
            'coins',
            'purchases',
            'exchange_rate',
        ],
        components: {
            AdminLayout,
        },
        data () {
            return {

                dialog_view: false,

                menu: false,

                items_state: [
                    { name: 'Activo', value: 1 },
                    { name: 'Inactivo', value: 0 },
                ],
                
                search: '',
                dialog: false,
                dialogDelete: false,
                headers: [
                    { text: 'Fecha', value: 'date' },
                    { text: 'PROVEEDOR', value: 'provider_name' },
                    { text: 'Estado', value: 'state_name' },
                    { text: 'ACCIONES', value: 'actions', sortable: false },
                ],
                desserts: [],

                editedIndex: -1,

                editedItem: {
                    companies_id: this.$page.props.user.companies_id,
                    company_name: '',
                    providers_id: '',
                    provider_name: '',
                    payment_methods_id: '',
                    payment_method: '',
                    proof_payments_id: '',
                    proof_payment: '',
                    coins_id: '',
                    coin: '',
                    exchange_rate: this.exchange_rate,
                    total: '',
                    date: '',
                    state: '',
                    state_name: '',
                    description: '',
                    details: '',
                },

                defaultItem: {
                    companies_id: this.$page.props.user.companies_id,
                    company_name: '',
                    providers_id: '',
                    provider_name: '',
                    payment_methods_id: '',
                    payment_method: '',
                    proof_payments_id: '',
                    proof_payment: '',
                    coins_id: '',
                    coin: '',
                    exchange_rate: this.exchange_rate,
                    total: '',
                    date: '',
                    state: '',
                    state_name: '',
                    description: '',
                    details: '',
                },
                
            }
        },

        computed: {
            formTitle () {
                return this.editedIndex === -1 ? 'Nueva compra' : 'Editar compra'
            },
        },

        watch: {

            dialog (val) {
                val || this.close()
            },

            dialogDelete (val) {
                val || this.closeDelete()
            },
        },

        created () {
            this.initialize();

        },

        
        
        updated() {

            // Para que agregue en el data table el item despues de saber que no hay errores en 
            // en el formulario de crear
            
            if (Object.values(this.$page.props.errors).length == 0) { 

                this.initialize();

            } 

        },

        methods: {

            initialize () {
                this.desserts = this.purchases
            },

            viewItem (item) {
                this.editedIndex = this.desserts.indexOf(item)
                this.editedItem = Object.assign({}, item)
                this.dialog_view = true
            },

            editItem (item) {
                this.editedIndex = this.desserts.indexOf(item)
                this.editedItem = Object.assign({}, item)
                this.dialog = true
            },

            deleteItem (item) {
                this.editedIndex = this.desserts.indexOf(item)
                this.editedItem = Object.assign({}, item)
                this.dialogDelete = true
            },

            deleteItemConfirm () {
                this.desserts.splice(this.editedIndex, 1)
                this.closeDelete()
                
                // ***************************************
                // enviando formulario para eliminar
                this.$inertia.delete(this.route('purchases.destroy', this.editedItem))
                // ***************************************
            },

            close () {
                this.dialog = false
                this.$nextTick(() => {
                    this.editedItem = Object.assign({}, this.defaultItem)
                    this.editedIndex = -1
                })
            },

            closeDelete () {
                this.dialogDelete = false
                this.$nextTick(() => {
                    this.editedItem = Object.assign({}, this.defaultItem)
                    this.editedIndex = -1
                })
            },

            save () {
                if (this.editedIndex > -1) {

                    // esto agregaba el item a la tabla con solo javascrip 
                    //pero ya no es necesario porque se renderiza el componente desde
                    // el servidor
                    // Object.assign(this.desserts[this.editedIndex], this.editedItem)

                    // Update
                    // ***************************************
                    // enviado formulario de almacenar 
                    this.$inertia.patch(route('purchases.update', this.editedItem ), this.editedItem)
                    // ***************************************

                } else {

                    // Store
                    // ***************************************
                    // enviado formulario de almacenar 
                    this.$inertia.post(route('purchases.store'), this.editedItem)

                    // this.desserts.push(this.editedItem)

                }

                this.close()
            },
        },
    }
</script>
