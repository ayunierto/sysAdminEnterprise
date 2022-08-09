<template>
    <admin-layout>

        <template v-slot:company_name>
            <div>{{ company.name }}</div>
        </template>
        <!-- Fin de Alertas -->
        <v-container>
            <v-layout>
                <v-flex>
                    <v-card class="overflow-hidden" color="white" elevation-10 loading>
                        <v-toolbar flat color="#ECEFF1">
                            <v-toolbar-title class="font-weight-light">
                                Nueva Venta
                            </v-toolbar-title>
                        </v-toolbar>
                        <v-card-text>
                            <v-container>
                                <v-row>
                                    <v-col cols="12" sm="6" md="3">
                                        <v-select hint="Seleccione tipo Comprobante" :items="proofPayments"
                                            label="Tipo Documento" item-text="name" item-value="code"
                                            :value="proofPayments[0]">
                                        </v-select>
                                    </v-col>
                                    <v-col cols="12" sm="6" md="2">
                                        <v-select hint="Seleccione tipo Serie" :items="proofPayments" label="Serie"
                                            item-text="serie" item-value="serie" :value="proofPayments[0]">
                                        </v-select>
                                    </v-col>
                                    <v-col cols="12" sm="4" md="3">
                                        <v-text-field label="Correlativo" :value="orders" disabled></v-text-field>
                                    </v-col>
                                    <v-col cols="12" sm="6" md="3">
                                        <v-menu v-model="menu2" :close-on-content-click="false" :nudge-right="40"
                                            transition="scale-transition" offset-y min-width="auto">
                                            <template v-slot:activator="{ on, attrs }">
                                                <v-text-field v-model="date" label="Fecha" readonly v-bind="attrs"
                                                    v-on="on" disabled>
                                                </v-text-field>
                                            </template>
                                            <v-date-picker v-model="date" @input="menu2 = false"></v-date-picker>
                                        </v-menu>
                                    </v-col>
                                    <v-col cols="12">
                                        <h3>DATOS CLIENTE</h3>
                                    </v-col>
                                    <v-col class="d-flex" cols="12" sm="2" md="2">
                                        <v-select :items="documents" label="Tipo Documento" item-text="name"
                                            item-value="code" :value="documents[0]">
                                        </v-select>
                                    </v-col>
                                    <v-col cols="12" sm="3" md="3">
                                        <v-autocomplete :items="customers" color="primary" hide-no-data hide-selected
                                            item-text="document" item-value="id" label="Cliente"
                                            placeholder="Buscar por Documento" return-object auto-select-first>
                                        </v-autocomplete>
                                    </v-col>
                                    <v-col cols="12" sm="4" md="4">
                                        <v-text-field label="Nombre/Razon Social"></v-text-field>
                                    </v-col>
                                    <v-col cols="12" sm="3" md="3">
                                        <v-text-field label="Dirección"></v-text-field>
                                    </v-col>
                                    <v-col cols="12">
                                        <h3>DETALLE DE VENTA</h3>
                                    </v-col>
                                    <v-col cols="12" sm="3" md="3">
                                        <v-select :items="paymentMethods" label="Contado/crédito"
                                            item-text="description" item-value="description" :value="paymentMethods[0]">
                                        </v-select>
                                    </v-col>
                                    <v-col cols="12" sm="3" md="3">
                                        <v-select :items="coins" label="Tipo de Moneda" item-text="code"
                                            item-value="code" :value="coins[0]"></v-select>
                                    </v-col>
                                    <v-col cols="12" sm="2" md="2">
                                        <v-text-field label="Tipo Cambio" type="number" value="3.910" min="0" outlined>
                                        </v-text-field>
                                    </v-col>
                                    <v-spacer></v-spacer>
                                    <template>
                                        <div class="text-center">
                                            <v-dialog v-model="dialog3" width="600">
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
                                                        AÑADIR
                                                        PRODUCTOS
                                                    </v-card-title>
                                                    <v-card-text>
                                                        <v-container>
                                                            <v-row>
                                                                <v-col cols="12" sm="6" md="4">
                                                                    <v-autocomplete :items="products" color="white"
                                                                        hide-no-data hide-selected item-text="name"
                                                                        item-value="id" label="Producto"
                                                                        placeholder="Buscar Producto" return-object
                                                                        auto-select-first>
                                                                    </v-autocomplete>
                                                                </v-col>

                                                                <v-col cols="12" sm="6" md="4">
                                                                    <v-select item-text="name" item-value="equivalence"
                                                                        :items="presentations" label="Presentación"
                                                                        :value="presentations[0]">
                                                                    </v-select>
                                                                </v-col>
                                                                <v-col cols="12" sm="6" md="3">
                                                                    <v-text-field label="Cantidad" type="number" min="0"
                                                                        required>
                                                                    </v-text-field>
                                                                </v-col>
                                                                <v-col cols="12" sm="6" md="3">
                                                                    <v-text-field label="Precio Venta" type="number"
                                                                        min="0" required>
                                                                    </v-text-field>
                                                                </v-col>
                                                                <v-col cols="12" sm="4" md="3">
                                                                    <v-text-field label="Descuento" min="0"
                                                                        type="number" value="0" required>
                                                                    </v-text-field>
                                                                </v-col>
                                                                <v-col cols="12" sm="6" md="6">
                                                                    <v-select :items="affectationIgvs"
                                                                        :value="affectationIgvs[0]"
                                                                        item-text="description" item-value="code"
                                                                        label="Afectación IGV">
                                                                    </v-select>
                                                                </v-col>
                                                                <v-col cols="12" sm="4" md="4">
                                                                    <v-btn color="primary" class="ma-2 white--text" fab>
                                                                        <v-icon dark>
                                                                            mdi-sticker-plus
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
                                        <v-col cols="12">
                                            <v-data-table :headers="headers" :items="desserts" sort-by="name"
                                                class="elevation-2" :search="search" fixed-header height="200px" :items-per-page="5">
                                                <template v-slot:top>
                                                    <v-toolbar flat>
                                                        <v-toolbar-title>Carrito de Ventas</v-toolbar-title>
                                                        <v-divider class="mx-4" inset vertical></v-divider>
                                                        <v-spacer></v-spacer>
                                                        Lista de Medidas<v-spacer></v-spacer>
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
                                        <v-container>
                                            <v-row>
                                                <v-spacer></v-spacer>
                                                <v-col cols="12" sm="3" md="3">
                                                    <v-text-field label="Sub Total" disabled></v-text-field>
                                                    <v-text-field label="IGV" disabled></v-text-field>
                                                    <v-text-field label="Total S/." disabled></v-text-field>
                                                </v-col>
                                            </v-row>
                                        </v-container>
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
                                    <v-dialog v-model="dialog2" width="450">
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
        'orders',
        'presentations',
        'affectationIgvs',
        'products',
    ],
    components: {
        AdminLayout,
    },
    data: () => ({
        isEditing: null,
        dialog: false,
        dialog2: false,
        dialog3: false,
        dialogDelete: false,
        date: (new Date(Date.now() - (new Date()).getTimezoneOffset() * 60000)).toISOString().substr(0, 10),
        menu2: false,
        search: '',
        headers: [
            { text: 'PRODUCTO', value: 'producto' },
            { text: 'PRESENTACIÓN', value: 'presentacion' },
            { text: 'CANTIDAD', value: 'cantidad' },
            { text: 'PRECIO', value: 'precio' },
            { text: 'ACCIONES', value: 'actions', sortable: false },
        ],
        desserts: [
            {
                producto: "Frozen Yogurt",
                presentacion: "cja 12 und",
                cantidad: 159,
                precio: 50,
            },
            {
                producto: "Ice cream sandwich",
                presentacion: "sobre 5 und",
                cantidad: 237,
                precio: 12,
            },
            {
                producto: "Eclair",
                presentacion: "saco 50kg",
                cantidad: 262,
                precio: 30,
            },
            {
                producto: "Cupcake",
                presentacion: "molde 5 kg",
                cantidad: 305,
                precio: 15,
            },            
        ],
    }),
    watch: {
        dialog(val) {
            val || this.close();
        },
        dialogDelete(val) {
            val || this.closeDelete();
        },
    },
    methods: {
        save() {
            this.isEditing = !this.isEditing;
            if (this.editedIndex > -1) {
                Object.assign(this.desserts[this.editedIndex], this.editedItem);
            } else {
                this.desserts.push(this.editedItem);
            }
            this.close();
        },
        close() {
            this.dialog = false;
            this.$nextTick(() => {
                this.editedItem = Object.assign({}, this.defaultItem);
                this.editedIndex = -1;
            });
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
        },
        closeDelete() {
            this.dialogDelete = false;
            this.$nextTick(() => {
                this.editedItem = Object.assign({}, this.defaultItem);
                this.editedIndex = -1;
            });
        },
    },
}
</script>
