<template>
    <admin-layout>

        <template v-slot:company_name>
            <div>{{ company.name }}</div>
        </template>
        <!-- Fin de Alertas -->
        <v-container>
            <v-layout>
                <v-flex>
                    <template>
                        <v-card class="overflow-hidden">
                            <v-toolbar flat color="white">
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
                            <v-card-text>
                                        <v-container>
                                            <v-row>
                                                <v-col cols="12" sm="4" md="4">
                                                    <v-text-field :disabled="!isEditing" label="Nombre/Razon Social"
                                                        v-model="editedItem.name">
                                                    </v-text-field>
                                                </v-col>
                                                <v-col cols="12" sm="4" md="4">
                                                    <v-text-field :disabled="!isEditing" label="Ruc" type="number"
                                                        v-model="editedItem.ruc">
                                                    </v-text-field>
                                                </v-col>
                                                <v-col cols="12" sm="4" md="4">
                                                    <v-text-field :disabled="!isEditing" label="Teléfono"
                                                        v-model="editedItem.phone"></v-text-field>
                                                </v-col>
                                                <v-col cols="12" sm="4" md="4">
                                                    <v-text-field :disabled="!isEditing" label="Dirección"
                                                        v-model="editedItem.address"></v-text-field>
                                                </v-col>
                                                <v-col cols="12" sm="4" md="4">
                                                    <v-text-field :disabled="!isEditing" label="Departamento"
                                                        v-model="editedItem.department"></v-text-field>
                                                </v-col>
                                                <v-col cols="12" sm="4" md="4">
                                                    <v-text-field :disabled="!isEditing" label="Provincia"
                                                        v-model="editedItem.province"></v-text-field>
                                                </v-col>
                                                <v-col cols="12" sm="4" md="4">
                                                    <v-text-field :disabled="!isEditing" label="Distrito"
                                                        v-model="editedItem.district"></v-text-field>
                                                </v-col>
                                                <v-col cols="12" sm="4" md="4">
                                                    <v-text-field :disabled="!isEditing" label="Código Pais"
                                                        type="number" v-model="editedItem.country_code">
                                                    </v-text-field>
                                                </v-col>
                                                <v-col cols="12" sm="4" md="4">
                                                    <v-text-field :disabled="!isEditing" label="Descripción"
                                                        v-model="editedItem.description"></v-text-field>
                                                </v-col>
                                            </v-row>
                                        </v-container>
                            </v-card-text>
                            <v-divider></v-divider>
                            <v-card-actions>
                                <v-spacer></v-spacer>
                                <v-btn type="submit" :disabled="!isEditing" color="primary" @click="save">
                                    Guardar
                                </v-btn>
                            </v-card-actions>
                            <v-snackbar v-model="hasSaved" :timeout="2000" absolute bottom left>
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
        'settings',
        'company',
    ],
    components: {
        AdminLayout,
    },

    data() {
        return {
            hasSaved: false,
            isEditing: null,

            editedItem: {
                id: this.$page.props.company.id,
                name: this.$page.props.settings[0].name,
                ruc: this.$page.props.settings[0].ruc,
                description: this.$page.props.settings[0].description,
                phone: this.$page.props.settings[0].phone,
                address: this.$page.props.settings[0].address,
                department: this.$page.props.settings[0].department,
                province: this.$page.props.settings[0].province,
                district: this.$page.props.settings[0].district,
                country_code: this.$page.props.settings[0].country_code,
            },
        }
    },
    methods: {
        save() {
            this.isEditing = !this.isEditing;
            this.$inertia.put(this.route('settings.update',this.editedItem.id), this.editedItem);
            this.hasSaved = true;
        },
    },
}
</script>
