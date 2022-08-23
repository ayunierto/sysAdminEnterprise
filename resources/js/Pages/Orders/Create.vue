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
                                        <v-text-field label="Fecha" v-model="form.date" readonly>
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
                                        <v-text-field label="Dirección" :value="datosCliente.address" readonly>
                                        </v-text-field>
                                    </v-col>
                                    <v-col cols="12">
                                        <h3>DETALLE DE VENTA</h3>
                                    </v-col>
                                    <v-col cols="9" sm="3" md="3">
                                        <v-select :items="paymentMethods" label="Contado/crédito"
                                            item-text="description" item-value="description" v-model="metodoPago"
                                            return-object>
                                        </v-select>
                                    </v-col>
                                    <!-- Dialog Quotas -->
                                    <v-col cols="2" sm="1" md="1" v-if="metodoPago.description == 'Credito'">
                                        <v-container>
                                            <v-layout row justify-center>
                                                <v-dialog v-model="quotasAdd" persistent max-width="400">
                                                    <template v-slot:activator="{ on, attrs }">
                                                        <v-btn color="lime darken-2" small class="ma-2 white--text" fab
                                                            v-bind="attrs" v-on="on">
                                                            <v-icon dark>
                                                                mdi-bank-plus
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
                                    <!-- Fin Dialog Quotas -->
                                    <v-col cols="12" sm="3" md="3">
                                        <v-select :items="coins" label="Moneda" item-text="code" item-value="code"
                                            v-model="tipoMoneda" return-object></v-select>
                                    </v-col>
                                    <v-col cols="12" sm="2" md="2">
                                        <v-text-field label="Tipo Cambio" type="number" v-model="form.exchange_rate"
                                            min="0" outlined>
                                        </v-text-field>
                                    </v-col>
                                    <v-col cols="12" sm="2" md="2">
                                        <v-text-field v-if="tipoMoneda.code == 'PEN'" label="Total" type="number"
                                            v-model="form.total" outlined prefix="S/" readonly>
                                        </v-text-field>
                                        <v-text-field v-if="tipoMoneda.code == 'USD'" label="Total" type="number"
                                            v-model="form.total" outlined prefix="$" readonly>
                                        </v-text-field>
                                    </v-col>
                                    <!-- Dialog add Productos a carrito -->
                                    <v-col cols="12" sm="1" md="1">
                                        <template>
                                            <div class="text-center">
                                                <v-dialog v-model="dialogAddProducts" width="600" persistent>
                                                    <template v-slot:activator="{ on, attrs }">
                                                        <v-btn color="primary" class="white--text" fab v-bind="attrs"
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
                                                                <div class="text-center">
                                                                    <v-row>
                                                                        <v-col cols="12" sm="6" md="6">
                                                                            <v-autocomplete color="primary"
                                                                                :items="products"
                                                                                v-model="editedItem.datosProducto"
                                                                                item-text="name" item-value.id="id"
                                                                                label="Producto" auto-select-first
                                                                                hide-no-data hide-selected
                                                                                placeholder="Seleccione Producto"
                                                                                persistent-hint return-object required>
                                                                            </v-autocomplete>
                                                                        </v-col>
                                                                        <v-col cols="12" sm="6" md="6">
                                                                            <v-autocomplete color="primary"
                                                                                v-model="editedItem.datosPresentation"
                                                                                :items="presentations" item-text="name"
                                                                                item-value="id" label="Presentación"
                                                                                auto-select-first hide-no-data
                                                                                hide-selected
                                                                                placeholder="Seleccione Presentación"
                                                                                persistent-hint return-object required>
                                                                            </v-autocomplete>
                                                                        </v-col>
                                                                        <v-col cols="12" sm="6" md="3">
                                                                            <v-text-field v-model="editedItem.quantity"
                                                                                label="Cantidad" type="number" min="0"
                                                                                required>
                                                                            </v-text-field>
                                                                        </v-col>
                                                                        <v-col cols="9" sm="6" md="3">
                                                                            <v-text-field
                                                                                v-model="editedItem.datosProducto.sale_price"
                                                                                id="precioVenta" label="Precio Venta"
                                                                                type="number" min="0" readonly>
                                                                            </v-text-field>
                                                                        </v-col>
                                                                        <v-col cols="2" sm="2" md="2">
                                                                            <!--Dialog Lista de Precios -->
                                                                            <template>
                                                                                <div class="text-center">
                                                                                    <v-dialog v-model="dialogPrecios"
                                                                                        max-width="250">
                                                                                        <template
                                                                                            v-slot:activator="{ on, attrs }">
                                                                                            <v-btn color="#546E7A" small
                                                                                                class="ma-2 white--text"
                                                                                                fab v-bind="attrs"
                                                                                                v-on="on">
                                                                                                <v-icon dark>
                                                                                                    mdi-filter-variant
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
                                                                                                        <v-col cols="9">
                                                                                                            <v-text-field
                                                                                                                label="Precio Menor"
                                                                                                                type="number"
                                                                                                                v-model="editedItem.datosProducto.price_by_unit"
                                                                                                                readonly
                                                                                                                solo>
                                                                                                            </v-text-field>
                                                                                                        </v-col>
                                                                                                        <v-col cols="2">
                                                                                                            <v-btn
                                                                                                                color="amber accent-3"
                                                                                                                small
                                                                                                                class="ma-2 white--text"
                                                                                                                fab>
                                                                                                                <v-icon
                                                                                                                    dark>
                                                                                                                    mdi-bookmark-check
                                                                                                                </v-icon>
                                                                                                            </v-btn>
                                                                                                        </v-col>
                                                                                                        <v-col cols="9">
                                                                                                            <v-text-field
                                                                                                                label="Precio Mayor"
                                                                                                                type="number"
                                                                                                                v-model="editedItem.datosProducto.wholesale_price"
                                                                                                                readonly
                                                                                                                solo>
                                                                                                            </v-text-field>
                                                                                                        </v-col>
                                                                                                        <v-col cols="2">
                                                                                                            <v-btn
                                                                                                                color="amber accent-3"
                                                                                                                small
                                                                                                                class="ma-2 white--text"
                                                                                                                fab>
                                                                                                                <v-icon
                                                                                                                    dark>
                                                                                                                    mdi-bookmark-check
                                                                                                                </v-icon>
                                                                                                            </v-btn>
                                                                                                        </v-col>
                                                                                                        <v-col cols="9">
                                                                                                            <v-text-field
                                                                                                                label="Precio Especial"
                                                                                                                type="number"
                                                                                                                v-model="editedItem.datosProducto.special_price"
                                                                                                                readonly
                                                                                                                solo>
                                                                                                            </v-text-field>
                                                                                                        </v-col>
                                                                                                        <v-col cols="2">
                                                                                                            <v-btn
                                                                                                                color="amber accent-3"
                                                                                                                small
                                                                                                                class="ma-2 white--text"
                                                                                                                fab>
                                                                                                                <v-icon
                                                                                                                    dark>
                                                                                                                    mdi-bookmark-check
                                                                                                                </v-icon>
                                                                                                            </v-btn>
                                                                                                        </v-col>
                                                                                                    </v-row>
                                                                                                </v-container>
                                                                                            </v-card-text>
                                                                                        </v-card>
                                                                                    </v-dialog>
                                                                                </div>
                                                                            </template>
                                                                            <!--Dialog Lista de Precios end-->
                                                                        </v-col>
                                                                        <v-col cols="12" sm="4" md="3">
                                                                            <v-text-field v-model="editedItem.discount"
                                                                                label="Descuento" min="0" type="number"
                                                                                required>
                                                                            </v-text-field>
                                                                        </v-col>
                                                                        <v-col cols="12" sm="6" md="6">
                                                                            <v-autocomplete color="primary"
                                                                                v-model="editedItem.datosAffectationIgv"
                                                                                :items="affectationIgvs"
                                                                                item-text="description"
                                                                                item-value="code"
                                                                                label=" Afectación IGV"
                                                                                auto-select-first hide-no-data
                                                                                hide-selected
                                                                                placeholder="Seleccione Afectación IGV"
                                                                                persistent-hint return-object required>
                                                                            </v-autocomplete>
                                                                        </v-col>
                                                                        <v-col cols="12" sm="4" md="4">
                                                                            <v-btn color="primary" class="white--text"
                                                                                fab small @click="save">
                                                                                <v-icon dark>
                                                                                    mdi-checkbox-multiple-marked-circle
                                                                                </v-icon>
                                                                            </v-btn>
                                                                        </v-col>
                                                                    </v-row>
                                                                </div>
                                                            </v-container>

                                                        </v-card-text>

                                                        <v-divider></v-divider>

                                                        <v-card-actions>
                                                            <v-spacer></v-spacer>
                                                            <v-btn color="primary" text @click="close">
                                                                Cerrar
                                                            </v-btn>
                                                        </v-card-actions>
                                                    </v-card>
                                                </v-dialog>
                                            </div>
                                        </template>
                                    </v-col>
                                    <!-- Fin Dialog add Productos a carrito -->
                                    <v-col cols="12" sm="5">
                                        <v-textarea filled label="Comentario" type="text" rows="1" class="mx-2">
                                        </v-textarea>
                                    </v-col>
                                    <!-- Tabla Carrito -->
                                    <v-col cols="12">
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
                                                                <v-btn color="red darken-1" text @click="closeDelete">
                                                                    Cancelar</v-btn>
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
                                    <!-- Fin Tabla Carrito -->
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
                                    <v-dialog v-model="dialogPago" width="450">
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
                                                            <v-text-field label="Total" v-model="form.total"
                                                                type="number" readonly>
                                                            </v-text-field>
                                                        </v-col>

                                                        <v-col cols="12" md="6">
                                                            <v-text-field label="Monto a pagar" :value="form.total"
                                                                type="number" required>
                                                            </v-text-field>
                                                        </v-col>
                                                    </v-row>
                                                </v-container>
                                            </v-card-text>

                                            <v-divider></v-divider>

                                            <v-card-actions>
                                                <v-spacer></v-spacer>
                                                <v-btn color="primary" text @click="close">
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
            dialogAddProducts: false,
            dialogPago: false,
            dialogPrecios: false,
            quotasAdd: false,
            dialogDelete: false,
            search: '',
            tipoComprobate: this.proofPayments[0],
            datosCliente: '',
            tipoDoc: this.documents[0],
            metodoPago: this.paymentMethods[0],
            tipoMoneda: this.coins[0],

            form: {
                companies_id: this.$page.props.user.companies_id,
                proof_payments_id: '',
                voucher_number: '',
                date: (new Date(Date.now() - (new Date()).getTimezoneOffset() * 60000)).toISOString().substr(0, 10),
                documents_id: '',
                payment_methods_id: '',
                coins_id: '',
                exchange_rate: this.exchange_rate,
                total: 0,
            },
            headers: [
                { text: 'PRODUCTO', value: 'productName' },
                { text: 'PRESENTACIÓN', value: 'presentationName' },
                { text: 'EQUIVALENCIA', value: 'equivalence' },
                { text: 'CANTIDAD', value: 'quantity' },
                { text: 'PRECIO', value: 'sale_price' },
                { text: 'DESCUENTO', value: 'discount' },
                { text: 'AFECTACIÓN IGV', value: 'igvAffectationDescription' },
                { text: 'SUB TOTAL', value: 'total' },
                { text: 'ACCIONES', value: 'actions', sortable: false },
            ],
            editedIndex: -1,
            desserts: [],
            editedItem: {
                datosProducto: '',
                productId: '',
                productName: '',
                sale_price: '',
                price_by_unit: '',
                wholesale_price: '',
                special_price: '',
                datosPresentation: this.presentations[0],
                presentationId: '',
                presentationName: '',
                equivalence: '',
                quantity: 1,
                discount: 0,
                datosAffectationIgv: this.affectationIgvs[0],
                igvAffectationId: '',
                igvAffectationDescription: '',
                total: 0,
            },
            defaultItem: {
                datosProducto: '',
                productId: '',
                productName: '',
                sale_price: '',
                price_by_unit: '',
                wholesale_price: '',
                special_price: '',
                datosPresentation: this.presentations[0],
                presentationId: '',
                presentationName: '',
                equivalence: '',
                quantity: 1,
                discount: 0,
                datosAffectationIgv: this.affectationIgvs[0],
                igvAffectationId: '',
                igvAffectationDescription: '',
                total: 0,
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
            this.dialogAddProducts = true;
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
            this.dialogAddProducts = false;
            this.dialogPago = false;
            this.editedItem = Object.assign({}, this.defaultItem)
            this.editedIndex = -1
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
                this.editedItem.total = (this.editedItem.id.sale_price * this.editedItem.quantity) - this.editedItem.discount// calculando nuevo precio
                this.form.total += this.editedItem.total // agregando el nuevo precio

                Object.assign(this.desserts[this.editedIndex], this.editedItem)

            } else {

                // agregar producto a editedItem
                // if (this.datosProducto == null) { // Comprobando se dejo campo vacio
                //     this.snackbar_text = 'Complete los campos';
                //     this.snackbar_color = 'red';
                //     this.snackbar = true;
                //     return;
                // }

                // Datos tabla
                this.editedItem.productName = this.editedItem.datosProducto.name
                this.editedItem.productId = this.editedItem.datosProducto.id
                this.editedItem.sale_price = this.editedItem.datosProducto.sale_price
                this.editedItem.price_by_unit = this.editedItem.datosProducto.price_by_unit
                this.editedItem.wholesale_price = this.editedItem.datosProducto.wholesale_price
                this.editedItem.special_price = this.editedItem.datosProducto.special_price
                this.editedItem.presentationName = this.editedItem.datosPresentation.name
                this.editedItem.equivalence = this.editedItem.datosPresentation.equivalence
                this.editedItem.igvAffectationDescription = this.editedItem.datosAffectationIgv.description
                this.editedItem.igvAffectationId = this.editedItem.datosAffectationIgv.id
                this.editedItem.total = (this.editedItem.datosProducto.sale_price * this.editedItem.quantity) - this.editedItem.discount

                // Datos Formulario
                this.form.proof_payments_id = this.tipoComprobate.id
                if (this.tipoComprobate.name == 'Comprobante') {
                    this.form.voucher_number = this.nroComprobantes
                } if (this.tipoComprobate.name == 'Factura') {
                    this.form.voucher_number = this.nroFacturas
                } if (this.tipoComprobate.name == 'Boleta de Venta') {
                    this.form.voucher_number = this.nroBoletas
                }
                this.form.documents_id = this.tipoDoc.id
                this.form.payment_methods_id = this.metodoPago.id
                this.form.coins_id = this.tipoMoneda.id
                this.form.total += this.editedItem.total
                // fin agregar producto a editedItem

                this.desserts.push(this.editedItem)
            }
            this.$nextTick(() => {
                this.editedItem = Object.assign({}, this.defaultItem)
            })
        },
    },
}
</script>