<template>
    <admin-layout>

        <v-alert type="success" border="left" dismissible v-if="$page.props.flash.message">
            {{ $page.props.flash.message }}
        </v-alert>

        <div v-if="$page.props.errorBags.default">
            <v-alert type="warning" border="left" dismissible v-for="item in $page.props.errorBags.default.company"
                :key="$page.props.errorBags.default.company[0]">
                {{ item }}
            </v-alert>
            <v-alert type="warning" border="left" dismissible v-for="item in $page.props.errorBags.default.product"
                :key="$page.props.errorBags.default.product[0]">
                {{ item }}
            </v-alert>
            <v-alert type="warning" border="left" dismissible v-for="item in $page.props.errorBags.default.name"
                :key="$page.props.errorBags.default.name[0]">
                {{ item }}
            </v-alert>
            <v-alert type="warning" border="left" dismissible v-for="item in $page.props.errorBags.default.equivalence"
                :key="$page.props.errorBags.default.equivalence[0]">
                {{ item }}
            </v-alert>

        </div>

        <v-data-table :headers="headers" :items="desserts" class="elevation-1" :search="search">
            <template v-slot:top>
                <v-toolbar flat>
                    <v-toolbar-title>Lista de Presentaciones</v-toolbar-title>
                    <v-spacer></v-spacer>
                    <v-dialog v-model="dialog" max-width="500px">
                        <template v-slot:activator="{ on, attrs }">
                            <v-btn color="primary" dark class="mb-2" v-bind="attrs" v-on="on">
                                Nueva Presentacion
                            </v-btn>
                            <v-card-title>
                                <v-spacer></v-spacer>
                                <v-text-field v-model="search" append-icon="mdi-magnify" label="Buscar Presentacion"
                                    single-line hide-details></v-text-field>
                            </v-card-title>
                        </template>
                        <v-card>
                            <!-- Titulo de modal agreagar Presentacion -->
                            <v-card-title>
                                <span class="text-h5">{{ formTitle }}</span>
                            </v-card-title>

                            <!-- contenido de modal agreagar Presentacion -->
                            <v-card-text>
                                <v-container>
                                    <v-row>
                                        <v-col cols="12" sm="6" md="4">
                                            <v-autocomplete v-model="editedItem.company" :items="companies" hide-no-data
                                                color="primary" item-text="name" label=" Empresa"
                                                hint="Seleccione Empresa"></v-autocomplete>
                                        </v-col>
                                        <v-col cols="12" sm="6" md="4">
                                            <v-autocomplete v-model="editedItem.product" :items="products" hide-no-data
                                                color="primary" item-text="name" label=" Productos"
                                                hint="Seleccione Producto"></v-autocomplete>
                                        </v-col>
                                        <v-col cols="12" sm="6" md="4">
                                            <v-text-field v-model="editedItem.name" label="Presentacion*"
                                                hint="Presentación de productos: rollo, caja, millar, ciento, tira..."
                                                required></v-text-field>
                                        </v-col>
                                        <v-col cols="12" sm="6" md="4">
                                            <v-text-field v-model="editedItem.equivalence" label="Valor(UND)*"
                                                hint="cuantas unidades equivale dicha presentación"></v-text-field>
                                        </v-col>
                                    </v-row>
                                </v-container>
                                <small>*Tipos o cantidades en
                                    las cuales se pueden
                                    vender o comprar
                                    productos: caja, unidad,
                                    rollo...</small>
                            </v-card-text>
                            <!-- Acciones de modal agregar Presentacion -->
                            <v-card-actions>
                                <v-spacer></v-spacer>
                                <v-btn color="red darken-1" text @click="close">
                                    Cancelar
                                </v-btn>
                                <v-btn color="blue darken-1" text @click="save">
                                    Guardar
                                </v-btn>
                            </v-card-actions>
                        </v-card>
                    </v-dialog>
                    <!-- Mensaje de confirmacion de borrado de Presentacion -->
                    <v-dialog v-model="dialogDelete" max-width="500px">
                        <v-card>
                            <v-card-title class="text-h5">
                                ¿Está seguro de querer borrar la presentación?
                            </v-card-title>

                            <v-card-actions>
                                <v-spacer></v-spacer>
                                <v-btn color="red darken-1" text @click="closeDelete">Cancelar</v-btn>
                                <v-btn color="blue darken-1" text @click="deleteItemConfirm">Confirmar</v-btn>
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
                <v-icon small @click="deleteItem(item)">
                    mdi-delete
                </v-icon>
            </template>
        </v-data-table>

    </admin-layout>
</template>

<script>
import AdminLayout from '@/Layouts/AdminLayout'
import route from '../../../../vendor/tightenco/ziggy/src/js'

export default {
    props: ['presentations', 'companies', 'products'],
    components: {
        AdminLayout,
    },
    data() {
        return {

            dialog: false,
            dialogDelete: false,
            search: '',
            headers: [
                { text: 'PRODUCTO', value: 'product' },
                { text: 'NOMBRE', value: 'name' },
                { text: 'EQUIVALENCIA', value: 'equivalence' },
                { text: 'ACCIONES', value: 'actions', sortable: false },
            ],
            desserts: [],

            editedIndex: -1,

            editedItem: {
                company: '',
                companies_id: '',
                product: '',
                products_id: '',
                name: '',
                equivalence: '',
            },

            defaultItem: {
                company: '',
                companies_id: '',
                product: '',
                products_id: '',
                name: '',
                equivalence: '',
            },

        }
    },

    computed: {
        formTitle() {
            return this.editedIndex === -1 ? 'Nueva Presentacion' : 'Editar Presentacion'
        },
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


    // Para que agregue en el data table despues de saber que no hay errores en
    // en el formulario de crear
    updated() {
        if (Object.values(this.$page.props.errors).length == 0) {

            this.initialize();

        } else {
            console.log('Hay ' + Object.values(this.$page.props.errors).length + ' errores');
            console.log(this.$page.props.errors)
        }

    },

    methods: {
        initialize() {
            this.desserts = this.presentations
        },

        editItem(item) {
            this.editedIndex = this.desserts.indexOf(item)
            this.editedItem = Object.assign({}, item)
            this.dialog = true
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
            // enviando formulario de eliminar
            this.$inertia.delete(this.route('presentations.destroy', this.editedItem))
        },

        close() {
            this.dialog = false
            this.$nextTick(() => {
                this.editedItem = Object.assign({}, this.defaultItem)
                this.editedIndex = -1
            })
        },

        closeDelete() {
            this.dialogDelete = false
            this.$nextTick(() => {
                this.editedItem = Object.assign({}, this.defaultItem)
                this.editedIndex = -1
            })
        },

        save() {
            if (this.editedIndex > -1) {

                // esto agragaba el item a la tabla con solo javascrip
                //pero ya no es necesario porque se renderiza el componente desde
                // el servidor
                // Object.assign(this.desserts[this.editedIndex], this.editedItem)

                // Update
                // ***************************************
                // enviado formulario de almacenar
                this.$inertia.patch(route('presentations.update', this.editedItem), this.editedItem)

            } else {

                // Store
                // ***************************************
                // enviado formulario de almacenar
                this.$inertia.post(route('presentations.store'), this.editedItem)

                // this.desserts.push(this.editedItem)

            }

            this.close()
        },
    },
}
</script>
