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
        <v-data-table :headers="headers" :items="desserts" sort-desc sort-by="date" class="elevation-24" :search="search">
            <template v-slot:top>
                <v-toolbar flat>
                    <v-toolbar-title>Listado de Ventas</v-toolbar-title>

                    <v-divider class="mx-4" inset vertical></v-divider>

                    <v-spacer></v-spacer>
                    <v-text-field v-model="search" append-icon="mdi-magnify" label="Buscar" single-line hide-details>
                    </v-text-field>
                    <v-spacer></v-spacer>
                    <inertia-link :href="route('orders.create')">
                        <v-btn color="primary" dark class="mb-2">
                            Nueva Venta
                        </v-btn>
                    </inertia-link>
                    <!-- Memsaje al presionar boton borrar -->
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

            <template v-slot:[`item.actions`]="{ item }">
                <v-icon small class="mr-2" @click="viewItem(item)">
                    mdi-eye
                </v-icon>
                <v-icon small @click="deleteItem(item)">
                    mdi-delete
                </v-icon>
            </template>

        </v-data-table>
        <!-- Ver detalles Ventas -->
        <template>
            <v-row justify="center">
                <v-dialog v-model="dialog_view" max-width="700">

                    <v-card>
                        <v-card-title class="text-h5">
                            Detalle de Venta
                        </v-card-title>
                        <v-card-text>
                            <v-row>
                                <v-col cols="12" sm="6" md="3">
                                    <v-text-field label="CLIENTE" v-model="editedItem.customers_name" readonly>
                                    </v-text-field>
                                </v-col>
                                <v-col cols="12" sm="6" md="3">
                                    <v-text-field label="METODO PAGO" v-model="editedItem.payment_method" readonly>
                                    </v-text-field>
                                </v-col>
                                <v-col cols="12" sm="6" md="3">
                                    <v-text-field label="COMPROBANTE" v-model="editedItem.proof_payment" readonly>
                                    </v-text-field>
                                </v-col>
                                <v-col cols="12" sm="6" md="3">
                                    <v-text-field label="MONEDA" v-model="editedItem.coin" readonly>
                                    </v-text-field>
                                </v-col>
                                <v-col cols="12" sm="6" md="3">
                                    <v-text-field label="Tipo de cambio" v-model="editedItem.exchange_rate" readonly>
                                    </v-text-field>
                                </v-col>
                                <v-col cols="12" sm="6" md="3">
                                    <v-text-field label="TOTAL" v-model="editedItem.total" readonly>
                                    </v-text-field>
                                </v-col>
                                <v-col cols="12" sm="6" md="3">
                                    <v-text-field label="FECHA" v-model="editedItem.date" readonly>
                                    </v-text-field>
                                </v-col>
                                <v-col cols="12" sm="6" md="3">
                                    <v-text-field label="ESTADO" v-model="editedItem.state_name" readonly>
                                    </v-text-field>
                                </v-col>
                            </v-row>
                            <v-card elevation="2">
                                <v-card-text>
                                    <v-simple-table fixed-header height="250px">
                                        <template v-slot:default>
                                            <thead>
                                                <tr>
                                                    <th class="text-left"> PRODUCTO </th>
                                                    <th class="text-left"> CANTIDAD </th>
                                                    <th class="text-left"> PRECIO </th>
                                                    <th class="text-left"> IGV </th>
                                                    <th class="text-left"> SUB TOTAL </th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <tr v-for="item in editedItem.details" :key="item.products_id">
                                                    <td>{{ item.product_name }}</td>
                                                    <td>{{ item.quantity }}</td>
                                                    <td>{{ item.price }}</td>
                                                    <td>{{ item.igv }}</td>
                                                    <td>{{ item.subTotal }}</td>
                                                </tr>
                                            </tbody>
                                        </template>
                                    </v-simple-table>
                                </v-card-text>
                            </v-card>

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
        <!-- Fin Ver detalles Ventas -->
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
                id:'',
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
                documents_id: '',
                documents_name: '',
                exchange_rate: '',
                total: '',
                date: '',
                state: '',
                state_name: '',
                description: '',
                details: '',
            },

            defaultItem: {
                id:'',
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
                documents_id: '',
                documents_name: '',
                exchange_rate: '',
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
        dialog(val) {
            val || this.close()
        },
        dialogDelete(val) {
            val || this.closeDelete()
        },
    },

    created() {
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
            this.$inertia.delete(this.route('orders.destroy', this.editedItem.id))
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
