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
                                            <v-text-field :disabled="!isEditing" label="Nombre/Razon Social">
                                            </v-text-field>
                                        </v-col>
                                        <v-col cols="12" sm="4" md="4">
                                            <v-text-field :disabled="!isEditing" label="Ruc" type="number">
                                            </v-text-field>
                                        </v-col>
                                        <v-col cols="12" sm="4" md="4">
                                            <v-text-field :disabled="!isEditing" label="Teléfono"></v-text-field>
                                        </v-col>
                                        <v-col cols="12" sm="4" md="4">
                                            <v-text-field :disabled="!isEditing" label="Dirección"></v-text-field>
                                        </v-col>
                                        <v-col cols="12" sm="4" md="4">
                                            <v-text-field :disabled="!isEditing" label="Departamento"></v-text-field>
                                        </v-col>
                                        <v-col cols="12" sm="4" md="4">
                                            <v-text-field :disabled="!isEditing" label="Provincia"></v-text-field>
                                        </v-col>
                                        <v-col cols="12" sm="4" md="4">
                                            <v-text-field :disabled="!isEditing" label="Distrito"></v-text-field>
                                        </v-col>
                                        <v-col cols="12" sm="4" md="4">
                                            <v-text-field :disabled="!isEditing" label="Código Pais" type="number">
                                            </v-text-field>
                                        </v-col>
                                        <v-col cols="12" sm="4" md="4">
                                            <v-text-field :disabled="!isEditing" label="Descripción"></v-text-field>
                                        </v-col>
                                        <v-col cols="12" sm="4" md="4">
                                            <v-file-input :disabled="!isEditing" :rules="rules"
                                                accept="image/png, image/jpeg, image/bmp" placeholder="Cargar logo"
                                                prepend-icon="mdi-image" label="Logo"></v-file-input>
                                        </v-col>
                                        <v-col cols="12" sm="4" md="4">
                                            <v-card max-width="50" max-height="50" elevation-11>
                                                <v-img
                                                    src="https://www.zarla.com/images/zarla-soluciona-1x1-2400x2400-20210603-xv6xrmkbpk3ggkjb6869.png?crop=1:1,smart&width=250&dpr=2"
                                                    alt="Logo"></v-img>
                                            </v-card>
                                        </v-col>
                                    </v-row>
                                </v-container>
                            </v-card-text>
                            <v-divider></v-divider>
                            <v-card-actions>
                                <v-spacer></v-spacer>
                                <v-btn :disabled="!isEditing" color="primary" @click="save">
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
        'customizers',
    ],
    components: {
        AdminLayout,
    },

    data: () => ({
        hasSaved: false,
        isEditing: null,
        rules: [
            (value) =>
                !value ||
                value.size < 2000000 ||
                "El logo no puede exeder los 2 MB!",
        ],
    }),
    methods: {
        save() {
            this.isEditing = !this.isEditing;
            this.hasSaved = true;
        },
    },
}
</script>
