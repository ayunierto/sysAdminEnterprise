<template>
    <admin-layout>

        <v-alert type="success" border="left" dismissible v-if="$page.props.flash.message">
            {{ $page.props.flash.message }}
        </v-alert>

        <!-- Alertas -->
        <div v-if="$page.props.errorBags.default"
            style="position: absolute; right: 10px; top: 20px; z-index:3; opacity: 0.9;">
            <div v-for="item in Object.keys($page.props.errors)" :key="item">
                <v-alert type="warning" border="left" dismissible>
                    {{ $page.props.errors[item] }}
                </v-alert>
            </div>
        </div>
        <!-- Fin de Alertas -->

        <v-card class="overflow-hidden" color="white" elevation-10>
            <v-toolbar flat color="#ECEFF1">
                <v-toolbar-title class="font-weight-light">
                    Nueva Compra
                </v-toolbar-title>
            </v-toolbar>
            <v-card-text>
                <v-container>
                    <v-row>
                        <v-col cols="12" sm="4" md="3">
                            <v-select dense hint="Seleccione comprobante" v-model="datosComprobante"
                                :items="proof_payments" item-text="name" item-value="code"
                                label="Seleccione comprobante" outlined return-object></v-select>
                        </v-col>

                        <v-col cols="12" sm="4" md="3">
                            <v-text-field dense label="Nro Comprobante" v-model="form.voucher_number"
                                hint="Nro Comprobante" outlined></v-text-field>
                        </v-col>

                        <v-col cols="12" sm="6" md="3">
                            <v-text-field type="date" v-model="form.date" label="Fecha" outlined dense>
                            </v-text-field>
                        </v-col>

                        <v-col cols="12">
                            <h3>DETALLE DE COMPRA</h3>
                        </v-col>
                        <v-col cols="12" sm="4" md="3">
                            <v-autocomplete color="primary" v-model="datosProveedor" :items="providers" item-text="name"
                                item-value="id" label="Seleccione Proveedor" auto-select-first hide-no-data
                                hide-selected placeholder="Buscar Proveedor" persistent-hint return-object required
                                outlined dense>
                            </v-autocomplete>
                        </v-col>

                        <v-col cols="12" sm="4" md="2">
                            <v-select :items="payment_methods" v-model="datosMetPago" dense hint="Contado/crédito"
                                item-text="description" item-value="id" label="Contado/crédito" outlined return-object>
                            </v-select>
                        </v-col>

                        <v-col cols="12" sm="4" md="3">
                            <v-select dense hint="Moneda" v-model="datosMoneda" :items="coins" item-text="code"
                                item-value="id" label="Moneda" outlined return-object></v-select>
                        </v-col>

                        <v-col cols="12" sm="4" md="2">
                            <v-text-field dense label="Tipo de cambio" v-model="form.exchange_rate" required outlined>
                            </v-text-field>
                        </v-col>

                        <v-col cols="12" sm="4" md="2">
                            <v-text-field dense label="Total" v-model="form.total" required readonly outlined>
                            </v-text-field>
                        </v-col>
                        <v-col cols="12" sm="5">
                            <v-textarea dense filled label="Comentario" type="text" rows="1" outlined
                                v-model="form.description">
                            </v-textarea>
                        </v-col>

                        <!-- Carrito Compras-->
                        <v-col cols="12">
                            <v-data-table :headers="headers" :items="desserts" sort-by="calories" class="elevation-1">
                                <template v-slot:[`item.full_name`]="{ item }">{{ item.datosProducto.name }}
                                </template>
                                <template v-slot:[`item.presentation`]="{ item }">{{ item.presentationName
                                }}: {{ item.equivalence }} UND</template>
                                <template v-slot:top>
                                    <v-toolbar flat>
                                        <v-toolbar-title>CARRITO DE COMPRAS</v-toolbar-title>
                                        <v-divider class="mx-4" inset vertical></v-divider>
                                        <v-spacer></v-spacer>
                                        <v-dialog v-model="dialogAddProducts" max-width="600" persistent>
                                            <template v-slot:activator="{ on, attrs }">
                                                <v-btn color="primary" dark class="mb-2" v-bind="attrs" v-on="on">
                                                    Agregar producto
                                                </v-btn>
                                            </template>
                                            <v-card>
                                                <v-card-title class="text-h5 grey lighten-2">
                                                    {{ formTitle }}
                                                </v-card-title>
                                                <v-card-text>
                                                    <v-container>
                                                        <v-row>
                                                            <v-col cols="7" sm="7" md="7">
                                                                <v-radio-group row v-model="editedItem.igv">
                                                                    <v-radio color="red" label="IGV Incluido"
                                                                        value='IGV Incluido'>
                                                                    </v-radio>
                                                                    <v-radio color="primary" label="Mas IGV"
                                                                        value='Mas IGV'>
                                                                    </v-radio>
                                                                </v-radio-group>
                                                            </v-col>
                                                            <v-col cols="1" sm="1" md="1">
                                                                <v-divider class="mx-4" vertical></v-divider>
                                                            </v-col>
                                                            <v-col cols="4" sm="4" md="4">
                                                                <v-switch v-model="editedItem.newMark"
                                                                    label="Nueva Marca">
                                                                </v-switch>
                                                            </v-col>
                                                            <v-col cols="12" sm="6" md="6">
                                                                <v-autocomplete :items="products"
                                                                    :item-text="getProductText"
                                                                    v-model="editedItem.datosProducto" color="primary"
                                                                    id="inputProducts" item-value="id" label="Producto"
                                                                    auto-select-first hide-no-data hide-selected
                                                                    placeholder="Seleccione Producto" persistent-hint
                                                                    return-object required outlined dense
                                                                    @change="changeProduct"
                                                                    :hint="editedItem.datosProducto != '' && editedItem.newMark == 0 ? 'Stock: ' + editedItem.datosProducto.stock : 'Stock: 0'">
                                                                </v-autocomplete>
                                                            </v-col>
                                                            <v-col cols="12" sm="6" md="6" v-if="editedItem.newMark == 0">
                                                                <v-autocomplete :items="marks"
                                                                    v-model="editedItem.marks" color="primary"
                                                                    item-text="name" item-value="id" label="Marca"
                                                                    auto-select-first hide-no-data hide-selected
                                                                    placeholder="Seleccione Marca" persistent-hint
                                                                    return-object required outlined dense readonly>
                                                                </v-autocomplete>
                                                            </v-col>
                                                            <v-col cols="12" sm="6" md="6" v-if="editedItem.newMark == 1">
                                                                <v-text-field label="Marca"
                                                                    v-model="editedItem.newMarca" required outlined
                                                                    dense>
                                                                </v-text-field>
                                                            </v-col>
                                                            <v-col cols="12" sm="6" md="6">
                                                                <v-autocomplete :items="presentations"
                                                                    v-model="editedItem.datosPresentation"
                                                                    color="primary" :item-text="getPresentationText"
                                                                    item-value="id" label="Presentación"
                                                                    auto-select-first hide-no-data hide-selected
                                                                    placeholder="Seleccione Presentación"
                                                                    persistent-hint return-object required outlined
                                                                    dense @change="changePresentation">
                                                                </v-autocomplete>
                                                            </v-col>
                                                            <v-col cols="12" sm="6" md="3">
                                                                <v-text-field label="Cantidad"
                                                                    v-model="editedItem.amount" type="number" min="0"
                                                                    required outlined dense>
                                                                </v-text-field>
                                                            </v-col>

                                                            <v-col cols="12" sm="6" md="3">
                                                                <v-text-field label="Precio Unitario"
                                                                    v-model="editedItem.purchase_price" type="number"
                                                                    min="0" required outlined dense>
                                                                </v-text-field>
                                                            </v-col>
                                                            <v-col cols="12" sm="6" md="3">
                                                                <v-text-field label="Costo Transporte"
                                                                    v-model="editedItem.transporte" type="number"
                                                                    min="0" outlined dense></v-text-field>
                                                            </v-col>

                                                            <!-- MONEDA DÓLAR -->
                                                            <!--Calcular valor unitario con o Mas IGV incluido-->
                                                            <v-col cols="12" sm="6" md="3" v-if="datosMoneda.code == 'USD' && editedItem.igv == 'IGV Incluido'
                                                            && form.exchange_rate != '' && editedItem.purchase_price != '' &&
                                                            form.exchange_rate > 0 && editedItem.purchase_price > 0"
                                                                v-show="true">
                                                                <v-text-field label="Precio S/."
                                                                    :value="(editedItem.purchase_price * form.exchange_rate) + (editedItem.transporte * form.exchange_rate / editedItem.amount)"
                                                                    type="number" readonly outlined dense>
                                                                </v-text-field>
                                                            </v-col>
                                                            <v-col cols="12" sm="6" md="3" v-if="datosMoneda.code == 'USD' && editedItem.igv == 'Mas IGV'
                                                            && form.exchange_rate != '' && editedItem.purchase_price != '' &&
                                                            form.exchange_rate > 0 && editedItem.purchase_price > 0"
                                                                v-show="true">
                                                                <v-text-field label="Precio S/. +IGV"
                                                                    :value="(editedItem.purchase_price * form.exchange_rate + ((editedItem.purchase_price * form.exchange_rate) * 0.18)) + (editedItem.transporte * form.exchange_rate / editedItem.amount)"
                                                                    type="number" readonly outlined dense>
                                                                </v-text-field>
                                                            </v-col>

                                                            <!-- MONEDA SOLES -->
                                                            <!-- Calcular precio en soles +igv -->
                                                            <v-col cols="12" sm="6" md="3"
                                                                v-if="datosMoneda.code == 'PEN' && editedItem.igv == 'IGV Incluido' && editedItem.transporte > 0
                                                                && editedItem.purchase_price != '' && editedItem.purchase_price > 0" v-show="true">
                                                                <v-text-field label="Precio + Impuestos"
                                                                    :value="parseFloat(editedItem.purchase_price) + (editedItem.transporte / editedItem.amount)"
                                                                    type="number" readonly outlined dense>
                                                                </v-text-field>
                                                            </v-col>
                                                            <v-col cols="12" sm="6" md="3"
                                                                v-if="datosMoneda.code == 'PEN' && editedItem.igv == 'Mas IGV'
                                                                && editedItem.purchase_price != '' && editedItem.purchase_price > 0" v-show="true">
                                                                <v-text-field label="Precio + Impuestos"
                                                                    :value="(parseFloat(editedItem.purchase_price) + (editedItem.purchase_price * 0.18)) + (editedItem.transporte / editedItem.amount)"
                                                                    type="number" readonly outlined dense>
                                                                </v-text-field>
                                                            </v-col>

                                                            <v-col cols="12" sm="6" md="3">
                                                                <v-text-field label="Precio Venta S/."
                                                                    v-model="editedItem.sale_price" type="number"
                                                                    min="0" required outlined dense>
                                                                </v-text-field>
                                                            </v-col>
                                                        </v-row>
                                                    </v-container>

                                                </v-card-text>
                                                <!-- Acciones de tabla productos -->
                                                <v-card-actions>
                                                    <v-spacer></v-spacer>
                                                    <v-btn color="secondary" elevation="9" text @click="close">
                                                        Cerrar
                                                    </v-btn>
                                                    <v-btn
                                                        v-if="editedItem.amount > 0 && editedItem.purchase_price >= 0 && editedItem.datosProducto != ''"
                                                        v-show="true" color="primary" elevation="9" @click="save">
                                                        Añadir
                                                    </v-btn>
                                                </v-card-actions>
                                            </v-card>
                                        </v-dialog>
                                        <!-- Mensaje de confirmacion de borrado de Producto -->
                                        <v-dialog v-model="dialogDelete" max-width="500">
                                            <v-card>
                                                <v-card-title class="text-h5">¿Está seguro de querer
                                                    borrar el producto?
                                                </v-card-title>
                                                <v-card-actions>
                                                    <v-spacer></v-spacer>
                                                    <v-btn color="red darken-1" text @click="closeDelete">
                                                        Cancelar</v-btn>
                                                    <v-btn color="blue darken-1" text @click="deleteItemConfirm">Aceptar
                                                    </v-btn>
                                                    <v-spacer></v-spacer>
                                                </v-card-actions>
                                            </v-card>
                                        </v-dialog>

                                    </v-toolbar>
                                </template>
                                <template>
                                    <v-icon small class="mr-2">
                                        mdi-pencil
                                    </v-icon>
                                    <v-icon small>
                                        mdi-delete
                                    </v-icon>
                                </template>
                                <template v-slot:no-data>
                                    No hay productos en el carrito
                                </template>
                                <!-- Acciones de la tabla -->
                                <template v-slot:[`item.actions`]="{ item }">
                                    <v-icon small class="mr-2" @click="editItem(item)">
                                        mdi-pencil
                                    </v-icon>
                                    <v-icon small @click="deleteItem(item)">
                                        mdi-delete
                                    </v-icon>
                                </template>
                            </v-data-table>
                        </v-col>
                        <!-- Fin Carrito -->

                    </v-row>
                </v-container>
            </v-card-text>
            <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="red" dark elevation="9" @click="limpiarCarrito">
                    Cancelar
                </v-btn>
                &nbsp;
                <template>
                    <div class="text-center">
                        <v-dialog v-model="dialogPago" width="450">
                            <template v-slot:activator="{ on, attrs }">
                                <v-btn color="primary" dark v-bind="attrs" v-on="on" @click="asignarTotal">
                                    Confirmar
                                </v-btn>
                            </template>
                            <v-card>
                                <v-card-title class="text-h5 grey lighten-2">
                                    DATOS DE COMPRA
                                </v-card-title>
                                <v-card-text>
                                    <v-container>
                                        <v-row>
                                            <v-col cols="12" md="6">
                                                <v-text-field label="Total" v-model="form.total" type="number" readonly>
                                                </v-text-field>
                                            </v-col>

                                            <v-col cols="12" md="6">
                                                <v-text-field type="number" label="Monto a pagar" v-model="pagoCompra"
                                                    min="0" :max="this.form.total" required>
                                                </v-text-field>
                                            </v-col>
                                        </v-row>
                                    </v-container>
                                </v-card-text>

                                <v-divider></v-divider>

                                <v-card-actions>
                                    <v-spacer></v-spacer>
                                    <v-btn color="red" text @click="closeDialoPago">
                                        Cancelar
                                    </v-btn>
                                    <v-btn color="primary" text @click="send_form">
                                        Pagar
                                    </v-btn>
                                </v-card-actions>
                            </v-card>
                        </v-dialog>
                    </div>
                </template>

            </v-card-actions>
        </v-card>

        <v-snackbar v-model="snackbar" :color="snackbar_color" right top>
            {{ snackbar_text }}
        </v-snackbar>

        <!-- <pre>{{ editedItem }}</pre> -->
        <!-- <pre>{{ editedIndex }}</pre> -->
        <pre>{{ products }}</pre>

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
        'marks',
        'presentations',
        'cajaChica',
    ],
    components: {
        AdminLayout,
    },

    data() {
        return {
            dialogAddProducts: false,
            dialogDelete: false,
            dialogPago: false,
            pagoCompra: 0,
            snackbar: false,
            snackbar_text: '',
            snackbar_color: '',
            datosComprobante: this.proof_payments[0],
            datosProveedor: this.providers[0],
            datosMoneda: this.coins[0],
            datosMetPago: this.payment_methods[0],


            form: {
                companies_id: this.$page.props.user.companies_id,
                coins_id: '',
                proofPayments_id: '',
                providers_id: '',
                paymentMethods_id: '',
                exchange_rate: this.exchange_rate,
                date: (new Date(Date.now() - (new Date()).getTimezoneOffset() * 60000)).toISOString().substr(0, 10),
                voucher_number: '',
                description: '',
                products: '',
                totalPago: 0,
                total: 0,
                cajaChica: 0,
            },
            editedItem: {
                datosProducto: '',
                productId: '',
                productName: '',
                type: '',
                datosPresentation: this.presentations[0],
                marks: '',
                presentationId: this.presentations[0].id,
                presentationName: this.presentations[0].name,
                equivalence: this.presentations[0].equivalence,
                amount: 1,
                purchase_price: 0,
                precio_compra: 0,
                sale_price: 0,
                subTotal: 0,
                igv: 'IGV Incluido',
                transporte: 0,
                newMarca: '',
                newMark: 0,

            },
            defaultItem: {
                datosProducto: '',
                productId: '',
                productName: '',
                type: '',
                marks: '',
                datosPresentation: this.presentations[0],
                presentationId: this.presentations[0].id,
                presentationName: this.presentations[0].name,
                equivalence: this.presentations[0].equivalence,
                amount: 1,
                purchase_price: 0,
                precio_compra: 0,
                sale_price: 0,
                subTotal: 0,
                igv: 'IGV Incluido',
                transporte: 0,
                newMarca: '',
                newMark: 0,
            },
            headers: [
                { text: 'PRODUCTO', value: 'full_name' },
                { text: 'PRESENTACIÓN', value: 'presentation' },
                { text: 'CANTIDAD', value: 'amount' },
                { text: 'PRECIO COMPRA', value: 'purchase_price' },
                { text: 'TRANSPORTE', value: 'transporte' },
                { text: 'IGV', value: 'igv' },
                { text: 'SUB TOTAL', value: 'subTotal' },
                { text: 'ACCIONES', value: 'actions', sortable: false },
            ],
            editedIndex: -1,
            desserts: [],
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
        getProductText(item) {
            return `${item.warehouses_name} - ${item.name}`;
        },
        getPresentationText(item) {
            return `${item.name}: ${item.equivalence} UND`;
        },
        limpiarCarrito() {
            this.desserts = []
            this.datosComprobante = this.proof_payments[0]
            this.datosProveedor = this.providers[0]
            this.datosMoneda = this.coins[0]
            this.datosMetPago = this.payment_methods[0]
            this.form.description = ''
            this.form.voucher_number = ''
            this.form.date = (new Date(Date.now() - (new Date()).getTimezoneOffset() * 60000)).toISOString().substr(0, 10)
            this.form.exchange_rate = this.exchange_rate
            this.form.total = 0
        },
        changeProduct() {
            this.editedItem.productName = this.editedItem.datosProducto.name
            this.editedItem.productId = this.editedItem.datosProducto.id
            this.editedItem.type = this.editedItem.datosProducto.type
            this.editedItem.amount = 1
            this.editedItem.purchase_price = 0
            this.editedItem.sale_price = 0
            this.editedItem.marks = this.editedItem.datosProducto.marks[0]
            this.totalSoles = 0
        },
        changePresentation() {
            this.editedItem.presentationId = this.editedItem.datosPresentation.id
            this.editedItem.presentationName = this.editedItem.datosPresentation.name
            this.editedItem.equivalence = this.editedItem.datosPresentation.equivalence
        },
        save() {
            if (this.editedIndex > -1) {
                // Actualizando precios segun compra
                this.form.total -= this.editedItem.subTotal

                if (this.editedItem.igv == 'IGV Incluido') {
                    var subTotal = (this.editedItem.amount * this.editedItem.purchase_price) + Number.parseFloat(this.editedItem.transporte)
                }
                if (this.editedItem.igv == 'Mas IGV') {
                    var impuesto = (this.editedItem.amount * this.editedItem.purchase_price) * 0.18
                    var subTotal = Number.parseFloat(impuesto) + (this.editedItem.amount * this.editedItem.purchase_price) + Number.parseFloat(this.editedItem.transporte)
                }
                if (this.datosMoneda.code == 'USD' && this.editedItem.igv == 'IGV Incluido') {
                    this.editedItem.precio_compra = (this.editedItem.purchase_price * this.form.exchange_rate) + (this.editedItem.transporte * this.form.exchange_rate / this.editedItem.amount)
                }
                if (this.datosMoneda.code == 'USD' && this.editedItem.igv == 'Mas IGV') {
                    this.editedItem.precio_compra = (this.editedItem.purchase_price * this.form.exchange_rate + ((this.editedItem.purchase_price * this.form.exchange_rate) * 0.18)) + (this.editedItem.transporte * this.form.exchange_rate / this.editedItem.amount)
                }
                if (this.datosMoneda.code == 'PEN' && this.editedItem.igv == 'IGV Incluido') {
                    this.editedItem.precio_compra = parseFloat(this.editedItem.purchase_price) + (this.editedItem.transporte / this.editedItem.amount)
                }
                if (this.datosMoneda.code == 'PEN' && this.editedItem.igv == 'Mas IGV') {
                    this.editedItem.precio_compra = (parseFloat(this.editedItem.purchase_price) + (this.editedItem.purchase_price * 0.18)) + (this.editedItem.transporte / this.editedItem.amount)
                }
                this.editedItem.subTotal = subTotal
                this.form.total += this.editedItem.subTotal
                Object.assign(this.desserts[this.editedIndex], this.editedItem)
                this.close()
            } else {
                if (this.editedItem.igv == 'IGV Incluido') {
                    var subTotal = this.editedItem.amount * this.editedItem.purchase_price + Number.parseFloat(this.editedItem.transporte)
                }
                if (this.editedItem.igv == 'Mas IGV') {
                    var impuesto = (this.editedItem.amount * this.editedItem.purchase_price) * 0.18
                    var subTotal = Number.parseFloat(impuesto) + this.editedItem.amount * this.editedItem.purchase_price + Number.parseFloat(this.editedItem.transporte)
                }
                if (this.datosMoneda.code == 'USD' && this.editedItem.igv == 'IGV Incluido') {
                    this.editedItem.precio_compra = (this.editedItem.purchase_price * this.form.exchange_rate) + (this.editedItem.transporte * this.form.exchange_rate / this.editedItem.amount)
                }
                if (this.datosMoneda.code == 'USD' && this.editedItem.igv == 'Mas IGV') {
                    this.editedItem.precio_compra = (this.editedItem.purchase_price * this.form.exchange_rate + ((this.editedItem.purchase_price * this.form.exchange_rate) * 0.18)) + (this.editedItem.transporte * this.form.exchange_rate / this.editedItem.amount)
                }
                if (this.datosMoneda.code == 'PEN' && this.editedItem.igv == 'IGV Incluido') {
                    this.editedItem.precio_compra = parseFloat(this.editedItem.purchase_price) + (this.editedItem.transporte / this.editedItem.amount)
                }
                if (this.datosMoneda.code == 'PEN' && this.editedItem.igv == 'Mas IGV') {
                    this.editedItem.precio_compra = (parseFloat(this.editedItem.purchase_price) + (this.editedItem.purchase_price * 0.18)) + (this.editedItem.transporte / this.editedItem.amount)
                }
                this.editedItem.subTotal = subTotal
                this.desserts.push(this.editedItem)
                this.form.total += this.editedItem.subTotal
            }
            this.$nextTick(() => {
                this.editedItem = Object.assign({}, this.defaultItem)
            })
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
        closeDelete() {
            this.dialogDelete = false;
            this.$nextTick(() => {
                this.editedItem = Object.assign({}, this.defaultItem);
                this.editedIndex = -1;
            });
        },
        deleteItemConfirm() {
            this.desserts.splice(this.editedIndex, 1);
            this.closeDelete();
            // reducir el monto total de la venta
            this.form.total -= this.editedItem.subTotal
        },
        close() {
            this.dialogAddProducts = false;
            this.editedItem = Object.assign({}, this.defaultItem)
            this.editedIndex = -1
        },
        closeDialoPago() {
            this.dialogPago = false
        },

        asignarTotal() {
            this.pagoCompra = this.form.total
        },
        send_form() {
            if (this.datosProducto == '' || this.datosComprobante == '' ||
                this.datosMoneda == '' || this.datosProveedor == '' || this.datosMetPago == ''
                || this.form.voucher_number == '' || this.form.exchange_rate == '' || this.form.exchange_rate < 0) {
                this.snackbar_text = 'Completar datos';
                this.snackbar_color = 'red darken-4';
                this.snackbar = true;
                return;
            }
            if (this.form.datosProducto == '') {
                this.snackbar_text = 'Carrito Vacio';
                this.snackbar_color = 'teal darken-3';
                this.snackbar = true;
                return;
            }
            if (this.pagoCompra < 0 || this.pagoCompra > this.form.total) {
                this.snackbar_text = 'Monto incorrecto';
                this.snackbar_color = 'amber';
                this.snackbar = true;
                return;
            }
            if (this.cajaChica != 0) {
                if (this.pagoCompra > this.cajaChica[0].amount_pen) {
                    this.snackbar_text = 'Dinero insuficiente';
                    this.snackbar_color = 'amber';
                    this.snackbar = true;
                    return;
                } else {
                    this.form.cajaChica = 1
                }
            }
            // Datos Formulario
            this.form.providers_id = this.datosProveedor.id
            this.form.coins_id = this.datosMoneda.id
            this.form.proofPayments_id = this.datosComprobante.id
            this.form.paymentMethods_id = this.datosMetPago.id
            this.form.totalPago = this.pagoCompra
            this.form.products = this.desserts

            this.$inertia.post(route('purchases.store'), this.form)
        },
    }
}
</script>