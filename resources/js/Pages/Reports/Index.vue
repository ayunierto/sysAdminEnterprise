
<template>
    <admin-layout>
        <v-card color="blue lighten-5">
            <v-tabs fixed-tabs icons-and-text color="green lighten-1">
                <v-tab>
                    VENTAS DEL DÍA
                </v-tab>
                <v-tab>
                    COMPRAS DEL DÍA
                </v-tab>
                <v-tab>
                    PRODUCTOS
                </v-tab>
                <v-tab>
                    QRCode
                </v-tab>
                <!-- Ventas del día -->
                <v-tab-item><br>
                    <v-card elevation="0">
                        <v-container>
                            <v-row>
                                <v-spacer></v-spacer>
                                <v-card class="mx-5" max-width="180" outlined>
                                    <v-list-item three-line>
                                        <v-list-item-content>
                                            <div>
                                                N° VENTAS
                                            </div>
                                            <v-list-item-title>
                                                {{totOrders}}
                                            </v-list-item-title>
                                        </v-list-item-content>

                                        <v-list-item-avatar tile size="30">
                                            <v-img contain src="/img/dashboard/ventas.png">
                                            </v-img>
                                        </v-list-item-avatar>
                                    </v-list-item>
                                </v-card>
                                <v-card class="mx-5" max-width="180" outlined>
                                    <v-list-item three-line>
                                        <v-list-item-content>
                                            <div>
                                                TOTAL VENTAS
                                            </div>
                                            <v-list-item-title>
                                                S/. {{totalVentas}}
                                            </v-list-item-title>
                                        </v-list-item-content>

                                        <v-list-item-avatar tile size="30">
                                            <v-img contain src="/img/dashboard/totalVentas.png">
                                            </v-img>
                                        </v-list-item-avatar>
                                    </v-list-item>
                                </v-card>
                                <v-card class="mx-5" max-width="180" outlined>
                                    <v-list-item three-line>
                                        <v-list-item-content>
                                            <div>
                                                GANANCIAS
                                            </div>
                                            <v-list-item-title>
                                                S/. {{totalPrecioCompra}}
                                            </v-list-item-title>
                                        </v-list-item-content>

                                        <v-list-item-avatar tile size="30">
                                            <v-img contain src="/img/dashboard/ganancias.png">
                                            </v-img>
                                        </v-list-item-avatar>
                                    </v-list-item>
                                </v-card>
                                <v-spacer></v-spacer>
                            </v-row>
                        </v-container>
                    </v-card>
                    <v-data-table :headers="ventasDia" :items="dessertsVentas" sort-by="name" class="elevation-24"
                        :search="searchV">
                        <template v-slot:top>
                            <v-toolbar flat>
                                <v-spacer></v-spacer>
                                <v-text-field v-model="searchV" append-icon="mdi-magnify" label="Buscar" outlined dense
                                    hide-details>
                                </v-text-field>
                                <v-spacer></v-spacer>
                            </v-toolbar>
                        </template>
                        <!-- Acciones -->
                        <template v-slot:[`item.actions`]="{ item }">
                            <v-icon small class="mr-2" @click="printItem(item)">
                                mdi-printer
                            </v-icon>
                            <v-icon small class="mr-2" @click="viewItem(item)">
                                mdi-eye
                            </v-icon>
                        </template>
                    </v-data-table>
                </v-tab-item>
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
                                            <v-text-field label="CLIENTE" v-model="editedItemVentas.customers_name"
                                                readonly>
                                            </v-text-field>
                                        </v-col>
                                        <v-col cols="12" sm="6" md="3">
                                            <v-text-field label="METODO PAGO" v-model="editedItemVentas.payment_method"
                                                readonly>
                                            </v-text-field>
                                        </v-col>
                                        <v-col cols="12" sm="6" md="3">
                                            <v-text-field label="COMPROBANTE" v-model="editedItemVentas.proof_payment"
                                                readonly>
                                            </v-text-field>
                                        </v-col>
                                        <v-col cols="12" sm="6" md="3">
                                            <v-text-field label="MONEDA" v-model="editedItemVentas.coin" readonly>
                                            </v-text-field>
                                        </v-col>
                                        <v-col cols="12" sm="6" md="3">
                                            <v-text-field label="Tipo de cambio"
                                                v-model="editedItemVentas.exchange_rate" readonly>
                                            </v-text-field>
                                        </v-col>
                                        <v-col cols="12" sm="6" md="3">
                                            <v-text-field label="TOTAL" v-model="editedItemVentas.total" readonly>
                                            </v-text-field>
                                        </v-col>
                                        <v-col cols="12" sm="6" md="3">
                                            <v-text-field label="FECHA" v-model="editedItemVentas.date" readonly>
                                            </v-text-field>
                                        </v-col>
                                        <v-col cols="12" sm="6" md="3">
                                            <v-text-field label="ESTADO" v-model="editedItemVentas.state_name" readonly>
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
                                                        <tr v-for="item in editedItemVentas.details"
                                                            :key="item.products_id">
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

                <!-- Compras del dia -->
                <v-tab-item> <br>
                    <v-card elevation="0">
                        <v-container>
                            <v-row>
                                <v-spacer></v-spacer>
                                <v-card class="mx-5" max-width="180" outlined>
                                    <v-list-item three-line>
                                        <v-list-item-content>
                                            <div>
                                                N° COMPRAS
                                            </div>
                                            <v-list-item-title>
                                                {{totOrders}}
                                            </v-list-item-title>
                                        </v-list-item-content>

                                        <v-list-item-avatar tile size="30">
                                            <v-img contain src="/img/dashboard/ventas.png">
                                            </v-img>
                                        </v-list-item-avatar>
                                    </v-list-item>
                                </v-card>
                                <v-card class="mx-5" max-width="180" outlined>
                                    <v-list-item three-line>
                                        <v-list-item-content>
                                            <div>
                                                TOTAL EN COMPRAS
                                            </div>
                                            <v-list-item-title>
                                                S/. {{totalVentas}}
                                            </v-list-item-title>
                                        </v-list-item-content>

                                        <v-list-item-avatar tile size="30">
                                            <v-img contain src="/img/dashboard/totalVentas.png">
                                            </v-img>
                                        </v-list-item-avatar>
                                    </v-list-item>
                                </v-card>
                                <v-spacer></v-spacer>
                            </v-row>
                        </v-container>
                    </v-card>
                    <v-data-table :headers="comprasDia" :items="dessertsCompras" sort-by="name" class="elevation-24"
                        :search="searchC">
                        <template v-slot:top>
                            <v-toolbar flat>
                                <v-spacer></v-spacer>
                                <v-text-field v-model="searchC" append-icon="mdi-magnify" label="Buscar" outlined dense
                                    hide-details>
                                </v-text-field>
                                <v-spacer></v-spacer>
                            </v-toolbar>
                        </template>
                        <!-- Acciones -->
                        <template v-slot:[`item.actions`]="{ item }">
                            <v-icon small class="mr-2" @click="printItem(item)">
                                mdi-printer
                            </v-icon>
                            <v-icon small class="mr-2" @click="viewItem(item)">
                                mdi-eye
                            </v-icon>
                        </template>
                    </v-data-table>
                </v-tab-item>
            </v-tabs>
        </v-card>
        <!-- <pre>{{ valores }}</pre> -->
    </admin-layout>
</template>
<script>
import AdminLayout from '@/Layouts/AdminLayout'
export default {
    props: [
        'orders',
        'purchases',
        'totalVentas',
        'totOrders',
        'totalPrecioCompra',
    ],
    components: {
        AdminLayout,
    },
    data() {
        return {
            searchV: '',
            searchC: '',
            dialog_view: false,

            // VENTAS
            ventasDia: [
                { text: 'FECHA', value: 'date' },
                { text: 'CLIENTE', value: 'customers_name' },
                { text: 'TOTAL', value: 'total' },
                { text: 'MONEDA', value: 'coin' },
                { text: 'ESTADO', value: 'state_name' },
                { text: 'ACCIONES', value: 'actions', sortable: false },
            ],
            dessertsVentas: [],
            editedIndexVentas: -1,
            editedItemVentas: {
                id: '',
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

            defaultItemVentas: {
                id: '',
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

            // COMPRAS
            comprasDia: [
            { text: 'FECHA', value: 'date' },
                { text: 'PROVEEDOR', value: 'provider_name' },
                { text: 'TOTAL', value: 'total' },
                { text: 'MONEDA', value: 'coin' },
                { text: 'ESTADO', value: 'state_name' },
                { text: 'ACCIONES', value: 'actions', sortable: false },
            ],
            dessertsCompras: [],
            editedIndexCompras: -1,
            editedItemCompras: {
                id: '',
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

            defaultItemCompras: {
                id: '',
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
    created() {
        this.initialize();

    },
    methods: {
        initialize() {
            this.dessertsVentas = this.orders
            this.dessertsCompras = this.purchases
        },
        viewItem(item) {
            this.editedIndexVentas = this.dessertsVentas.indexOf(item)
            this.editedItemVentas = Object.assign({}, item)
            this.dialog_view = true
        },
    },
}
</script>
