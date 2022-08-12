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

        <v-data-table :headers="headers" :items="desserts" sort-by="name" class="elevation-24" :search="search">
            <template v-slot:top>
                <v-toolbar flat>
                    <v-toolbar-title>Listado de Ventas</v-toolbar-title>

                    <v-divider class="mx-4" inset vertical></v-divider>

                    <v-spacer></v-spacer>
                    <v-text-field v-model="search" append-icon="mdi-magnify" label="Buscar" single-line hide-details>
                    </v-text-field>
                    <v-spacer></v-spacer>
                    <inertia-link :href="route('orders.index')">
                    <v-btn color="primary" dark class="mb-2">
                        Nueva Venta
                    </v-btn>
                    </inertia-link>
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
                <v-icon small class="mr-2" @click="viewItem(item)">
                    mdi-eye
                </v-icon>
                <v-icon small @click="deleteItem(item)">
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
                                    <v-list-item-title>CLIENTE</v-list-item-title>
                                    <v-list-item-subtitle>{{ editedItem.customers_name }}</v-list-item-subtitle>
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
                            <v-btn color="green darken-1" text @click="dialog_view = false">
                                Cerrar
                            </v-btn>
                        </v-card-actions>
                    </v-card>
                </v-dialog>
            </v-row>
        </template>



        <pre>{{ orders }}</pre>

    </admin-layout>
</template>

<script>
import AdminLayout from '@/Layouts/AdminLayout'

export default {
    props: [
        'orders',
    ],
    components: {
        AdminLayout,
    },
    data() {
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
                { text: 'FECHA', value: 'date' },
                { text: 'CLIENTE', value: 'customers_name' },
                { text: 'TOTAL', value: 'total' },
                { text: 'ESTADO', value: 'state_name' },
                { text: 'ACCIONES', value: 'actions', sortable: false },
            ],
            desserts: [],

            editedIndex: -1,

            editedItem: {
                companies_id:'',
                company_name: '',
                customers_id: '',
                customers_name: '',
                payment_methods_id: '',
                payment_method: '',
                proof_payments_id: '',
                proof_payment: '',
                coins_id: '',
                coin: '',
                documents_id:'',
                documents_name:'',
                exchange_rate: '',
                total: '',
                date: '',
                state: '',
                state_name: '',
                description: '',
                details: '',
            },

            defaultItem: {
                companies_id: '',
                company_name: '',
                customers_id: '',
                customers_name: '',
                payment_methods_id: '',
                payment_method: '',
                proof_payments_id: '',
                proof_payment: '',
                coins_id: '',
                coin: '',
                documents_id:'',
                documents_name:'',
                exchange_rate:'',
                total: '',
                date: '',
                state: '',
                state_name: '',
                description: '',
                details: '',
            },

        }
    },

    watch: {
        dialogDelete(val) {
            val || this.closeDelete()
        },
    },

    created() {
        this.initialize();

    },

    methods: {

        initialize() {
            this.desserts = this.orders
        },

        viewItem(item) {
            this.editedIndex = this.desserts.indexOf(item)
            this.editedItem = Object.assign({}, item)
            this.dialog_view = true
        },
        deleteItem(item) {
            this.editedIndex = this.desserts.indexOf(item)
            this.editedItem = Object.assign({}, item)
            this.dialogDelete = true
        },

        deleteItemConfirm() {
            this.desserts.splice(this.editedIndex, 1)
            this.closeDelete()

            // ***************************************
            // enviando formulario para eliminar
            this.$inertia.delete(this.route('orders.destroy', this.editedItem))
            // ***************************************
        },

        closeDelete() {
            this.dialogDelete = false
            this.$nextTick(() => {
                this.editedItem = Object.assign({}, this.defaultItem)
                this.editedIndex = -1
            })
        },
    },
}
</script>
