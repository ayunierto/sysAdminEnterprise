<template>
    <admin-layout>
        <v-container>
            <v-layout>
                <v-flex>
                    <template>
                        <v-card class="overflow-hidden">
                            <v-toolbar flat color="blue-grey lighten-4">
                                <v-icon>mdi-office-building</v-icon>
                                <v-toolbar-title class="font-weight-light">
                                    Información General
                                    Empresa
                                </v-toolbar-title>
                                <v-spacer></v-spacer>
                                <v-btn fab small @click="isEditing = !isEditing">
                                    <v-icon v-if="isEditing">
                                        mdi-close
                                    </v-icon>
                                    <v-icon v-else>
                                        mdi-pencil
                                    </v-icon>
                                </v-btn>
                            </v-toolbar>
                            <v-card :disabled="!isEditing">
                                <v-card-text>
                                    <v-container>
                                        <v-row>
                                            <v-col cols="12" sm="4" md="4">
                                                <v-text-field label="Nombre/Razon Social" v-model="editedItem.name">
                                                </v-text-field>
                                            </v-col>
                                            <v-col cols="12" sm="4" md="4">
                                                <v-text-field label="Ruc" type="number" v-model="editedItem.ruc">
                                                </v-text-field>
                                            </v-col>
                                            <v-col cols="12" sm="4" md="4">
                                                <v-text-field label="Teléfono" v-model="editedItem.phone">
                                                </v-text-field>
                                            </v-col>
                                            <v-col cols="12" sm="4" md="4">
                                                <v-text-field label="Dirección" v-model="editedItem.address">
                                                </v-text-field>
                                            </v-col>
                                            <v-col cols="12" sm="4" md="4">
                                                <v-text-field label="Departamento" v-model="editedItem.department">
                                                </v-text-field>
                                            </v-col>
                                            <v-col cols="12" sm="4" md="4">
                                                <v-text-field label="Provincia" v-model="editedItem.province">
                                                </v-text-field>
                                            </v-col>
                                            <v-col cols="12" sm="4" md="4">
                                                <v-text-field label="Distrito" v-model="editedItem.district">
                                                </v-text-field>
                                            </v-col>
                                            <v-col cols="12" sm="4" md="4">
                                                <v-text-field label="Código Pais" type="number"
                                                    v-model="editedItem.country_code">
                                                </v-text-field>
                                            </v-col>
                                            <v-col cols="12" sm="4" md="4">
                                                <v-text-field label="Descripción" v-model="editedItem.description">
                                                </v-text-field>
                                            </v-col>
                                            <v-col cols="12" sm="4" md="4">
                                                Color del Menú
                                                <v-text-field v-model="editedItem.color_menu" hide-details
                                                    class="ma-0 pa-0" solo hint="asdasd" persistent-hint>
                                                    <template v-slot:append>
                                                        <v-menu v-model="menu_color_menu" top nudge-bottom="105"
                                                            nudge-left="16" :close-on-content-click="false">
                                                            <template v-slot:activator="{ on }">
                                                                <div :style="swatchStyleMenu" v-on="on" />
                                                            </template>
                                                            <v-card>
                                                                <v-card-text class="pa-0">
                                                                    <v-color-picker v-model="editedItem.color_menu" flat
                                                                        dot-size="25" hide-inputs hide-sliders
                                                                        show-swatches swatches-max-height="250" />
                                                                </v-card-text>
                                                            </v-card>
                                                        </v-menu>
                                                    </template>
                                                </v-text-field>
                                            </v-col>

                                            <v-col cols="12" sm="4" md="4">
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
                                                                    <v-color-picker v-model="editedItem.color_sub_menu"
                                                                        flat hide-inputs hide-sliders show-swatches
                                                                        swatches-max-height="250" />
                                                                </v-card-text>
                                                            </v-card>
                                                        </v-menu>
                                                    </template>
                                                </v-text-field>
                                            </v-col>

                                            <v-col cols="12" sm="4" md="4">
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
                                                                    <v-color-picker v-model="editedItem.color_header"
                                                                        flat hide-inputs hide-sliders show-swatches
                                                                        swatches-max-height="250" />
                                                                </v-card-text>
                                                            </v-card>
                                                        </v-menu>
                                                    </template>
                                                </v-text-field>
                                            </v-col>

                                            <v-col cols="12" sm="4" md="4">
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
                                                                    <v-color-picker v-model="editedItem.color_footer"
                                                                        flat hide-inputs hide-sliders show-swatches
                                                                        swatches-max-height="250" />
                                                                </v-card-text>
                                                            </v-card>
                                                        </v-menu>
                                                    </template>
                                                </v-text-field>
                                            </v-col>

                                            <v-col cols="12" sm="4" md="4">
                                                Color de los textos
                                                <v-text-field v-model="editedItem.color_text" hide-details
                                                    class="ma-0 pa-0" solo>
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
                                            <v-col cols="9" sm="3" md="3">
                                                Logo Empresa
                                                <v-file-input v-model="editedItem.logo" @change="Preview_logo"
                                                    accept="image/*" placeholder="Cargar Logo" prepend-icon="mdi-camera"
                                                    label="Cargar Logo"></v-file-input>
                                            </v-col>
                                            <v-col cols="3" sm="1" md="1">
                                                <label for="logo">LOGO</label>
                                                <v-card max-height="50" max-width="50" :color="colorFondoImg">
                                                    <v-img aspect-ratio="2" contain height="50" width="50" :src="url">
                                                    </v-img>
                                                </v-card>
                                            </v-col>
                                        </v-row>
                                    </v-container>
                                </v-card-text>
                                <v-divider></v-divider>
                                <v-card-actions>
                                    <v-spacer></v-spacer>
                                    <v-btn type="submit" color="primary" @click="save">
                                        Guardar
                                    </v-btn>
                                </v-card-actions>
                            </v-card>
                            <v-snackbar v-model="hasSaved" color="light-green darken-1" :timeout="2000" absolute bottom
                                left>
                                Perfil Actualizado
                                correctamente
                            </v-snackbar>
                        </v-card>
                    </template>
                </v-flex>
            </v-layout>
        </v-container>

    </admin-layout>
</template>

<script>
import AdminLayout from '@/Layouts/AdminLayout'

export default {
    props: [
        'customizers',
        'companies',
        'company',
    ],
    components: {
        AdminLayout,
    },

    data() {
        return {

            hasSaved: false,
            isEditing: null,

            menu_color_menu: false,
            menu_color_sub_menu: false,
            menu_color_header: false,
            menu_color_footer: false,
            menu_color_text: false,
            colorFondoImg: this.customizers[0].color_menu,
            url: this.customizers[0].logo,

            editedItem: {
                companies_id: this.$page.props.user.companies_id,
                name: this.companies[0].name,
                ruc: this.companies[0].ruc,
                description: this.companies[0].description,
                phone: this.companies[0].phone,
                address: this.companies[0].address,
                department: this.companies[0].department,
                province: this.companies[0].province,
                district: this.companies[0].district,
                country_code: this.companies[0].country_code,
                customizers_id:this.customizers[0].id,
                color_menu: this.customizers[0].color_menu,
                color_sub_menu: this.customizers[0].color_sub_menu,
                color_header: this.customizers[0].color_header,
                color_footer: this.customizers[0].color_footer,
                color_text: this.customizers[0].color_text,
                logo: null,
            },
        }
    },
    computed: {
        swatchStyleMenu() {
            return {
                backgroundColor: this.editedItem.color_menu,
                cursor: 'pointer',
                height: '30px',
                width: '30px',
                borderRadius: this.menu_color_menu ? '50%' : '4px',
                transition: 'border-radius 200ms ease-in-out'
            }
        },
        swatchStyleSubMenu() {
            return {
                backgroundColor: this.editedItem.color_sub_menu,
                cursor: 'pointer',
                height: '30px',
                width: '30px',
                borderRadius: this.menu_color_sub_menu ? '50%' : '4px',
                transition: 'border-radius 200ms ease-in-out'
            }
        },

        swatchStyleHeader() {
            return {
                backgroundColor: this.editedItem.color_header,
                cursor: 'pointer',
                height: '30px',
                width: '30px',
                borderRadius: this.menu_color_header ? '50%' : '4px',
                transition: 'border-radius 200ms ease-in-out'
            }
        },

        swatchStyleFooter() {
            return {
                backgroundColor: this.editedItem.color_footer,
                cursor: 'pointer',
                height: '30px',
                width: '30px',
                borderRadius: this.menu_color_footer ? '50%' : '4px',
                transition: 'border-radius 200ms ease-in-out'
            }
        },

        swatchStyleText() {
            return {
                backgroundColor: this.editedItem.color_text,
                cursor: 'pointer',
                height: '30px',
                width: '30px',
                borderRadius: this.menu_color_text ? '50%' : '4px',
                transition: 'border-radius 200ms ease-in-out'
            }
        },
    },
    methods: {
        Preview_logo() {
            if (this.editedItem.logo == null) {
                this.url = '../../img/logo_user.png'
            } else {
                this.url = URL.createObjectURL(this.editedItem.logo)
            }
        },
        save() {
            this.isEditing = !this.isEditing;
            // this.$inertia.put(this.route('settings.update', this.editedItem), this.editedItem);
            // enviado formulario de actualizar    
            this.$inertia.post(route('settings.update', this.editedItem.companies_id), {
                _method: 'put',
                logo: this.editedItem.logo,

                companies_id: this.editedItem.companies_id,
                name: this.editedItem.name,
                ruc: this.editedItem.ruc,
                description: this.editedItem.description,
                phone: this.editedItem.phone,
                address: this.editedItem.address,
                department: this.editedItem.department,
                province: this.editedItem.province,
                district: this.editedItem.district,
                country_code: this.editedItem.country_code,
                customizers_id:this.editedItem.customizers_id,
                color_menu: this.editedItem.color_menu,
                color_sub_menu: this.editedItem.color_sub_menu,
                color_header: this.editedItem.color_header,
                color_footer: this.editedItem.color_footer,
                color_text: this.editedItem.color_text,

            })
            this.hasSaved = true;

        },
    },
}
</script>
