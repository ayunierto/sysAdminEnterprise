<template>
    <admin-layout>

        <v-alert type="success" border="left" dismissible 
        v-if="$page.props.flash.message">
            {{ $page.props.flash.message }}
        </v-alert>
        
        <!-- Alertas -->
        <div v-if="$page.props.errorBags.default">
            <v-alert type="warning" border="left" dismissible 
             v-for="item in $page.props.errorBags.default.company" 
             :key="$page.props.errorBags.default.company[0]">
                {{ item }}
            </v-alert>
            <v-alert type="warning" border="left" dismissible 
             v-for="item in $page.props.errorBags.default.category" 
             :key="$page.props.errorBags.default.category[0]">
                {{ item }}
            </v-alert>
            <v-alert type="warning" border="left" dismissible 
             v-for="item in $page.props.errorBags.default.mark" 
             :key="$page.props.errorBags.default.mark[0]">
                {{ item }}
            </v-alert>
            <v-alert type="warning" border="left" dismissible 
             v-for="item in $page.props.errorBags.default.measure" 
             :key="$page.props.errorBags.default.measure[0]">
                {{ item }}
            </v-alert>
            <v-alert type="warning" border="left" dismissible 
             v-for="item in $page.props.errorBags.default.provider" 
             :key="$page.props.errorBags.default.provider[0]">
                {{ item }}
            </v-alert>
            <v-alert type="warning" border="left" dismissible 
             v-for="item in $page.props.errorBags.default.presentation" 
             :key="$page.props.errorBags.default.presentation[0]">
                {{ item }}
            </v-alert>
             <v-alert type="warning" border="left" dismissible 
             v-for="item in $page.props.errorBags.default.name" 
             :key="$page.props.errorBags.default.name[0]">
                {{ item }}
            </v-alert>
            <v-alert type="warning" border="left" dismissible 
             v-for="item in $page.props.errorBags.default.description" 
             :key="$page.props.errorBags.default.description[0]">
                {{ item }}
            </v-alert>
        </div>
        <!-- Fin de Alertas -->

        
        <v-data-table :headers="headers" :items="desserts" sort-by="name" 
        class="elevation-1" :search="search">
            <template v-slot:top>
                <v-toolbar flat >
                    <v-toolbar-title>Productos</v-toolbar-title>

                    <v-divider class="mx-4" inset vertical ></v-divider>

                    <v-spacer></v-spacer>

                    <v-dialog v-model="dialog" max-width="700px" >
                    
                    <template v-slot:activator="{ on, attrs }">
                        <v-btn color="primary" dark class="mb-2" v-bind="attrs" v-on="on" >
                            Nuevo Producto
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
                                    <v-col cols="12" sm="6" md="6">
                                        <v-select
                                        v-model="editedItem.company"
                                        hint="Seleccione empresa"
                                        :items="companies"
                                        item-text="name"
                                        item-value="abbr"
                                        label="Seleccione empresa"
                                        return-object
                                        single-line
                                        ></v-select>
                                    </v-col>

                                    <v-col cols="12" sm="6" md="6">
                                        <v-select
                                        v-model="editedItem.category"
                                        hint="Seleccione categoría"
                                        :items="categories"
                                        item-text="name"
                                        item-value="abbr"
                                        label="Seleccione categoría"
                                        return-object
                                        single-line
                                        ></v-select>
                                    </v-col>

                                    <v-col cols="12" sm="6" md="6">
                                        <v-select
                                        v-model="editedItem.mark"
                                        hint="Seleccione marca"
                                        :items="marks"
                                        item-text="name"
                                        item-value="abbr"
                                        label="Seleccione marca"
                                        return-object
                                        single-line
                                        ></v-select>
                                    </v-col>

                                    <v-col cols="12" sm="6" md="6">
                                        <v-select
                                        v-model="editedItem.measure"
                                        hint="Seleccione medida"
                                        :items="measures"
                                        item-text="name"
                                        item-value="abbr"
                                        label="Seleccione medida"
                                        return-object
                                        single-line
                                        ></v-select>
                                    </v-col>

                                    <v-col cols="12" sm="6" md="6">
                                        <v-select
                                        v-model="editedItem.provider"
                                        hint="Seleccione proveedor"
                                        :items="providers"
                                        item-text="name"
                                        item-value="abbr"
                                        label="Seleccione proveedor"
                                        return-object
                                        single-line
                                        ></v-select>
                                    </v-col>

                                    <v-col cols="12" sm="6" md="6">
                                        <v-select
                                        v-model="editedItem.presentation"
                                        hint="Seleccione presentación"
                                        :items="presentations"
                                        item-text="name"
                                        item-value="abbr"
                                        label="Seleccione presentación"
                                        return-object
                                        single-line
                                        ></v-select>
                                    </v-col>

                                    <v-col cols="12" sm="6" md="6" >
                                        <v-text-field
                                        v-model="editedItem.name"
                                        label="Nombre"
                                        required
                                        ></v-text-field>
                                    </v-col>

                                    <v-col cols="12" sm="6" md="6" >
                                        <v-text-field
                                        v-model="editedItem.code"
                                        label="Código"
                                        required
                                        ></v-text-field>
                                    </v-col>

                                    <v-col cols="12" sm="6" md="6" >
                                        <v-text-field
                                        v-model="editedItem.bar_code"
                                        label="Código de barra"
                                        required
                                        ></v-text-field>
                                    </v-col>

                                    <v-col cols="12" sm="6" md="6" >
                                        <v-text-field
                                        v-model="editedItem.stock"
                                        label="Stock"
                                        required
                                        ></v-text-field>
                                    </v-col>

                                    <v-col cols="12" sm="6" md="6" >
                                        <v-text-field
                                        v-model="editedItem.purchase_price"
                                        label="Precio de compra"
                                        required
                                        ></v-text-field>
                                    </v-col>

                                    <v-col cols="12" sm="6" md="6" >
                                        <v-text-field
                                        v-model="editedItem.sale_price"
                                        label="Precio de venta"
                                        required
                                        ></v-text-field>
                                    </v-col>

                                    <v-col cols="12" sm="6" md="6" >
                                        <v-text-field
                                        v-model="editedItem.price_by_unit"
                                        label="Precio por unidad"
                                        required
                                        ></v-text-field>
                                    </v-col>
                                    
                                    <v-col cols="12" sm="6" md="6" >
                                        <v-text-field
                                        v-model="editedItem.wholesale_price"
                                        label="Precio por mayor"
                                        required
                                        ></v-text-field>
                                    </v-col>

                                    <v-col cols="12" sm="6" md="6" >
                                        <v-text-field
                                        v-model="editedItem.special_price"
                                        label="Precio especial"
                                        required
                                        ></v-text-field>
                                    </v-col>

                                    <v-col cols="12" sm="6" md="6" >
                                        <v-select
                                        v-model="editedItem.state"
                                        :items="items_state"
                                        item-text="name"
                                        item-value="abbr"
                                        label="Seleccione estado"
                                        persistent-hint
                                        single-line
                                        ></v-select>
                                    </v-col>

                                    <v-col cols="12" sm="6" md="6" >
                                        <v-text-field
                                        v-model="editedItem.expiration_date"
                                        label="Fecha de vencimiento"
                                        required
                                        hint="Formato: 01-06-2022"
                                        ></v-text-field>
                                    </v-col>
                                    
                                    <v-col cols="12" sm="12" md="12">
                                        <v-textarea v-model="editedItem.description" class="mx-2"
                                            label="Descripción" rows="2" hint="Descripcion del producto">
                                        </v-textarea>
                                    </v-col>
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
                <v-icon small class="mr-2" @click="editItem(item)" >
                    mdi-pencil
                </v-icon>
                
                <v-icon small @click="deleteItem(item)" >
                    mdi-delete
                </v-icon>
            </template>

            <template v-slot:no-data>
                <v-btn color="primary" @click="initialize" >
                    Resetear
                </v-btn>
            </template>

        </v-data-table>

    </admin-layout>
</template>

<script>
    import AdminLayout from '@/Layouts/AdminLayout'
    import route from '../../../../vendor/tightenco/ziggy/src/js'

    export default {
        props: [
            'products', 
            'companies', 
            'categories', 
            'marks',
            'measures',
            'providers',
            'presentations',
        ],
        components: {
            AdminLayout,
        },
        data () {
            return {

                items_state: [
                    { name: 'Activo', abbr: 1 },
                    { name: 'Inactivo', abbr: 0 },
                ],
                
                search: '',
                dialog: false,
                dialogDelete: false,
                headers: [
                    { text: 'EMPRESA', value: 'company' },
                    { text: 'CATEGORIA', value: 'category' },
                    { text: 'MEDIDA', value: 'measure' },
                    { text: 'PRESENTACION', value: 'presentation' },
                    { text: 'NOMBRE', value: 'name' },
                    { text: 'STOCK', value: 'stock' },
                    { text: 'PRECIO COMPRA', value: 'purchase_price' },
                    { text: 'PRECIO VENTA', value: 'sale_price' },
                    { text: 'FECHA DE VENCIMIENTO', value: 'expiration_date' },
                    { text: 'ACCIONES', value: 'actions', sortable: false },
                ],
                desserts: [],

                editedIndex: -1,

                editedItem: {
                    company: '',
                    category: '',
                    mark: '',
                    measure: '',
                    provider: '',
                    presentation: '',
                    name: '',
                    code: '',
                    bar_code: '',
                    stock: '',
                    purchase_price: '',
                    sale_price: '',
                    price_by_unit: '',
                    wholesale_price: '',
                    special_price: '',
                    description: '',
                    state: '',
                    expiration_date: '',
                },

                defaultItem: {
                    company: '',
                    category: '',
                    mark: '',
                    measure: '',
                    provider: '',
                    presentation: '',
                    name: '',
                    code: '',
                    bar_code: '',
                    stock: '',
                    purchase_price: '',
                    sale_price: '',
                    price_by_unit: '',
                    wholesale_price: '',
                    special_price: '',
                    description: '',
                    state: 1,
                    expiration_date: '',
                },
                
            }
        },

        computed: {
            formTitle () {
                return this.editedIndex === -1 ? 'Nuevo producto' : 'Editar producto'
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
                this.desserts = this.products
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
                this.$inertia.delete(this.route('products.destroy', this.editedItem))
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
                    this.$inertia.patch(route('products.update', this.editedItem ), this.editedItem)
                    // ***************************************

                } else {

                    // Store
                    // ***************************************
                    // enviado formulario de almacenar 
                    this.$inertia.post(route('products.store'), this.editedItem)

                    // this.desserts.push(this.editedItem)

                }

                this.close()
            },
        },
    }
</script>
