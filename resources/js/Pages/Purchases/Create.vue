<template>
    <admin-layout>

        <v-alert type="success" border="left" dismissible v-if="$page.props.flash.message">
            {{ $page.props.flash.message }}
        </v-alert>
        
        <!-- Alertas -->
        <div v-if="$page.props.errorBags.default" style="position: absolute; right: 10px; top: 20px; z-index:3; opacity: 0.9;">
            <div v-for="item in Object.keys($page.props.errors)" :key="item">
                <v-alert type="warning" border="left" dismissible >
                    {{ $page.props.errors[item] }}
                </v-alert>
            </div>
        </div>
        <!-- Fin de Alertas -->

        <v-card class="overflow-hidden" color="white"  elevation-10 >
            <v-toolbar flat color="#ECEFF1">
                <v-toolbar-title class="font-weight-light" >
                    Nueva Compra
                </v-toolbar-title>
            </v-toolbar>
            <v-card-text>
                <v-container>
                    <v-row>
                        <v-col cols="12" sm="4" md="3">
                            <v-select dense
                            v-model="form.proof_payments_id"
                            hint="Seleccione comprobante"
                            :items="proof_payments"
                            item-text="name"
                            item-value="id"
                            label="Seleccione comprobante"
                            outlined
                            ></v-select>
                        </v-col>


                        <v-col cols="12" sm="4" md="3">
                            <v-text-field dense
                                label="Nro Comprobante"
                                v-model="form.voucher_number"
                                hint="Nro Comprobante"
                                outlined
                            ></v-text-field>
                        </v-col>

                        <!-- Fecha -->
                        <v-col cols="12" sm="4" md="3">
                            <v-menu
                                ref="menu"
                                v-model="menu"
                                :close-on-content-click="false"
                                :return-value.sync="form.date"
                                transition="scale-transition"
                                offset-y
                                min-width="auto" >
                                
                                <template v-slot:activator="{ on, attrs }">
                                    <v-text-field dense
                                        v-model="form.date"
                                        label="Selecione fecha"
                                        readonly
                                        v-bind="attrs"
                                        v-on="on"
                                        outlined
                                    ></v-text-field>
                                </template>

                                <v-date-picker v-model="form.date" 
                                no-title scrollable >
                                <v-spacer></v-spacer>
                                <v-btn text color="primary" @click="menu = false" >
                                    Cancel
                                </v-btn>
                                <v-btn text color="primary" @click="$refs.menu.save(form.date)" >
                                    OK
                                </v-btn>
                                </v-date-picker>
                            </v-menu>
                        </v-col>

                        <v-col cols="12" sm="4" md="3">
                            <v-select dense
                            v-model="form.providers_id"
                            hint="Seleccione proveedor"
                            :items="providers"
                            item-text="name"
                            item-value="id"
                            label="Seleccione proveedor"
                            outlined
                            ></v-select>
                        </v-col>

                        <v-col cols="12">
                            <h3>DETALLE DE COMPRA</h3>
                        </v-col>

                        <v-col cols="12" sm="4" md="3">
                            <v-select dense
                            v-model="form.payment_methods_id"
                            hint="Seleccione método de pago"
                            :items="payment_methods"
                            item-text="description"
                            item-value="id"
                            label="Seleccione método de pago"
                            outlined
                            ></v-select>
                        </v-col>

                        <v-col cols="12" sm="4" md="3">
                            <v-select dense
                            v-model="form.coins_id"
                            hint="Seleccione moneda"
                            :items="coins"
                            item-text="code"
                            item-value="id"
                            label="Seleccione moneda"
                            outlined
                            @change="coin_change"
                            ></v-select>
                        </v-col>

                        <v-col cols="12" sm="4" md="2" >
                            <v-text-field dense
                            v-model="form.exchange_rate"
                            label="Tipo de cambio"
                            required
                            readonly
                            outlined
                            ></v-text-field>
                        </v-col>

                        <v-col cols="12" sm="4" md="2" >
                            <v-text-field dense
                            v-model="form.total"
                            label="Total"
                            required
                            readonly
                            outlined
                            ></v-text-field>
                        </v-col>

                        <v-col cols="12" sm="4" md="2" >
                            <v-select dense
                            v-model="form.state"
                            :items="items_state"
                            item-text="name"
                            item-value="value"
                            label="Seleccione estado"
                            persistent-hint
                            outlined
                            ></v-select>
                        </v-col>

                        
                        <!-- Carrito -->
                        <v-col cols="12">
                            <v-data-table :headers="headers" :items="desserts" sort-by="calories" class="elevation-1" >
                                <template v-slot:top>
                                <v-toolbar flat >
                                    <v-toolbar-title>CARRITO</v-toolbar-title>
                                    <v-divider
                                    class="mx-4"
                                    inset
                                    vertical
                                    ></v-divider>
                                    <v-spacer></v-spacer>
                                    <v-dialog
                                    v-model="dialog"
                                    max-width="500px"
                                    >
                                    <template v-slot:activator="{ on, attrs }">
                                        <v-btn
                                        color="primary"
                                        dark
                                        class="mb-2"
                                        v-bind="attrs"
                                        v-on="on"
                                        >
                                        Agregar producto
                                        </v-btn>
                                    </template>
                                    <v-card>
                                        <v-card-title>
                                        <span class="text-h5">{{ formTitle }}</span>
                                        </v-card-title>

                                        <v-card-text>
                                        <v-container>
                                            <v-row>
                                                <v-col cols="12" sm="12" md="8" v-if="editedIndex == -1">
                                                    <v-autocomplete
                                                    clearable
                                                    label="Producto"
                                                    v-model="new_item_car"
                                                    :items="products"
                                                    return-object
                                                    item-text="name"
                                                    outlined dense
                                                    auto-select-first

                                                    ></v-autocomplete>
                                                </v-col>

                                                <v-col cols="12" sm="12" md="8">
                                                    <v-autocomplete
                                                    clearable
                                                    label="Presentación"
                                                    v-model="editedItem.presentation"
                                                    :items="presentations"
                                                    return-object
                                                    item-text="name"
                                                    outlined dense
                                                    auto-select-first
                                                    ></v-autocomplete>
                                                </v-col>   
                                                
                                                <v-col cols="12" sm="12" md="12">
                                                    <v-text-field
                                                    v-model="editedItem.amount"
                                                    label="Cantidad"
                                                    type="number"
                                                    outlined dense
                                                    ></v-text-field>
                                                </v-col>
                                            </v-row>
                                        </v-container>
                                        </v-card-text>

                                        <v-card-actions>
                                        <v-spacer></v-spacer>
                                        <v-btn color="secondary" @click="close" elevation="9">
                                            Cancelar
                                        </v-btn>
                                        <v-btn color="primary" @click="save" elevation="9">
                                            Guardar
                                        </v-btn>
                                        </v-card-actions>
                                    </v-card>
                                    </v-dialog>

                                    <v-dialog v-model="dialogDelete" max-width="500px">
                                        <v-card>
                                            <v-card-title class="text-h5">Está seguro que desea eliminar el producto?</v-card-title>
                                            <v-card-actions>
                                            <v-spacer></v-spacer>
                                            <v-btn color="secondary" @click="closeDelete" elevation="9">Cancel</v-btn>
                                            <v-btn color="error" @click="deleteItemConfirm" elevation="9">OK</v-btn>
                                            <v-spacer></v-spacer>
                                            </v-card-actions>
                                        </v-card>
                                    </v-dialog>
                                </v-toolbar>
                                </template>
                                <template v-slot:[`item.actions`]="{ item }">
                                <v-icon
                                    small
                                    class="mr-2"
                                    @click="editItem(item)"
                                >
                                    mdi-pencil
                                </v-icon>
                                <v-icon
                                    small
                                    @click="deleteItem(item)"
                                >
                                    mdi-delete
                                </v-icon>
                                </template>
                                <template v-slot:no-data>
                                    No hay productos en el carrito
                                </template>
                            </v-data-table>
                        </v-col>
                        <!-- Fin Carrito -->

                    </v-row>
                </v-container>
            </v-card-text>
            <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="secondary"  elevation="9">
                    Cancelar
                </v-btn>
                
                <v-btn color="primary"  @click="send_form" elevation="9">
                    Guardar
                </v-btn>
                
            </v-card-actions>
        </v-card>

        <v-snackbar v-model="snackbar" :color="snackbar_color" right top>
            {{ snackbar_text }}
        </v-snackbar>

        <!-- <pre>{{ editedItem }}</pre> -->
        <!-- <pre>{{ editedIndex }}</pre> -->
        <!-- <pre>{{ form.products }}</pre> -->
        
    </admin-layout>
</template>

<script>
    import AdminLayout from '@/Layouts/AdminLayout'

    export default {
        props: [
            'companies', 
            'providers', 
            'payment_methods',
            'proof_payments',
            'coins',
            'exchange_rate',
            'products',
            'presentations'
        ],
        components: {
            AdminLayout,
        },
  
        data () {
            return {

                form: {
                    companies_id: this.$page.props.user.companies_id,
                    providers_id: '',
                    payment_methods_id: 1,
                    proof_payments_id: 3,
                    voucher_number: '',
                    exchange_rate: this.exchange_rate,
                    date: (new Date(Date.now() - (new Date()).getTimezoneOffset() * 60000)).toISOString().substr(0, 10),
                    coins_id: 1,
                    state: 1,
                    products: null,
                    total: 0,
                },

                snackbar: false,
                snackbar_text: '',
                snackbar_color: '',

                new_item_car: null,

                menu: false,

                items_state: [
                    { name: 'Activo', value: 1 },
                    { name: 'Inactivo', value: 0 },
                ],

                // para el carrito
                dialog: false,
                dialogDelete: false,
                headers: [
                
                    { text: 'PRODUCTO', value: 'name' },
                    // { text: 'PRESENTACION', value: 'presentation' },
                    { text: 'CANTIDAD', value: 'amount' },
                    { text: 'PRECIO', value: 'purchase_price' },
                    { text: 'TOTAL', value: 'total' },
                    { text: 'ACCIONES', value: 'actions', sortable: false },

                ],
                desserts: [],
                editedIndex: -1,
                editedItem: {
                    id: '',
                    name: '',
                    presentation: '',
                    amount: 1,
                    purchase_price: 0,
                    total: 0,
                },
                defaultItem: {
                    id: '',
                    name: '',
                    presentation: '',
                    amount: 1,
                    purchase_price: 0,
                    total: 0,
                },
                // fin para el carrito
    
            }
        },

        computed: {
            formTitle () {
                return this.editedIndex === -1 ? 'Agregar' : 'Editar'
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
            this.initialize()
        },

        methods: {
            initialize () {
                this.desserts = []
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

                // reducir el monto total de la compra
                this.form.total -=  this.editedItem.total
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

                    
                    // Actualizando precios segun compra
                    this.form.total -=  this.editedItem.total //quitando precio del producto
                    this.editedItem.total = this.editedItem.purchase_price * this.editedItem.amount // calculando nuevo precio
                    this.form.total +=  this.editedItem.total // agregando el nuevo precio
                    this.new_item_car = null; // reseteando variable 

                    Object.assign(this.desserts[this.editedIndex], this.editedItem)

                } else {

                    // agregar producto a editedItem
                    if (this.new_item_car == null) { // Comprobando se dejo campo vacio
                        this.snackbar_text = 'Complete los campos';
                        this.snackbar_color = 'red';
                        this.snackbar = true;

                        return ;
                    }

                    if (this.editedItem.presentation == '') { // Comprobando se dejo campo vacio
                        this.snackbar_text = 'Complete los campos';
                        this.snackbar_color = 'red';
                        this.snackbar = true;

                        return ;
                    }

                    this.editedItem.id = this.new_item_car.id
                    this.editedItem.name = this.new_item_car.name
                    // this.editedItem.presentation = this.new_item_car.presentation.name
                    this.editedItem.purchase_price = this.new_item_car.purchase_price
                    this.editedItem.total = this.new_item_car.purchase_price * this.editedItem.amount
                    this.form.total +=  this.editedItem.total
                    this.new_item_car = null;
                    // fin agregar producto a editedItem

                    this.desserts.push(this.editedItem)
                }
                this.close()
            },


            send_form () {
                this.form.products = this.desserts
                this.$inertia.post(route('purchases.store'), this.form)
            },

            // para cambiar de moneda
            coin_change() {
                if (this.form.coins_id == 1) {
                    this.form.total = this.mathRound2(this.form.total * this.exchange_rate, 2)

                } 
                if (this.form.coins_id == 2) {
                    this.form.total = this.mathRound2(this.form.total / this.exchange_rate, 2)
                    
                }
            },

            // redondea un numero a dos decimales
            mathRound2 (num, decimales = 2) {
                var exponente = Math.pow(10, decimales);
                return (num >= 0 || -1) * Math.round(Math.abs(num) * exponente) / exponente;
            }


        },
        
  
    }
</script>