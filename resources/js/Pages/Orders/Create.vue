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
        <v-container>
            <v-layout>
                <v-flex>
                    <v-card class="overflow-hidden" elevation-10 loading>
                        <v-toolbar flat color="blue-grey lighten-4">
                            <v-icon>mdi-cart</v-icon>
                            <v-toolbar-title class="font-weight-light">
                                Nueva Venta
                            </v-toolbar-title>
                            <v-spacer></v-spacer>
                            <inertia-link :href="route('orders.index')">
                                <v-btn fab small>
                                    <v-icon color="primary">
                                        mdi-cards-variant
                                    </v-icon>
                                </v-btn>
                            </inertia-link>
                        </v-toolbar>
                        <v-card-text>
                            <v-container>
                                <v-row>
                                    <v-col cols="12" sm="6" md="3">
                                        <v-select hint="Seleccione Comprobante" :items="proofPayments"
                                            label="Comprobante" item-text="name" item-value="code"
                                            v-model="tipoComprobate" return-object>
                                        </v-select>
                                        <!-- {{ tipoComprobate }} -->
                                    </v-col>
                                    <v-col cols="12" sm="6" md="2">
                                        <v-text-field label="Serie" type="text" v-model="tipoComprobate.serie" readonly>
                                        </v-text-field>
                                    </v-col>
                                    <!-- Correlativo de acuerdo al tipo de comprobante -->
                                    <v-col cols="12" sm="4" md="3">
                                        <v-text-field label="Correlativo" v-if="tipoComprobate.name == 'Comprobante'"
                                            v-model="nroComprobantes" readonly>
                                        </v-text-field>
                                        <v-text-field label="Correlativo" v-if="tipoComprobate.name == 'Factura'"
                                            v-model="nroFacturas" readonly>
                                        </v-text-field>
                                        <v-text-field label="Correlativo"
                                            v-if="tipoComprobate.name == 'Boleta de Venta'" v-model="nroBoletas"
                                            readonly>
                                        </v-text-field>
                                    </v-col>
                                    <v-col cols="12" sm="6" md="3">
                                        <v-text-field label="Fecha" v-model="date" readonly>
                                        </v-text-field>
                                    </v-col>
                                    <v-col cols="12">
                                        <h3>DATOS CLIENTE</h3>
                                    </v-col>
                                    <v-col class="d-flex" cols="12" sm="2" md="2">
                                        <v-select :items="documents" label="Tipo Documento" item-text="name"
                                            item-value="code" v-model="tipoDoc" return-object>
                                        </v-select>
                                    </v-col>
                                    <v-col cols="12" sm="3" md="3">
                                        <v-autocomplete v-if="tipoDoc.name == 'DNI'" color="primary" :items="customers"
                                            item-text="document" v-model="datosCliente" item-value="id" label="Cliente"
                                            auto-select-first hide-no-data hide-selected
                                            placeholder="Buscar por Documento" persistent-hint return-object required>
                                        </v-autocomplete>
                                        <v-autocomplete v-if="tipoDoc.name == 'RUC'" color="primary" :items="customers"
                                            item-text="name" v-model="datosCliente" item-value="id" label="Cliente"
                                            auto-select-first hide-no-data hide-selected placeholder="Buscar por Nombre"
                                            persistent-hint return-object required>
                                        </v-autocomplete>
                                    </v-col>
                                    <v-col cols="12" sm="4" md="4">
                                        <v-text-field label="Nombre/Razon Social" :value="datosCliente.name" readonly>
                                        </v-text-field>
                                    </v-col>
                                    <v-col cols="12" sm="3" md="3">
                                        <v-text-field label="Dirección" :value="datosCliente.address" readonly></v-text-field>
                                    </v-col>
                                    <v-col cols="12">
                                        <h3>DETALLE DE VENTA</h3>
                                    </v-col>
                                    <v-col cols="12" sm="2" md="2">
                                        <v-select :items="paymentMethods" label="Contado/crédito"
                                            item-text="description" item-value="description" v-model="metodoPago"
                                            return-object>
                                        </v-select>
                                    </v-col>
                                    <v-col cols="12" sm="1" md="1" v-if="metodoPago.description == 'Credito'">
                                        <v-container v-if="metodoPago.description == 'Credito'">
                                            <v-layout row justify-center>
                                                <v-dialog v-model="quotasAdd" persistent max-width="400">
                                                    <template v-slot:activator="{ on, attrs }">
                                                        <v-btn color="#FFB74D" small class="ma-2 white--text" fab
                                                            v-bind="attrs" v-on="on">
                                                            <v-icon dark>
                                                                mdi-book-plus
                                                            </v-icon>
                                                        </v-btn>
                                                    </template>
                                                    <v-card>
                                                        <v-card-title class="headline">Quotas</v-card-title>
                                                        <v-container>
                                                            <v-row>
                                                                <v-col cols="12" sm="6" md="6">
                                                                    <v-text-field label="Monto" type="number" outlined>
                                                                    </v-text-field>
                                                                </v-col>
                                                                <v-col cols="12" sm="6" md="6">
                                                                    <v-text-field label="fecha" type="date" outlined>
                                                                    </v-text-field>
                                                                </v-col>
                                                                <v-col cols="12" sm="6" md="6"><a>+ add quota</a>
                                                                </v-col>

                                                            </v-row>
                                                        </v-container>

                                                        <v-card-actions>
                                                            <v-spacer></v-spacer>
                                                            <v-btn color="primary" @click.native="quotasAdd = false">
                                                                Disagree</v-btn>
                                                            <v-btn color="primary" @click.native="quotasAdd = false">
                                                                Agree</v-btn>
                                                        </v-card-actions>
                                                    </v-card>
                                                </v-dialog>
                                            </v-layout>
                                        </v-container>
                                    </v-col>
                                    <v-col cols="12" sm="2" md="2">
                                        <v-select :items="coins" label="Moneda" item-text="code"
                                            item-value="code" :value="coins[0]"></v-select>
                                    </v-col>
                                    <v-col cols="12" sm="2" md="2">
                                        <v-text-field label="Tipo Cambio" type="number" :value="exchange_rate" min="0"
                                            outlined>
                                        </v-text-field>
                                    </v-col>
                                    <v-col cols="12" sm="2" md="2">
                                        <v-text-field label="Total" type="number" v-model="totalventas" readonly>
                                        </v-text-field>
                                    </v-col>
                                    <v-col cols="12" sm="3" md="3">
                                        <v-textarea label="Comentario" type="text" rows="1" class="mx-2">
                                        </v-textarea>
                                    </v-col>
                                    <v-spacer></v-spacer>
                                    <template>
                                        <div class="text-center">
                                            <v-dialog v-model="dialog" width="600">
                                                <template v-slot:activator="{ on, attrs }">
                                                    <v-btn color="primary" class="ma-2 white--text" fab v-bind="attrs"
                                                        v-on="on">
                                                        <v-icon dark>
                                                            mdi-cart
                                                        </v-icon>
                                                    </v-btn>
                                                </template>

                                                <v-card>
                                                    <v-card-title class="text-h5 grey lighten-2">
                                                        {{ formTitle }}
                                                    </v-card-title>
                                                    <v-card-text>
                                                        <v-container>
                                                            <v-row>
                                                                <v-col cols="12" sm="6" md="6">
                                                                    <v-autocomplete color="primary" :items="products"
                                                                        v-model="datosProducto" item-text="name"
                                                                        label="Producto" auto-select-first hide-no-data
                                                                        hide-selected placeholder="Seleccione Producto"
                                                                        persistent-hint return-object required>
                                                                    </v-autocomplete>
                                                                </v-col>

                                                                <v-col cols="12" sm="6" md="6">
                                                                    <v-autocomplete color="primary"
                                                                        v-model="editedItem.presentation"
                                                                        :items="presentations" item-text="name"
                                                                        label="Presentación" auto-select-first
                                                                        hide-no-data hide-selected
                                                                        placeholder="Seleccione Presentación"
                                                                        persistent-hint return-object required>
                                                                    </v-autocomplete>
                                                                </v-col>
                                                                <v-col cols="12" sm="6" md="3">
                                                                    <v-text-field v-model="editedItem.quantity"
                                                                        label="Cantidad" type="number" min="0" required>
                                                                    </v-text-field>
                                                                </v-col>
                                                                <v-col cols="12" sm="6" md="3">
                                                                    <v-text-field v-model="datosProducto.sale_price"
                                                                        label="Precio Venta" type="number" min="0"
                                                                        required>
                                                                    </v-text-field>
                                                                </v-col>
                                                                <v-col cols="4" sm="2" md="2">

                                                                    <template>
                                                                        <div class="text-center">
                                                                            <v-dialog v-model="dialog2" width="300">
                                                                                <template
                                                                                    v-slot:activator="{ on, attrs }">
                                                                                    <v-btn color="#FFB74D" small
                                                                                        class="ma-2 white--text" fab
                                                                                        v-bind="attrs" v-on="on">
                                                                                        <v-icon dark>
                                                                                            mdi-book-plus
                                                                                        </v-icon>
                                                                                    </v-btn>
                                                                                </template>
                                                                                <v-card>
                                                                                    <v-card-title
                                                                                        class="text-h5 grey lighten-2">
                                                                                        LISTA DE PRECIOS
                                                                                    </v-card-title>
                                                                                    <v-card-text>
                                                                                        <v-container>
                                                                                            <v-row>
                                                                                                <v-col cols="12" md="6">
                                                                                                    <label
                                                                                                        for="Precio Menor">Precio
                                                                                                        Menor</label>
                                                                                                    <v-text-field
                                                                                                        type="number"
                                                                                                        :value="datosProducto.price_by_unit"
                                                                                                        disabled dense>
                                                                                                    </v-text-field>
                                                                                                </v-col>

                                                                                                <v-col cols="12" md="2">
                                                                                                    <template>
                                                                                                        <v-btn
                                                                                                            color="#43A047"
                                                                                                            small
                                                                                                            class="ma-2 white--text"
                                                                                                            fab>
                                                                                                            <v-icon
                                                                                                                dark>
                                                                                                                mdi-cash-plus
                                                                                                            </v-icon>
                                                                                                        </v-btn>
                                                                                                    </template>
                                                                                                </v-col>
                                                                                                <v-col cols="12" md="6">
                                                                                                    <label
                                                                                                        for="Precio Mayor">Precio
                                                                                                        Mayor</label>
                                                                                                    <v-text-field
                                                                                                        type="number"
                                                                                                        :value="datosProducto.wholesale_price"
                                                                                                        disabled dense>
                                                                                                    </v-text-field>
                                                                                                </v-col>

                                                                                                <v-col cols="12" md="2">
                                                                                                    <template>
                                                                                                        <v-btn
                                                                                                            color="#43A047"
                                                                                                            small
                                                                                                            class="ma-2 white--text"
                                                                                                            fab>
                                                                                                            <v-icon
                                                                                                                dark>
                                                                                                                mdi-cash-plus
                                                                                                            </v-icon>
                                                                                                        </v-btn>
                                                                                                    </template>

                                                                                                </v-col>
                                                                                                <v-col cols="12" md="6">
                                                                                                    <label
                                                                                                        for="Precio Especial">Precio
                                                                                                        Especial</label>
                                                                                                    <v-text-field
                                                                                                        type="number"
                                                                                                        :value="datosProducto.special_price"
                                                                                                        disabled dense>
                                                                                                    </v-text-field>
                                                                                                </v-col>

                                                                                                <v-col cols="12" md="2">
                                                                                                    <template>
                                                                                                        <v-btn
                                                                                                            color="#43A047"
                                                                                                            small
                                                                                                            class="ma-2 white--text"
                                                                                                            fab>
                                                                                                            <v-icon
                                                                                                                dark>
                                                                                                                mdi-cash-plus
                                                                                                            </v-icon>
                                                                                                        </v-btn>
                                                                                                    </template>

                                                                                                </v-col>
                                                                                            </v-row>
                                                                                        </v-container>
                                                                                    </v-card-text>

                                                                                    <v-divider></v-divider>

                                                                                    <v-card-actions>
                                                                                        <v-spacer></v-spacer>
                                                                                        <v-btn color="red" text
                                                                                            @click="">
                                                                                            Cerrar
                                                                                        </v-btn>
                                                                                    </v-card-actions>
                                                                                </v-card>
                                                                            </v-dialog>
                                                                        </div>
                                                                    </template>
                                                                </v-col>
                                                                <v-col cols="12" sm="4" md="3">
                                                                    <v-text-field v-model="editedItem.discount"
                                                                        label="Descuento" min="0" type="number"
                                                                        required>
                                                                    </v-text-field>
                                                                </v-col>
                                                                <v-col cols="12" sm="6" md="6">
                                                                    <v-autocomplete color="primary"
                                                                        v-model="affectation_igvs"
                                                                        :items="affectationIgvs" item-text="description"
                                                                        item-value="description" label=" Afectación IGV"
                                                                        auto-select-first hide-no-data hide-selected
                                                                        placeholder="Seleccione Afectación IGV"
                                                                        persistent-hint required return-object>
                                                                    </v-autocomplete>
                                                                </v-col>
                                                                <v-col cols="12" sm="4" md="4">
                                                                    <v-btn color="primary" class="ma-2 white--text" fab
                                                                        small @click="save">
                                                                        <v-icon dark>
                                                                            mdi-checkbox-multiple-marked-circle
                                                                        </v-icon>
                                                                    </v-btn>
                                                                </v-col>
                                                            </v-row>
                                                        </v-container>
                                                    </v-card-text>

                                                    <v-divider></v-divider>

                                                    <v-card-actions>
                                                        <v-spacer></v-spacer>
                                                        <v-btn color="primary" text @click="this.close">
                                                            Cerrar
                                                        </v-btn>
                                                    </v-card-actions>
                                                </v-card>
                                            </v-dialog>
                                        </div>
                                        <v-col>
                                            <v-data-table :headers="headers" :items="desserts" sort-by="name"
                                                class="elevation-2" :search="search" fixed-header :items-per-page="5">
                                                <template v-slot:top>
                                                    <v-toolbar flat>
                                                        <v-toolbar-title>Carrito de Ventas</v-toolbar-title>
                                                        <v-divider class="mx-4" inset vertical></v-divider>
                                                        <v-spacer></v-spacer>
                                                        <v-spacer></v-spacer>
                                                        <v-text-field v-model="search" append-icon="mdi-magnify"
                                                            label="Buscar" single-line hide-details>
                                                        </v-text-field>
                                                        <!-- Mensaje de confirmacion de borrado de Unidad Medida -->
                                                        <v-dialog v-model="dialogDelete" max-width="500px">
                                                            <v-card>
                                                                <v-card-title class="text-h5">¿Está seguro de querer
                                                                    borrar el
                                                                    producto?</v-card-title>
                                                                <v-card-actions>
                                                                    <v-spacer></v-spacer>
                                                                    <v-btn color="red darken-1" text
                                                                        @click="closeDelete">Cancelar</v-btn>
                                                                    <v-btn color="blue darken-1" text
                                                                        @click="deleteItemConfirm">Aceptar</v-btn>
                                                                    <v-spacer></v-spacer>
                                                                </v-card-actions>
                                                            </v-card>
                                                        </v-dialog>
                                                    </v-toolbar>
                                                </template>
                                                <!-- Acciones de la tabla -->
                                                <template v-slot:item.actions="{ item }">
                                                    <v-icon small class="mr-2" @click="editItem(item)">
                                                        mdi-pencil
                                                    </v-icon>
                                                    <v-icon small @click="deleteItem(item)"> mdi-delete </v-icon>
                                                </template>
                                            </v-data-table>
                                        </v-col>
                                    </template>
                                </v-row>
                            </v-container>
                        </v-card-text>
                        <v-divider></v-divider>
                        <v-card-actions>
                            <v-spacer></v-spacer>
                            <v-btn color="red" @click="" dark>
                                Cancelar
                            </v-btn>
                            <template>
                                <div class="text-center">
                                    <v-dialog v-model="dialog1" width="450">
                                        <template v-slot:activator="{ on, attrs }">
                                            <v-btn color="primary" dark v-bind="attrs" v-on="on">
                                                Confirmar
                                            </v-btn>
                                        </template>
                                        <v-card>
                                            <v-card-title class="text-h5 grey lighten-2">
                                                DATOS DE VENTA
                                            </v-card-title>
                                            <v-card-text>
                                                <v-container>
                                                    <v-row>
                                                        <v-col cols="12" md="6">
                                                            <v-text-field label="Total" type="number" required>
                                                            </v-text-field>
                                                        </v-col>

                                                        <v-col cols="12" md="6">
                                                            <v-text-field label="Monto a pagar" type="number" required>
                                                            </v-text-field>
                                                        </v-col>
                                                    </v-row>
                                                </v-container>
                                            </v-card-text>

                                            <v-divider></v-divider>

                                            <v-card-actions>
                                                <v-spacer></v-spacer>
                                                <v-btn color="primary" text @click="">
                                                    Pagar
                                                </v-btn>
                                            </v-card-actions>
                                        </v-card>
                                    </v-dialog>
                                </div>
                            </template>
                        </v-card-actions>
                    </v-card>
                </v-flex>
            </v-layout>
        </v-container>

    </admin-layout>
</template>

<script>
import AdminLayout from '@/Layouts/AdminLayout'

export default {
    props: [
        'company',
        'proofPayments',
        'documents',
        'customers',
        'paymentMethods',
        'coins',
        'nroComprobantes',
        'nroBoletas',
        'nroFacturas',
        'presentations',
        'affectationIgvs',
        'products',
        'exchange_rate'
    ],
    components: {
        AdminLayout,
    },
    data() {
        return {
            isEditing: null,
            dialog: false,
            dialog1: false,
            dialog2: false,
            quotasAdd: false,
            dialogDelete: false,
            date: (new Date(Date.now() - (new Date()).getTimezoneOffset() * 60000)).toISOString().substr(0, 10),
            search: '',
            tipoComprobate: this.proofPayments[0],
            datosProducto: '',
            datosCliente: '',
            datosProducto: '',
            tipoDoc: this.documents[0],
            metodoPago: this.paymentMethods[0],
            affectation_igvs: this.affectationIgvs[0],
            totalventas:'',

            form: {
                companies_id: this.$page.props.user.companies_id,
                providers_id: '',
                payment_methods_id: '',
                proof_payments_id: '',
                voucher_number: '',
                exchange_rate: this.exchange_rate,
                date: (new Date(Date.now() - (new Date()).getTimezoneOffset() * 60000)).toISOString().substr(0, 10),
                coins_id: '',
                state: '',
                products: null,
                total: 0,
                tipoComprobate: "",
            },
            headers: [
                { text: 'PRODUCTO', value: 'name' },
                { text: 'PRESENTACIÓN', value: 'presentation' },
                { text: 'EQUIVALENCIA', value: 'equivalence' },
                { text: 'CANTIDAD', value: 'quantity' },
                { text: 'PRECIO', value: 'sale_price' },
                { text: 'DESCUENTO', value: 'discount' },
                { text: 'AFECTACIÓN IGV', value: 'affectation_igvs' },
                { text: 'SUB TOTAL', value: 'total' },
                { text: 'ACCIONES', value: 'actions', sortable: false },
            ],
            editedIndex: -1,
            desserts: [],
            editedItem: {
                id: '',
                name: '',
                presentation: '',
                equivalence: '',
                quantity: '',
                sale_price: '',
                discount: '',
                affectation_igvs: '',
                total: '',
            },
            defaultItem: {
                id: '',
                name: '',
                presentation: '',
                cantidad: '',
                amount: '',
                sale_price: '',
                discount: '',
                affectation_igvs: '',
                total: '',
            },
        }
    },
    computed: {
        formTitle() {
            return this.editedIndex === -1 ? 'Agregar Productos' : 'Editar Producto'
        }
    },
    watch: {
        dialog(val) {
            val || this.close();
        },
        dialogDelete(val) {
            val || this.closeDelete();
        },
    },
    created() {
        this.initialize()
    },
    methods: {
        initialize() {
            this.desserts = []
        },
        editItem(item) {
            this.editedIndex = this.desserts.indexOf(item);
            this.editedItem = Object.assign({}, item);
            this.dialog = true;
        },

        deleteItem(item) {
            this.editedIndex = this.desserts.indexOf(item);
            this.editedItem = Object.assign({}, item);
            this.dialogDelete = true;
        },
        deleteItemConfirm() {
            this.desserts.splice(this.editedIndex, 1);
            this.closeDelete();

            // reducir el monto total de la venta
            this.form.total -= this.editedItem.total
        },
        close() {
            this.dialog = false;
            this.$nextTick(() => {
                this.editedItem = Object.assign({}, this.defaultItem);
                this.editedIndex = -1;
            });
        },
        closeDelete() {
            this.dialogDelete = false;
            this.$nextTick(() => {
                this.editedItem = Object.assign({}, this.defaultItem);
                this.editedIndex = -1;
            });
        },
        save() {
            if (this.editedIndex > -1) {


                // Actualizando precios segun compra
                this.form.total -= this.editedItem.total //quitando precio del producto
                this.editedItem.total = this.editedItem.purchase_price * this.editedItem.amount // calculando nuevo precio
                this.form.total += this.editedItem.total // agregando el nuevo precio
                this.datosProducto = null; // reseteando variable 

                Object.assign(this.desserts[this.editedIndex], this.editedItem)

            } else {

                // agregar producto a editedItem
                if (this.datosProducto == null) { // Comprobando se dejo campo vacio
                    this.snackbar_text = 'Complete los campos';
                    this.snackbar_color = 'red';
                    this.snackbar = true;

                    return;
                }

                this.editedItem.id = this.datosProducto.id
                this.form.tipoComprobate = this.tipoComprobate.serie
                this.editedItem.name = this.datosProducto.name
                this.editedItem.total = (this.datosProducto.sale_price * this.editedItem.quantity) - this.editedItem.discount
                this.form.total += this.editedItem.total
                this.datosProducto = null;
                // fin agregar producto a editedItem

                this.desserts.push(this.editedItem)
            }
            this.close()
        },
    },
}
</script>