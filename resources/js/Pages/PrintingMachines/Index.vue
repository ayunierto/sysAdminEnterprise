<template>
    <admin-layout>

        <template v-slot:company_name>
            <div>{{ company.name }}</div>
        </template>

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

        <v-data-table :headers="headers" :items="desserts" sort-by="name" class="elevation-24" :search="search">
            <template v-slot:[`item.state`]="{ item }">
                <v-chip :color="getColor(item.state)" dark v-if="item.state==1">
                    Activo
                </v-chip>
                <v-chip :color="getColor(item.state)" dark v-if="item.state==0">
                    Inativo
                </v-chip>
            </template>
            <template v-slot:top>
                <v-toolbar flat>
                    <v-toolbar-title>Lista de Impresoras</v-toolbar-title>

                    <v-divider class="mx-4" inset vertical></v-divider>

                    <v-spacer></v-spacer>

                    <v-dialog v-model="dialog" max-width="700px">

                        <template v-slot:activator="{ on, attrs }">
                            <v-btn color="primary" dark class="mb-2" v-bind="attrs" v-on="on">
                                Agregar Impresora
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
                                            <v-select v-model="editedItem.companies_id" hint="Seleccione empresa"
                                                :items="companies" item-text="name" item-value="id"
                                                label="Seleccione empresa" single-line></v-select>
                                        </v-col>

                                        <v-col cols="12" sm="6" md="6">
                                            <v-text-field v-model="editedItem.name" label="Nombre"
                                                :rules="requiredField" required></v-text-field>
                                        </v-col>
                                        <v-col cols="12" sm="6" md="6">
                                            <v-select v-model="editedItem.state" :items="items_state" item-text="name"
                                                item-value="value" label="Seleccione estado"></v-select>
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

        <template>
            <div class="text-center">
                <v-dialog v-model="messageIni" width="500" persistent>
                    <v-card>
                        <v-card-title class="text-h5 grey lighten-2">
                            IMPORTANT!
                        </v-card-title>

                        <v-card-text>
                            <strong>Tener en cuenta los siguientes puntos para evitar problemas al momento de imprimir
                                sus comprobantes</strong>

                            <v-timeline align-top dense>
                                <v-timeline-item>Solo registrar impresorar compatibles con POS</v-timeline-item>
                                <v-timeline-item>Compartir su Impresora</v-timeline-item>
                                <v-timeline-item>Verificar que el nombre de la impresora coincida con el nombre
                                    registrado
                                </v-timeline-item>
                                <v-timeline-item>Solo tener activa una impresora</v-timeline-item>
                            </v-timeline>
                        </v-card-text>

                        <v-divider></v-divider>

                        <v-card-actions>
                            <v-spacer></v-spacer>
                            <v-btn color="primary" text @click="messageIni = false">
                                ACEPTAR
                            </v-btn>
                        </v-card-actions>
                    </v-card>
                </v-dialog>
            </div>
        </template>
    </admin-layout>
</template>

<script>
import AdminLayout from '@/Layouts/AdminLayout'
import route from '../../../../vendor/tightenco/ziggy/src/js'

export default {
    props: [
        'printingMachines',
        'companies',
    ],
    components: {
        AdminLayout,
    },
    data() {
        return {
            // Validaciones
            requiredField: [
                v => !!v || '*Campo Ogligatorio',
            ],

            menu: false,
            messageIni: false,

            items_state: [
                { name: 'Activo', value: 1 },
                { name: 'Inactivo', value: 0 },
            ],

            search: '',
            dialog: false,
            dialogDelete: false,
            headers: [
                { text: 'NOMBRE', value: 'name' },
                { text: 'ESTADO', value: 'state' },
                { text: 'ACCIONES', value: 'actions', sortable: false },
            ],
            desserts: [],

            editedIndex: -1,

            editedItem: {
                companies_id: this.$page.props.user.companies_id,
                printers_id: '',
                name: '',
                state: 1,
            },

            defaultItem: {
                companies_id: this.$page.props.user.companies_id,
                printers_id: '',
                name: '',
                state: 1,
            },

        }
    },
    // Metodos al cargar formulario
    mounted() {
        this.messageIni = true
    },
    computed: {
        formTitle() {
            return this.editedIndex === -1 ? 'Nueva Impresora' : 'Editar Impresora'
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
            this.desserts = this.printingMachines
        },
        getColor(state) {
            if (state == 1) return 'green'
            else if (state == 0) return 'red'
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
            this.$inertia.delete(this.route('printingMachines.destroy', this.editedItem))
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
                this.$inertia.patch(route('printingMachines.update', this.editedItem), this.editedItem)
                // ***************************************

            } else {

                // Store
                // ***************************************
                // enviado formulario de almacenar 
                this.$inertia.post(route('printingMachines.store'), this.editedItem)

                // this.desserts.push(this.editedItem)

            }

            this.close()
        },
    },
}
</script>
