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
                                            v-model="tipoComprobate" @change="changeComprobante" return-object outlined
                                            dense>
                                        </v-select>
                                        <!-- {{ tipoComprobate }} -->
                                    </v-col>
                                    <v-col cols="12" sm="6" md="2">
                                        <v-text-field label="Serie" type="text" v-model="tipoComprobate.serie" readonly
                                            outlined dense>
                                        </v-text-field>
                                    </v-col>
                                    <!-- Correlativo de acuerdo al tipo de comprobante -->
                                    <v-col cols="12" sm="4" md="3">
                                        <v-text-field label="Correlativo" v-model="form.voucher_number" readonly
                                            outlined dense>
                                        </v-text-field>
                                    </v-col>
                                    <v-col cols="12" sm="6" md="3">
                                        <v-text-field label="Fecha" v-model="form.date" readonly outlined dense>
                                        </v-text-field>
                                    </v-col>
                                    <v-col cols="12">
                                        <h3>DATOS CLIENTE</h3>
                                    </v-col>
                                    <v-col class="d-flex" cols="12" sm="2" md="2">
                                        <v-select :items="documents" label="Tipo Documento" item-text="name"
                                            item-value="code" v-model="tipoDoc" return-object outlined dense>
                                        </v-select>
                                    </v-col>
                                    <v-col cols="12" sm="3" md="3">
                                        <v-autocomplete color="primary" :items="customers" item-text="document"
                                            v-model="datosCliente" item-value="id" label="Cliente" auto-select-first
                                            hide-no-data hide-selected placeholder="Buscar por Documento"
                                            persistent-hint return-object required outlined dense>
                                        </v-autocomplete>
                                        <!-- <v-autocomplete v-if="tipoDoc.name == 'DNI'" color="primary" :items="customers"
                                            item-text="document" v-model="datosCliente" item-value="id" label="Cliente"
                                            auto-select-first hide-no-data hide-selected placeholder="Buscar por Nombre"
                                            persistent-hint return-object required>
                                        </v-autocomplete> -->
                                    </v-col>
                                    <v-col cols="12" sm="4" md="4">
                                        <v-text-field label="Nombre/Razon Social" :value="datosCliente.name" readonly
                                            outlined dense>
                                        </v-text-field>
                                    </v-col>
                                    <v-col cols="12" sm="3" md="3">
                                        <v-text-field label="Dirección" :value="datosCliente.address" readonly outlined
                                            dense>
                                        </v-text-field>
                                    </v-col>
                                    <v-col cols="12">
                                        <h3>DETALLE DE VENTA</h3>
                                    </v-col>
                                    <v-col cols="12" sm="3" md="3">
                                        <v-select :items="cashRegisters" label="Caja"
                                            item-text="description" item-value="id" v-model="cajaRegistro"
                                            return-object outlined dense>
                                        </v-select>
                                    </v-col>
                                    <v-col cols="9" sm="2" md="2">
                                        <v-select :items="paymentMethods" label="Método Pago"
                                            item-text="description" item-value="description" v-model="metodoPago"
                                            return-object outlined dense readonly>
                                        </v-select>
                                    </v-col>
                                    <!-- Dialog Quotas -->
                                    <v-col cols="2" sm="1" md="1"
                                        v-if="metodoPago.description == 'Credito' && tipoComprobate.name == 'Factura'">
                                        <v-container>
                                            <v-layout row justify-center>
                                                <v-dialog v-model="dialogQuotasAdd" persistent max-width="420">
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
                                                                <v-col cols="4" sm="4" md="4">
                                                                    <v-text-field v-model="editedItemQuotas.montoQuota"
                                                                        label="Monto" type="number" min="0" dense
                                                                        outlined>
                                                                    </v-text-field>
                                                                </v-col>
                                                                <v-col cols="6" sm="6" md="6">
                                                                    <v-text-field v-model="editedItemQuotas.dateQuota"
                                                                        label="fecha" type="date" dense outlined>
                                                                    </v-text-field>
                                                                </v-col>
                                                                <v-col cols="1" sm="1" md="1"
                                                                    v-if="editedItemQuotas.montoQuota > 0
                                                                    && editedItemQuotas.montoQuota != '' && editedItemQuotas.dateQuota != ''"
                                                                    v-show="true">
                                                                    <v-btn color="amber accent-3" small
                                                                        class=" white--text" fab @click="addQuota">
                                                                        <v-icon dark>
                                                                            mdi-bookmark-check
                                                                        </v-icon>
                                                                    </v-btn>
                                                                </v-col>
                                                                <v-col cols="12" sm="12" md="12">
                                                                    <v-data-table id="tablaQuotas" hide-default-footer
                                                                        :headers="quotasHeaders" :items="quotas"
                                                                        sort-by="date" class="elevation-1">
                                                                        <template v-slot:[`item.actions`]="{ item }">
                                                                            <v-icon small @click="deleteQuota(item)">
                                                                                mdi-delete
                                                                            </v-icon>
                                                                        </template>
                                                                    </v-data-table>
                                                                </v-col>
                                                            </v-row>
                                                        </v-container>

                                                        <v-card-actions>
                                                            <v-spacer></v-spacer>
                                                            <v-btn color="red" text @click="closeDialogQuotas()"
                                                                class="mr-2">
                                                                Cancelar</v-btn>
                                                            <v-spacer></v-spacer>
                                                            <v-btn v-if="this.quotas.length > 0" v-show="true"
                                                                color="primary" text @click="ConfirmarQuotas()">
                                                                Confirmar</v-btn>
                                                        </v-card-actions>
                                                    </v-card>
                                                </v-dialog>
                                            </v-layout>
                                        </v-container>
                                    </v-col>
                                    <!-- Fin Dialog Quotas -->
                                    <v-col cols="12" sm="2" md="2">
                                        <v-select v-if="parseFloat(form.total) > 0" readonly :items="coins"
                                            label="Moneda" item-text="code" item-value="code" v-model="form.coins"
                                            @change="changeMoneda" return-object outlined dense>
                                        </v-select>

                                        <v-select v-else :items="coins" label="Moneda" item-text="code"
                                            item-value="code" v-model="form.coins" @change="changeMoneda" return-object
                                            outlined dense>
                                        </v-select>
                                    </v-col>
                                    <v-col cols="12" sm="2" md="2">
                                        <v-text-field label="Tipo Cambio" type="number" v-model="form.exchange_rate"
                                            min="0" outlined dense>
                                        </v-text-field>
                                    </v-col>
                                    <v-col cols="12" sm="2" md="2">
                                        <v-text-field label="Total" type="number" v-model="form.total" outlined
                                            :prefix="simboloMoneda" readonly dense>
                                        </v-text-field>
                                    </v-col>                                    
                                    <v-col cols="12" sm="5">
                                        <v-textarea filled label="Comentario" type="text" rows="1" outlined
                                            v-model="form.description">
                                        </v-textarea>
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
                                                                                :items="products" id="inputProducts"
                                                                                v-model="editedItem.datosProducto"
                                                                                :item-text="getProductText"
                                                                                item-value="id" label="Producto"
                                                                                auto-select-first hide-no-data
                                                                                hide-selected
                                                                                placeholder="Seleccione Producto"
                                                                                persistent-hint return-object
                                                                                @change="changeProduct" required
                                                                                outlined dense
                                                                                :hint="editedItem.datosProducto != '' ? 'Stock: ' + editedItem.datosProducto.stock : 'Stock: 0'">
                                                                            </v-autocomplete>
                                                                            <!-- @keyup.enter="save" Colocar en boton cuando se va a usar lector de barras -->
                                                                        </v-col>
                                                                        <v-col cols="12" sm="6" md="6">
                                                                            <v-autocomplete color="primary"
                                                                                id="inputPresentations"
                                                                                v-model="editedItem.datosPresentation"
                                                                                :items="presentations"
                                                                                :item-text="getPresentationText"
                                                                                item-value="id" label="Presentación"
                                                                                auto-select-first hide-no-data
                                                                                hide-selected
                                                                                placeholder="Seleccione Presentación"
                                                                                persistent-hint return-object
                                                                                @change="changePresentation" required
                                                                                outlined dense>
                                                                            </v-autocomplete>
                                                                        </v-col>
                                                                        <v-col cols="12" sm="6" md="3">
                                                                            <v-text-field v-model="editedItem.quantity"
                                                                                label="Cantidad" type="number" min="0"
                                                                                required outlined dense>
                                                                            </v-text-field>
                                                                        </v-col>
                                                                        <v-col cols="9" sm="6" md="3">
                                                                            <v-text-field id="precioV"
                                                                                v-model="editedItem.sale_price"
                                                                                label="Precio Venta" type="number"
                                                                                min="0" required outlined dense>
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
                                                                                                                v-model="editedItem.price_by_unit"
                                                                                                                readonly
                                                                                                                outlined
                                                                                                                dense>
                                                                                                            </v-text-field>
                                                                                                        </v-col>
                                                                                                        <v-col cols="2">
                                                                                                            <v-btn
                                                                                                                color="amber accent-3"
                                                                                                                small
                                                                                                                class="ma-2 white--text"
                                                                                                                fab
                                                                                                                @click="addPrice1">
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
                                                                                                                v-model="editedItem.wholesale_price"
                                                                                                                readonly
                                                                                                                outlined
                                                                                                                dense>
                                                                                                            </v-text-field>
                                                                                                        </v-col>
                                                                                                        <v-col cols="2">
                                                                                                            <v-btn
                                                                                                                color="amber accent-3"
                                                                                                                small
                                                                                                                class="ma-2 white--text"
                                                                                                                fab
                                                                                                                @click="addPrice2">
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
                                                                                                                v-model="editedItem.special_price"
                                                                                                                readonly
                                                                                                                outlined
                                                                                                                dense>
                                                                                                            </v-text-field>
                                                                                                        </v-col>
                                                                                                        <v-col cols="2">
                                                                                                            <v-btn
                                                                                                                color="amber accent-3"
                                                                                                                small
                                                                                                                class="ma-2 white--text"
                                                                                                                fab
                                                                                                                @click="addPrice3">
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
                                                                                required outlined dense>
                                                                            </v-text-field>
                                                                        </v-col>
                                                                        <v-col cols="12" sm="6" md="6">
                                                                            <v-autocomplete color="primary"
                                                                                id="inputAffectationIgv"
                                                                                v-model="editedItem.datosAffectationIgv"
                                                                                :items="affectationIgvs"
                                                                                item-text="description"
                                                                                item-value="code"
                                                                                label=" Afectación IGV"
                                                                                auto-select-first hide-no-data
                                                                                hide-selected
                                                                                placeholder="Seleccione Afectación IGV"
                                                                                persistent-hint return-object
                                                                                @change="changeAffectatioIgv" required
                                                                                outlined dense>
                                                                            </v-autocomplete>
                                                                        </v-col>
                                                                        <v-col cols="12" sm="4" md="4"
                                                                            v-if="editedItem.quantity > 0
                                                                            && parseFloat(editedItem.discount) >= 0 && editedItem.datosProducto != ''"
                                                                            v-show="true">
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
                                    <!-- Tabla Carrito -->
                                    <v-col cols="12">
                                        <v-data-table :headers="headers" :items="desserts" sort-by="name"
                                            class="elevation-2" fixed-header :items-per-page="5">
                                            <!-- class="elevation-2" :search="search" fixed-header :items-per-page="5"> -->
                                            <template v-slot:[`item.full_name`]="{ item }">{{ item.datosProducto.name }}
                                                - {{ item.datosProducto.marks_name }} - {{
                                                        item.datosProducto.warehouses_name
                                                }}</template>
                                            <template v-slot:[`item.presentation`]="{ item }">{{ item.presentationName
                                            }}: {{ item.equivalence }} UND</template>
                                            <template v-slot:top>
                                                <v-toolbar flat>
                                                    <v-toolbar-title>Carrito de Ventas</v-toolbar-title>
                                                    <v-divider class="mx-4" inset vertical></v-divider>
                                                    <v-spacer></v-spacer>
                                                    <v-spacer></v-spacer>
                                                    <!-- <v-text-field v-model="search" append-icon="mdi-magnify"
                                                        label="Buscar" single-line hide-details outlined dense>
                                                    </v-text-field> -->
                                                    <!-- Mensaje de confirmacion de borrado de p -->
                                                    <v-dialog v-model="dialogDelete" max-width="500px">
                                                        <v-card>
                                                            <v-card-title class="text-h5">¿Está seguro de querer
                                                                borrar el producto?
                                                            </v-card-title>
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
                                            <template v-slot:[`item.actions`]="{ item }">
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
                            <v-btn color="red" dark @click="limpiarCarrito">
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
                                                DATOS DE VENTA
                                            </v-card-title>
                                            <v-card-text>
                                                <v-container>
                                                    <v-row>
                                                        <v-col cols="12" md="6">
                                                            <v-text-field label="Total" v-model="form.total"
                                                                :prefix="simboloMoneda" type="number" readonly>
                                                            </v-text-field>
                                                        </v-col>

                                                        <v-col cols="12" md="6">
                                                            <v-text-field type="number" label="Monto a pagar"
                                                                v-model="pagoVenta" :prefix="simboloMoneda" min="0"
                                                                :max="this.form.total" required>
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
                                                <!-- <v-btn color="green" text @click="send_form(1)">
                                                    Pagar e imprimir
                                                </v-btn> -->
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
                </v-flex>
            </v-layout>
        </v-container>
        <v-snackbar v-model="snackbar" :color="snackbar_color" right top>
            {{ snackbar_text }}
        </v-snackbar>
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
        'exchange_rate',
        'cajaChica',
        'cashRegisters',
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
            dialogDelete: false,
            dialogQuotasAdd: false,
            // search: '',
            tipoComprobate: this.proofPayments[0],
            datosCliente: this.customers[0],
            tipoDoc: this.documents[0],
            metodoPago: this.paymentMethods[0],
            cajaRegistro:this.cashRegisters[0],
            snackbar: false,
            snackbar_text: '',
            snackbar_color: '',
            simboloMoneda: 'S/',
            pagoVenta: 0,
            form: {
                companies_id: this.$page.props.user.companies_id,
                proof_payments_id: '',
                voucher_number: this.nroComprobantes,
                date: (new Date(Date.now() - (new Date()).getTimezoneOffset() * 60000)).toISOString().substr(0, 10),
                documents_id: '',
                customers_id: '',
                payment_methods_id: '',
                coins_id: this.coins[0].id,
                coins: this.coins[0],
                exchange_rate: this.exchange_rate,
                cash_registers_id: '',
                description: '',
                products: '',
                quotasVenta: '',
                nroQuotas: 0,
                total: 0,
                totalPago: 0,
                // print: 0,
                cajaChica: 0,
            },
            editedIndexQuotas: -1,
            quotasHeaders: [
                { text: 'FECHA', value: 'dateQuota' },
                { text: 'MONTO', value: 'montoQuota' },
                { text: 'ACCIONES', value: 'actions', sortable: false },
            ],
            quotas: [],
            editedItemQuotas: {
                dateQuota: '',
                montoQuota: 0,
                totalQuotas: 0
            },
            defaultItemQuotas: {
                dateQuota: '',
                montoQuota: 0,
                totalQuotas: 0
            },
            headers: [
                { text: 'PRODUCTO', value: 'full_name' },
                { text: 'PRESENTACIÓN', value: 'presentation' },
                { text: 'CANTIDAD', value: 'quantity' },
                { text: 'PRECIO UNITARIO', value: 'sale_price' },
                { text: 'DESCUENTO', value: 'discount' },
                { text: 'TOTAL IGV', value: 'igv' },
                { text: 'AFECTACIÓN IGV', value: 'igvAffectationDescription' },
                { text: 'SUB TOTAL', value: 'subTotal' },
                { text: 'ACCIONES', value: 'actions', sortable: false },
            ],
            editedIndex: -1,
            desserts: [],
            editedItem: {
                datosProducto: '',
                productId: '',
                type: '',
                productName: '',
                sale_price: 0,
                price_by_unit: 0,
                wholesale_price: 0,
                special_price: 0,
                datosPresentation: this.presentations[0],
                presentationId: this.presentations[0].id,
                presentationName: this.presentations[0].name,
                equivalence: this.presentations[0].equivalence,
                quantity: 1,
                discount: 0,
                igv: 0,
                datosAffectationIgv: this.affectationIgvs[0],
                igvAffectationId: this.affectationIgvs[0].id,
                igvAffectationDescription: this.affectationIgvs[0].description,
                subTotal: 0,
            },
            defaultItem: {
                datosProducto: '',
                productId: '',
                type: '',
                productName: '',
                sale_price: 0,
                price_by_unit: 0,
                wholesale_price: 0,
                special_price: 0,
                datosPresentation: this.presentations[0],
                presentationId: this.presentations[0].id,
                presentationName: this.presentations[0].name,
                equivalence: this.presentations[0].equivalence,
                quantity: 1,
                discount: 0,
                igv: 0,
                datosAffectationIgv: this.affectationIgvs[0],
                igvAffectationId: this.affectationIgvs[0].id,
                igvAffectationDescription: this.affectationIgvs[0].description,
                subTotal: 0,
            },
        }
    },
    // Metodos al cargar formulario
    // mounted() {
    //     this.pruebam();
    // },
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
            return `${item.bar_code} - ${item.name} - ${item.marks_name} - ${item.warehouses_name}`;
        },
        getPresentationText(item) {
            return `${item.name}: ${item.equivalence} UND`;
        },
        // pruebam() {
        //     alert('Método Inicial')
        // },
        asignarTotal() {
            this.pagoVenta = this.form.total
        },
        addPrice1() {
            this.editedItem.sale_price = this.editedItem.price_by_unit
            this.dialogPrecios = false
        },
        addPrice2() {
            this.editedItem.sale_price = this.editedItem.wholesale_price
            this.dialogPrecios = false
        },
        addPrice3() {
            this.editedItem.sale_price = this.editedItem.special_price
            this.dialogPrecios = false
        },
        changeComprobante() {
            if (this.tipoComprobate.code == '0A1') {
                this.tipoDoc = this.documents[0]
                this.form.voucher_number = this.nroComprobantes
            } if (this.tipoComprobate.code == '01') {
                this.tipoDoc = this.documents[1]
                this.form.voucher_number = this.nroFacturas
            } if (this.tipoComprobate.code == '03') {
                this.tipoDoc = this.documents[0]
                this.form.voucher_number = this.nroBoletas
            }
        },
        changeMoneda() {
            if (this.form.coins.code == 'PEN') {
                this.simboloMoneda = 'S/'
                this.form.coins_id = this.form.coins.id
            } if (this.form.coins.code == 'USD') {
                this.simboloMoneda = '$'
                this.form.coins_id = this.form.coins.id
            }
        },
        changeProduct() {
            this.editedItem.sale_price = this.editedItem.datosProducto.sale_price
            this.editedItem.price_by_unit = this.editedItem.datosProducto.price_by_unit
            this.editedItem.wholesale_price = this.editedItem.datosProducto.wholesale_price
            this.editedItem.special_price = this.editedItem.datosProducto.special_price
            this.editedItem.productName = this.editedItem.datosProducto.name
            this.editedItem.productId = this.editedItem.datosProducto.id
            this.editedItem.type = this.editedItem.datosProducto.type
        },
        changePresentation() {
            this.editedItem.presentationId = this.editedItem.datosPresentation.id
            this.editedItem.presentationName = this.editedItem.datosPresentation.name
            this.editedItem.equivalence = this.editedItem.datosPresentation.equivalence
        },
        changeAffectatioIgv() {
            this.editedItem.igvAffectationDescription = this.editedItem.datosAffectationIgv.description
            this.editedItem.igvAffectationId = this.editedItem.datosAffectationIgv.id
        },
        editItem(item) {
            this.editedIndex = this.desserts.indexOf(item);
            this.editedItem = Object.assign({}, item);
            this.dialogAddProducts = true;
            // al editar, cargar valores actuales sin aplicar descuento e igv
            if (this.form.coins.code == 'PEN') {
                var piu = this.editedItem.igv / this.editedItem.quantity
                var dis = this.editedItem.discount / this.editedItem.quantity
                var val = Number.parseFloat(this.editedItem.sale_price) + Number.parseFloat(dis) + Number.parseFloat(piu)
                this.editedItem.sale_price = Number.parseFloat(val.toFixed(2))
            } else {
                this.editedItem.igv = this.editedItem.igv * this.exchange_rate
                this.editedItem.discount = this.editedItem.discount * this.exchange_rate
                var piu = this.editedItem.igv / this.editedItem.quantity
                var dis = this.editedItem.discount / this.editedItem.quantity
                var prc = (this.editedItem.sale_price * this.exchange_rate) + dis + piu
                this.editedItem.sale_price = Number.parseFloat(prc.toFixed(2))
            }
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
        closeDialogQuotas() {
            this.dialogQuotasAdd = false
            this.quotas = []
            this.editedItemQuotas.montoQuota = 0
            this.editedItemQuotas.dateQuota = ''
        },
        closeDelete() {
            this.dialogDelete = false;
            this.$nextTick(() => {
                this.editedItem = Object.assign({}, this.defaultItem);
                this.editedIndex = -1;
            });
        },
        addQuota() {
            this.quotas.push(this.editedItemQuotas)
            this.$nextTick(() => {
                this.editedItemQuotas = Object.assign({}, this.defaultItemQuotas)
            })
            var tot = 0
            const quotasValor = this.quotas.map(function (montoValor) {
                tot += Number.parseFloat(montoValor.montoQuota)
            });
            this.editedItemQuotas.totalQuotas = tot
            alert(this.editedItemQuotas.totalQuotas)

            if (tot > this.form.total) {
                this.snackbar_text = 'Monto de cuotas excede al total';
                this.snackbar_color = 'red darken-1';
                this.snackbar = true;
            }

        },
        ConfirmarQuotas() {
            this.snackbar_text = 'Cuotas agregadas correctamente';
            this.snackbar_color = 'green';
            this.snackbar = true;
            this.dialogQuotasAdd = false
        },
        deleteQuota(item) {
            this.editedIndexQuotas = this.quotas.indexOf(item)
            this.editedIndexQuotas = Object.assign({}, item)
            this.quotas.splice(this.editedIndexQuotas, 1)
        },
        limpiarCarrito() {
            this.desserts = []
            this.quotas = []
            this.tipoComprobate = this.proofPayments[0]
            this.datosCliente = this.customers[0]
            this.tipoDoc = this.documents[0]
            this.metodoPago = this.paymentMethods[0]
            this.cajaRegistro = this.cashRegisters[0]
            this.form.total = 0
            this.form.coins = this.coins[0]
            this.simboloMoneda = 'S/'
            this.form.description = ''
        },
        save() {
            if (this.editedIndex > -1) {
                var stk = this.editedItem.quantity * this.editedItem.equivalence
                if (this.editedItem.datosProducto.stock < stk) {
                    this.snackbar_text = 'Sin Stock';
                    this.snackbar_color = 'lime accent-4';
                    this.snackbar = true;
                    return;
                }
                var totItem = this.editedItem.quantity * this.editedItem.sale_price
                if (this.editedItem.discount > totItem) {
                    this.snackbar_text = 'El descuento no puede ser mayor al total';
                    this.snackbar_color = 'green darken-2';
                    this.snackbar = true;
                    return;
                }
                // Actualizando precios segun compra
                this.form.total -= this.editedItem.subTotal
                // calcular de igv
                if (this.editedItem.datosAffectationIgv.code == '10') {
                    var des = Number.parseFloat(this.editedItem.discount)
                    var cant = Number.parseFloat(this.editedItem.quantity)
                    var prec = Number.parseFloat(this.editedItem.sale_price)
                    var totalVenta1 = (cant * prec) - des
                    var prIgv = cant + (0.18 * cant)
                    var precUni = totalVenta1 / prIgv
                    var totalVenta = cant * precUni
                    var igvTotal = totalVenta * 0.18
                    if (this.tipoComprobate.code == '0A1') {
                        this.editedItem.sale_price = totalVenta1 / cant
                        this.editedItem.igv = 0
                    } else {
                        this.editedItem.sale_price = precUni
                        this.editedItem.igv = igvTotal
                    }
                } else {
                    var des = Number.parseFloat(this.editedItem.discount)
                    var cant = Number.parseFloat(this.editedItem.quantity)
                    var prec = Number.parseFloat(this.editedItem.sale_price)
                    var totalVenta1 = (cant * prec) - des
                    var precUni = totalVenta1 / cant
                    this.editedItem.sale_price = precUni
                    this.editedItem.igv = 0
                }
                // calculando nuevo precio
                var subTotal = ((Number.parseFloat(this.editedItem.sale_price) * Number.parseFloat(this.editedItem.quantity))) + Number.parseFloat(this.editedItem.igv)
                if (this.form.coins.code == 'PEN') {
                    this.editedItem.subTotal = Number.parseFloat(subTotal.toFixed(2))
                } else {
                    this.editedItem.sale_price = this.editedItem.sale_price / this.exchange_rate
                    this.editedItem.igv = this.editedItem.igv / this.exchange_rate
                    this.editedItem.discount = this.editedItem.discount / this.exchange_rate
                    this.editedItem.subTotal = Number.parseFloat(((subTotal / Number.parseFloat(this.exchange_rate)).toFixed(3)))
                }
                this.form.total += this.editedItem.subTotal
                Object.assign(this.desserts[this.editedIndex], this.editedItem)
                this.close()
            } else {
                var stk = this.editedItem.quantity * this.editedItem.equivalence
                if (this.editedItem.datosProducto.stock < stk) {
                    this.snackbar_text = 'Sin Stock';
                    this.snackbar_color = 'lime accent-4';
                    this.snackbar = true;
                    return;
                }
                var totItem = this.editedItem.quantity * this.editedItem.sale_price
                if (this.editedItem.discount > totItem) {
                    this.snackbar_text = 'El descuento no puede ser mayor al total';
                    this.snackbar_color = 'green darken-2';
                    this.snackbar = true;
                    return;
                }
                // calcular de igv
                if (this.editedItem.datosAffectationIgv.code == '10') {
                    var des = Number.parseFloat(this.editedItem.discount)
                    var cant = Number.parseFloat(this.editedItem.quantity)
                    var prec = Number.parseFloat(this.editedItem.sale_price)
                    var totalVenta1 = (cant * prec) - des
                    var prIgv = cant + (0.18 * cant)
                    var precUni = totalVenta1 / prIgv
                    var totalVenta = cant * precUni
                    var igvTotal = totalVenta * 0.18
                    if (this.tipoComprobate.code == '0A1') {
                        this.editedItem.sale_price = totalVenta1 / cant
                        this.editedItem.igv = 0
                    } else {
                        this.editedItem.sale_price = precUni
                        this.editedItem.igv = igvTotal
                    }
                } else {
                    var des = Number.parseFloat(this.editedItem.discount)
                    var cant = Number.parseFloat(this.editedItem.quantity)
                    var prec = Number.parseFloat(this.editedItem.sale_price)
                    var totalVenta1 = (cant * prec) - des
                    var precUni = totalVenta1 / cant
                    var totalVenta = cant * precUni
                    this.editedItem.sale_price = precUni
                }
                // calculando nuevo precio
                var subTotal = ((Number.parseFloat(this.editedItem.sale_price) * Number.parseFloat(this.editedItem.quantity))) + Number.parseFloat(this.editedItem.igv)
                if (this.form.coins.code == 'PEN') {
                    this.editedItem.subTotal = Number.parseFloat(subTotal.toFixed(2))
                } else {
                    this.editedItem.sale_price = this.editedItem.sale_price / this.exchange_rate
                    this.editedItem.igv = this.editedItem.igv / this.exchange_rate
                    this.editedItem.discount = this.editedItem.discount / this.exchange_rate
                    this.editedItem.subTotal = Number.parseFloat(((subTotal / Number.parseFloat(this.exchange_rate)).toFixed(3)))
                }

                this.form.total += this.editedItem.subTotal
                // fin agregar producto a editedItem

                // Valor inicial de precio de venta
                this.desserts.push(this.editedItem)
            }
            this.$nextTick(() => {
                this.editedItem = Object.assign({}, this.defaultItem)
            })
        },
        // send_form(print = 0) {
        //     if (print == 1) {
        //         this.form.print = 1
        //     }
        send_form() {
            if (this.pagoVenta < 0 || this.pagoVenta > this.form.total) {
                this.snackbar_text = 'Monto incorrecto';
                this.snackbar_color = 'amber';
                this.snackbar = true;
                return;
            }

            if (this.cajaChica != 0) {
                this.form.cajaChica = 1
            }
            // Datos Formulario
            this.form.proof_payments_id = this.tipoComprobate.id
            this.form.documents_id = this.tipoDoc.id
            this.form.customers_id = this.datosCliente.id 
            this.form.payment_methods_id = this.metodoPago.id
            this.form.cash_registers_id = this.cajaRegistro.id
            this.form.totalPago = this.pagoVenta
            this.form.products = this.desserts

            this.form.quotasVenta = this.quotas
            this.form.nroQuotas = this.quotas.length

            if (this.form.products == '') {
                this.snackbar_text = 'Carrito Vacio';
                this.snackbar_color = 'amber lighten-1';
                this.snackbar = true;
                return;
            }
            if (this.datosCliente == '') {
                this.datosCliente = this.customers[0]
                this.snackbar_text = 'Datos de Cliente Vacio';
                this.snackbar_color = 'green darken-1';
                this.snackbar = true;
                return;
            }

            // Validar Si algun dato del form es nulo o cacio
            // const isEmpty = Object.values(this.form).some(x => (x === ''))
            // if (isEmpty == true) {
            //     this.snackbar_text = 'Error al enviar Datos';
            //     this.snackbar_color = 'blue lighten-2';
            //     this.snackbar = true;
            //     return;
            // } else {
            this.$inertia.post(route('orders.store'), this.form)
            // }
        },
    },
}
</script>