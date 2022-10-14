<template>
    <admin-layout>

        <template v-slot:company_name>
            <div>{{ company.name }}</div>
        </template>

        <v-alert type="success" border="left" dismissible 
        v-if="$page.props.flash.message">
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
        
        <v-data-table :headers="headers" :items="desserts" sort-by="calories" 
        class="elevation-24" :search="search">
            <template v-slot:top>
                <v-toolbar flat >
                    <v-toolbar-title>Lista de Usuarios</v-toolbar-title>

                    <v-divider class="mx-4" inset vertical ></v-divider>

                    <v-spacer></v-spacer>

                    <v-dialog v-model="dialog" max-width="600px" >
                    
                        <template v-slot:activator="{ on, attrs }">
                            <v-btn color="primary" dark class="mb-2" v-bind="attrs" v-on="on" >
                                Agregar Usuario
                            </v-btn>

                            <v-spacer></v-spacer>

                            <!-- Buscar -->
                            <v-text-field
                                v-model="search"
                                append-icon="mdi-magnify"
                                label="Buscar"
                                outlined dense
                                hide-details
                            ></v-text-field>
                        </template>

                        <form @submit.prevent="save">
                            <v-card>
                                <v-card-title>
                                    <span class="text-h5">{{ formTitle }}</span>
                                </v-card-title>

                                <v-card-text>
                                    <v-container>
                                        <v-row>
                                            <v-col cols="12" sm="6" md="6">
                                                <v-text-field
                                                v-model="editedItem.name"
                                                label="Nombre"
                                                required
                                                outlined
                                                dense
                                                ></v-text-field>
                                            </v-col>

                                            <v-col cols="12" sm="6" md="6">
                                                <v-select
                                                v-model="editedItem.companies_id"
                                                hint="Selecciones empresa"
                                                :items="companies"
                                                item-text="name"
                                                item-value="id"
                                                label="Selecciones empresa"
                                                outlined
                                                dense
                                                required
                                                :rules="[(v) => !!v || 'La empresa es requerida']"
                                                persistent-hint
                                                ></v-select>
                                            </v-col>

                                            <!-- Se mosrara cuando se valla a editar -->
                                            <v-col cols="12" sm="6" md="6" v-if="editedIndex > -1"> 
                                                <v-text-field
                                                v-model="editedItem.change_password"
                                                :append-icon="show1 ? 'mdi-eye' : 'mdi-eye-off'"
                                                :type="show1 ? 'text' : 'password'"
                                                label="Clave"
                                                hint="Al menos 8 carácteres"
                                                counter
                                                @click:append="show1 = !show1"
                                                dense outlined 
                                                :rules="[(v) => !!v || 'La contraseña es requerida']"
                                                ></v-text-field>
                                            </v-col>
                                            <!-- Se mostrara cuando se valla a crear -->
                                            <v-col cols="12" sm="6" md="6" v-else>
                                                <v-text-field
                                                v-model="editedItem.password"
                                                :append-icon="show1 ? 'mdi-eye' : 'mdi-eye-off'"
                                                :type="show1 ? 'text' : 'password'"
                                                label="Clave"
                                                hint="Al menos 8 carácteres"
                                                counter
                                                @click:append="show1 = !show1"
                                                dense outlined required
                                                :rules="[(v) => !!v || 'La contraseña es requerida']"
                                                ></v-text-field>
                                            </v-col>

                                            <v-col cols="12" sm="6" md="6" >
                                                <v-text-field
                                                v-model="editedItem.email"
                                                label="Correo"
                                                dense outlined required
                                                type="email"
                                                :rules="[(v) => !!v || 'El correo es requerido']"
                                                ></v-text-field>
                                            </v-col>

                                            <!-- <v-col cols="12" sm="6" md="6" >
                                                <v-select
                                                v-model="editedItem.role"
                                                :items="roles"
                                                item-text="name"
                                                item-value="value"
                                                label="Selecione permisos"
                                                persistent-hint
                                                hint="Selecione permiso" 
                                                dense outlined required
                                                :rules="[(v) => !!v || 'El rol es requerido']"
                                                ></v-select>
                                            </v-col>-->

                                            <v-col cols="12" sm="6" md="6" >
                                                {{ rol_selected }}
                                                <v-select
                                                v-model="rol_selected"
                                                :items="roles"
                                                item-text="name"
                                                item-value="id"
                                                :menu-props="{ maxHeight: '400' }"
                                                label="Selecione rol"
                                                multiple chips
                                                hint="Selecione rol"
                                                persistent-hint
                                                ></v-select>
                                            </v-col>
                                            
                                        </v-row>
                                    </v-container>
                                </v-card-text>

                                <v-card-actions>
                                    <v-spacer></v-spacer>

                                    <v-btn color="red darken-1" text @click="close" >
                                        Cancelar
                                    </v-btn>

                                    <v-btn color="blue darken-1" type="submit" text>
                                        Guardar
                                    </v-btn>
                                </v-card-actions>
                            </v-card>
                        </form>
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
                <v-icon small class="mr-2" @click="editItem(item)" >
                    mdi-pencil
                </v-icon>
                
                <v-icon small @click="deleteItem(item)" >
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
        props: ['users', 'companies', 'company', 'roles'],
        components: {
            AdminLayout,
        },
        data () {
            return {

                rol_selected: [],

                // Para clave
                show1: false,

                search: '',
                dialog: false,
                dialogDelete: false,
                headers: [
                    { text: 'NOMBRE', value: 'name' },
                    { text: 'CORREO', value: 'email' },
                    { text: 'ACCIONES', value: 'actions', sortable: false },
                ],
                desserts: [],

                editedIndex: -1,

                editedItem: {
                    name: '',
                    companies_id: 1,
                    email: '',
                    password: '',
                    role: [],
                    created_at: '',
                    updated_at: '',
                    change_password: '',
                    
                },

                defaultItem: {
                    name: '',
                    companies_id: 1,
                    email: '',
                    password: '',
                    role: [],
                    created_at: '',
                    updated_at: '',
                    change_password: '',

                },

            }
        },

        computed: {
            formTitle () {
                return this.editedIndex === -1 ? 'Nuevo Usuario' : 'Editar Usuario'
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
                this.desserts = this.users
                // this.roles.forEach(rol => {
                //     this.rol_selected.push(rol.name)
                // });
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
                this.$inertia.delete(this.route('users.destroy', this.editedItem))
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
                this.editedItem.role = this.rol_selected
                if (this.editedIndex > -1) {

                    // esto agregaba el item a la tabla con solo javascrip 
                    //pero ya no es necesario porque se renderiza el componente desde
                    // el servidor
                    // Object.assign(this.desserts[this.editedIndex], this.editedItem)

                    // Update
                    // ***************************************
                    // enviado formulario de almacenar 
                    this.$inertia.patch(route('users.update', this.editedItem ), this.editedItem)
                    // ***************************************

                } else {

                    // Store
                    // ***************************************
                    // enviado formulario de almacenar 
                    this.$inertia.post(route('users.store'), this.editedItem)

                    // this.desserts.push(this.editedItem)

                }

                this.close()
            },
        },
    }
</script>
