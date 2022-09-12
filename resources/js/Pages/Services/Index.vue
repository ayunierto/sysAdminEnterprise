<template>
    <admin-layout>
        <template v-slot:company_name>
            <div>{{ company.name }}</div>
        </template>

        <v-alert type="success" border="left" dismissible v-if="$page.props.flash.message">
            {{ $page.props.flash.message }}
        </v-alert>
        <v-data-table :headers="headers" :items="desserts" sort-by="name" class="elevation-24" :search="search">
            <template v-slot:top>
                <v-toolbar flat>
                    <v-toolbar-title>Lista Servicios</v-toolbar-title>

                    <v-divider class="mx-4" inset vertical></v-divider>

                    <v-spacer></v-spacer>

                    <v-dialog v-model="dialog" max-width="700px" persistent>

                        <template v-slot:activator="{ on, attrs }">
                            <v-btn color="primary" dark class="mb-2" v-bind="attrs" v-on="on">
                                Agregar Servicio
                            </v-btn>
                            <v-spacer></v-spacer>
                            <v-text-field v-model="search" append-icon="mdi-magnify" label="Buscar" single-line
                                hide-details></v-text-field>
                        </template>

                        <v-card>
                            <v-card-title>
                                <span class="text-h5">{{ formTitle }}</span>
                            </v-card-title>

                            <v-card-text>
                                <v-container>
                                    <v-row>
                                        <v-col cols="12" sm="6" md="6" v-if="$page.props.user.role == 'master'">
                                            <v-autocomplete v-model="editedItem.companies_id" color="primary"
                                                :items="companies" item-text="name" item-value="id" label="Empresa"
                                                auto-select-first hide-no-data hide-selected
                                                placeholder="Seleccione Empresa" persistent-hint>
                                            </v-autocomplete>
                                        </v-col>

                                        <v-col cols="12" sm="6" md="4">
                                            <v-text-field v-model="editedItem.name" label="Nombre Servicio"
                                                :rules="requiredField" required></v-text-field>
                                        </v-col>

                                        <v-col cols="12" sm="6" md="4">
                                            <v-autocomplete v-model="editedItem.measures_id" color="primary"
                                                :items="measures" item-text="name" item-value="id" label="Medida"
                                                auto-select-first hide-no-data hide-selected
                                                placeholder="Seleccione Medida" persistent-hint :rules="requiredField"
                                                required>
                                            </v-autocomplete>
                                        </v-col>

                                        <v-col cols="12" sm="6" md="4">
                                            <v-text-field v-model="editedItem.code" label="Código" required>
                                            </v-text-field>
                                        </v-col>

                                        <v-col cols="12" sm="6" md="4">
                                            <v-text-field v-model="editedItem.sale_price" label="Precio de venta"
                                                type="number" min="0"></v-text-field>
                                        </v-col>

                                        <v-col cols="12" sm="6" md="4">
                                            <v-text-field v-model="editedItem.price_by_unit" label="Precio por unidad"
                                                type="number" min="0"></v-text-field>
                                        </v-col>

                                        <v-col cols="12" sm="6" md="4">
                                            <v-text-field v-model="editedItem.wholesale_price" label="Precio por mayor"
                                                type="number" min="0"></v-text-field>
                                        </v-col>

                                        <v-col cols="12" sm="6" md="4">
                                            <v-text-field v-model="editedItem.special_price" type="number"
                                                label="Precio especial" min="0"></v-text-field>
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

                                <v-btn color="blue darken-1" text @click="close">
                                    Cancelar
                                </v-btn>

                                <v-btn color="blue darken-1" type="submit" text @click="save">
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

            <template v-slot:[`item.actions`]="{ item }">
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
import Alerts from '../../Components/Alerts'

export default {
    props: [
        'warehouses',
        'services',
        'companies',
        'categories',
        'marks',
        'measures',
        'providers',
        'company',
    ],
    components: {
        AdminLayout,
        Alerts
    },
    data() {
        return {
            // Validaciones
            requiredField: [
                v => !!v || '*Campo Ogligatorio',
            ],
            menu: false,
            search: '',
            dialog: false,
            dialogDelete: false,
            headers: [
                { text: 'NOMBRE', value: 'name' },
                { text: 'PRECIO', value: 'sale_price' },
                { text: 'DESCRIPCIÓN', value: 'description' },
                { text: 'ACCIONES', value: 'actions', sortable: false },
            ],
            desserts: [],

            editedIndex: -1,

            editedItem: {
                companies_id: this.$page.props.user.companies_id,
                warehouses_id: this.warehouses[0].id,
                categories_id: this.categories[0].id,
                marks_id: this.marks[0].id,
                measures_id: this.measures[58].id,
                providers_id: this.providers[0].id,
                name: '',
                code: '',
                purchase_price: 0,
                sale_price: 0,
                price_by_unit: 0,
                wholesale_price: 0,
                special_price: 0,
                description: '',
            },

            defaultItem: {
                companies_id: this.$page.props.user.companies_id,
                warehouses_id: this.warehouses[0].id,
                categories_id: this.categories[0].id,
                marks_id: this.marks[0].id,
                measures_id: this.measures[58].id,
                providers_id: this.providers[0].id,
                name: '',
                code: '',
                purchase_price: 0,
                sale_price: 0,
                price_by_unit: 0,
                wholesale_price: 0,
                special_price: 0,
                description: '',
            },

        }
    },

    computed: {
        formTitle() {
            return this.editedIndex === -1 ? 'Nuevo Servicio' : 'Editar Servicio'
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



    updated() {

        // Para que agregue en el data table el item despues de saber que no hay errores en
        // en el formulario de crear

        if (Object.values(this.$page.props.errors).length == 0) {

            this.initialize();

        }

    },

    methods: {

        initialize() {
            this.desserts = this.services
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
            // enviando formulario para eliminar
            this.$inertia.delete(this.route('services.destroy', this.editedItem))
            // ***************************************
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

                // esto agregaba el item a la tabla con solo javascrip
                //pero ya no es necesario porque se renderiza el componente desde
                // el servidor
                // Object.assign(this.desserts[this.editedIndex], this.editedItem)

                // Update
                // ***************************************
                // enviado formulario de almacenar
                this.$inertia.patch(route('services.update', this.editedItem), this.editedItem)
                // ***************************************

            } else {

                // Store
                // ***************************************
                // enviado formulario de almacenar
                this.$inertia.post(route('services.store'), this.editedItem)

                // this.desserts.push(this.editedItem)

            }

            this.close()
        },
    },
}
</script>
