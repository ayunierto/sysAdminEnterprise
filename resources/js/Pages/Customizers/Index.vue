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
            <template v-slot:top>
                <v-toolbar flat>
                    <v-toolbar-title>Listado de Personalizaciones</v-toolbar-title>

                    <v-divider class="mx-4" inset vertical></v-divider>

                    <v-spacer></v-spacer>

                    <v-dialog v-model="dialog" max-width="700px">

                        <template v-slot:activator="{ on, attrs }">
                            <v-btn color="primary" dark class="mb-2" v-bind="attrs" v-on="on">
                                Agregar personalización
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
                                        <v-col cols="12" sm="12" md="12">
                                            <v-select v-model="editedItem.companies_id" hint="Seleccione empresa"
                                                :items="companies" item-text="name" item-value="id"
                                                label="Seleccione empresa" single-line></v-select>
                                        </v-col>

                                        <v-col cols="12" sm="6" md="6">
                                            Color del Menú
                                            <v-text-field v-model="editedItem.color_menu" hide-details class="ma-0 pa-0"
                                                solo hint="asdasd" persistent-hint>
                                                <template v-slot:append>
                                                    <v-menu v-model="menu_color_menu" top nudge-bottom="105"
                                                        nudge-left="16" :close-on-content-click="false">
                                                        <template v-slot:activator="{ on }">
                                                            <div :style="swatchStyleMenu" v-on="on" />
                                                        </template>
                                                        <v-card>
                                                            <v-card-text class="pa-0">
                                                                <v-color-picker v-model="editedItem.color_menu" flat
                                                                    dot-size="25" hide-inputs hide-sliders show-swatches
                                                                    swatches-max-height="250" />
                                                            </v-card-text>
                                                        </v-card>
                                                    </v-menu>
                                                </template>
                                            </v-text-field>
                                        </v-col>

                                        <v-col cols="12" sm="6" md="6">
                                            Color de los submenus
                                            <v-text-field v-model="editedItem.color_sub_menu" hide-details
                                                class="ma-0 pa-0" solo>
                                                <template v-slot:append>
                                                    <v-menu v-model="menu_color_sub_menu" top nudge-bottom="105"
                                                        nudge-left="16" :close-on-content-click="false">
                                                        <template v-slot:activator="{ on }">
                                                            <div :style="swatchStyleSubMenu" v-on="on" />
                                                        </template>
                                                        <v-card>
                                                            <v-card-text class="pa-0">
                                                                <v-color-picker v-model="editedItem.color_sub_menu" flat
                                                                    hide-inputs hide-sliders show-swatches
                                                                    swatches-max-height="250" />
                                                            </v-card-text>
                                                        </v-card>
                                                    </v-menu>
                                                </template>
                                            </v-text-field>
                                        </v-col>

                                        <v-col cols="12" sm="6" md="6">
                                            Color de la cabecera
                                            <v-text-field v-model="editedItem.color_header" hide-details
                                                class="ma-0 pa-0" solo>
                                                <template v-slot:append>
                                                    <v-menu v-model="menu_color_header" top nudge-bottom="105"
                                                        nudge-left="16" :close-on-content-click="false">
                                                        <template v-slot:activator="{ on }">
                                                            <div :style="swatchStyleHeader" v-on="on" />
                                                        </template>
                                                        <v-card>
                                                            <v-card-text class="pa-0">
                                                                <v-color-picker v-model="editedItem.color_header" flat
                                                                    hide-inputs hide-sliders show-swatches
                                                                    swatches-max-height="250" />
                                                            </v-card-text>
                                                        </v-card>
                                                    </v-menu>
                                                </template>
                                            </v-text-field>
                                        </v-col>

                                        <v-col cols="12" sm="6" md="6">
                                            Color del pie de página
                                            <v-text-field v-model="editedItem.color_footer" hide-details
                                                class="ma-0 pa-0" solo>
                                                <template v-slot:append>
                                                    <v-menu v-model="menu_color_footer" top nudge-bottom="105"
                                                        nudge-left="16" :close-on-content-click="false">
                                                        <template v-slot:activator="{ on }">
                                                            <div :style="swatchStyleFooter" v-on="on" />
                                                        </template>
                                                        <v-card>
                                                            <v-card-text class="pa-0">
                                                                <v-color-picker v-model="editedItem.color_footer" flat
                                                                    hide-inputs hide-sliders show-swatches
                                                                    swatches-max-height="250" />
                                                            </v-card-text>
                                                        </v-card>
                                                    </v-menu>
                                                </template>
                                            </v-text-field>
                                        </v-col>

                                        <v-col cols="12" sm="6" md="6">
                                            Color de los textos
                                            <v-text-field v-model="editedItem.color_text" hide-details class="ma-0 pa-0"
                                                solo>
                                                <template v-slot:append>
                                                    <v-menu v-model="menu_color_text" top nudge-bottom="105"
                                                        nudge-left="16" :close-on-content-click="false">
                                                        <template v-slot:activator="{ on }">
                                                            <div :style="swatchStyleText" v-on="on" />
                                                        </template>
                                                        <v-card>
                                                            <v-card-text class="pa-0">
                                                                <v-color-picker v-model="editedItem.color_text" flat
                                                                    hide-inputs hide-sliders show-swatches
                                                                    swatches-max-height="250" />
                                                            </v-card-text>
                                                        </v-card>
                                                    </v-menu>
                                                </template>
                                            </v-text-field>
                                        </v-col>
                                        <v-col cols="9" sm="4" md="4">
                                            <label for="Logo">Logo Empresa</label>
                                            <v-file-input v-model="editedItem.logo" @change="Preview_logo"
                                                accept="image/*" placeholder="Cargar Logo" prepend-icon="mdi-camera"
                                                label="Cargar Logo"></v-file-input>
                                        </v-col>
                                        <v-col cols="3" sm="2" md="2">
                                            <v-card max-height="80" max-width="80" :color="colorFondoImg">
                                                    <v-img aspect-ratio="2" contain height="80" width="80" :src="editedItem.url">
                                                    </v-img>
                                                </v-card>
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

export default {
    props: [
        'companies',
        'customizers',
        'company',
        'colors',
    ],
    components: {
        AdminLayout,
    },
    data() {
        return {

            // color: '#1976D2FF',
            // mask: '!#XXXXXXXX',
            menu_color_menu: false,
            menu_color_sub_menu: false,
            menu_color_header: false,
            menu_color_footer: false,
            menu_color_text: false,
            colorFondoImg: this.$page.props.customizers[0].color_menu,

            search: '',
            dialog: false,
            dialogDelete: false,
            headers: [
                { text: 'EMPRESA', value: 'name' },
                { text: 'MENU', value: 'color_menu' },
                { text: 'SUB MENU', value: 'color_sub_menu' },
                { text: 'ENCABEZADO', value: 'color_header' },
                { text: 'PIE', value: 'color_footer' },
                { text: 'TEXTO', value: 'color_text' },
                { text: 'LOGOTIPO', value: 'logo' },
                { text: 'ACCIONES', value: 'actions', sortable: false },
            ],
            desserts: [],

            editedIndex: -1,

            editedItem: {
                companies_id:'' ,
                color_menu: '',
                color_sub_menu: '',
                color_header: '',
                color_footer: '',
                color_text: '',
                logo: null,
                url: '../../img/logo_user.png',
            },

            defaultItem: {
                companies_id: '',
                color_menu: '#1976D2FF',
                color_sub_menu: '#1976D2FF',
                color_header: '#1976D2FF',
                color_footer: '#1976D2FF',
                color_text: '#FF9595FF',
                logo: null,
                url: '../../img/logo_user.png',
            },

        }
    },

    computed: {
        formTitle() {
            return this.editedIndex === -1 ? 'Personalizar empresa' : 'Editar personalización'
        },

        swatchStyleMenu() {
            return {
                backgroundColor: this.editedItem.color_menu ? this.editedItem.color_menu : this.defaultItem.color_menu,
                cursor: 'pointer',
                height: '30px',
                width: '30px',
                borderRadius: this.menu_color_menu ? '50%' : '4px',
                transition: 'border-radius 200ms ease-in-out'
            }
        },

        swatchStyleSubMenu() {
            return {
                backgroundColor: this.editedItem.color_sub_menu ? this.editedItem.color_sub_menu : this.defaultItem.color_sub_menu,
                cursor: 'pointer',
                height: '30px',
                width: '30px',
                borderRadius: this.menu_color_sub_menu ? '50%' : '4px',
                transition: 'border-radius 200ms ease-in-out'
            }
        },

        swatchStyleHeader() {
            return {
                backgroundColor: this.editedItem.color_header ? this.editedItem.color_header : this.defaultItem.color_header,
                cursor: 'pointer',
                height: '30px',
                width: '30px',
                borderRadius: this.menu_color_header ? '50%' : '4px',
                transition: 'border-radius 200ms ease-in-out'
            }
        },

        swatchStyleFooter() {
            return {
                backgroundColor: this.editedItem.color_footer ? this.editedItem.color_footer : this.defaultItem.color_footer,
                cursor: 'pointer',
                height: '30px',
                width: '30px',
                borderRadius: this.menu_color_footer ? '50%' : '4px',
                transition: 'border-radius 200ms ease-in-out'
            }
        },

        swatchStyleText() {
            return {
                backgroundColor: this.editedItem.color_text ? this.editedItem.color_text : this.defaultItem.color_text,
                cursor: 'pointer',
                height: '30px',
                width: '30px',
                borderRadius: this.menu_color_text ? '50%' : '4px',
                transition: 'border-radius 200ms ease-in-out'
            }
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
        Preview_logo() {
            if (this.editedItem.logo == null) {
                this.editedItem.url = '../../img/logo_user.png'
            } else {
                this.editedItem.url = URL.createObjectURL(this.editedItem.logo)
            }
        },

        initialize() {
            this.desserts = this.customizers
        },

        editItem(item) {
            this.editedIndex = this.desserts.indexOf(item)
            this.editedItem = Object.assign({}, item)

            var http = new XMLHttpRequest();
            http.open('HEAD', this.editedItem.logo, false);
            http.send();
            if (http.status != 404) {
                this.editedItem.url = this.editedItem.logo
            } else {
                this.editedItem.url = '../../img/logo_user.png'
            }  

            this.dialog = true
            this.editedItem.logo=null
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
            this.$inertia.delete(this.route('customizers.destroy', this.editedItem))
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
                // enviado formulario de actualizar    
                this.$inertia.post(route('customizers.update', this.editedItem.companies_id), {
                    _method: 'put',
                    logo: this.editedItem.logo,

                    companies_id: this.editedItem.companies_id,
                    color_menu: this.editedItem.color_menu,
                    color_sub_menu: this.editedItem.color_sub_menu,
                    color_header: this.editedItem.color_header,
                    color_footer: this.editedItem.color_footer,
                    color_text: this.editedItem.color_text,

                })
                // ***************************************

            } else {

                // Store
                // ***************************************
                // enviado formulario de almacenar 
                this.$inertia.post(route('customizers.store'), this.editedItem)

                // this.desserts.push(this.editedItem)

            }

            this.close()
        },
    },
}
</script>
