
<template>
    <admin-layout>
        <v-card color="blue lighten-5">
            <v-tabs fixed-tabs icons-and-text color="green lighten-1">
                <v-tab>
                    VENTAS DEL DÍA
                </v-tab>
                <v-tab>
                    COMPRAS DEL DÍA
                </v-tab>
                <v-tab>
                    QRCode
                </v-tab>
                <v-tab>
                    QRCode
                </v-tab>
                <!-- Ventas del día -->
                <v-tab-item><br>
                    <v-card elevation="0">
                        <v-container>
                            <v-row>
                                <v-card class="mx-auto" max-width="180" outlined>
                                    <v-list-item three-line>
                                        <v-list-item-content>
                                            <div>
                                                N° VENTAS
                                            </div>
                                            <v-list-item-title>
                                                5
                                            </v-list-item-title>
                                        </v-list-item-content>

                                        <v-list-item-avatar tile size="50">
                                            <v-img contain src="/img/dashboard/ventas.png">
                                            </v-img>
                                        </v-list-item-avatar>
                                    </v-list-item>
                                </v-card>
                                <v-card class="mx-auto" max-width="180" outlined>
                                    <v-list-item three-line>
                                        <v-list-item-content>
                                            <div>
                                                MONTO VENTAS
                                            </div>
                                            <v-list-item-title>
                                                5
                                            </v-list-item-title>
                                        </v-list-item-content>

                                        <v-list-item-avatar tile size="50">
                                            <v-img contain src="/img/dashboard/ventas.png">
                                            </v-img>
                                        </v-list-item-avatar>
                                    </v-list-item>
                                </v-card>
                                <v-card class="mx-auto" max-width="180" outlined>
                                    <v-list-item three-line>
                                        <v-list-item-content>
                                            <div>
                                                GANANCIAS
                                            </div>
                                            <v-list-item-title>
                                                5
                                            </v-list-item-title>
                                        </v-list-item-content>

                                        <v-list-item-avatar tile size="50">
                                            <v-img contain src="/img/dashboard/ventas.png">
                                            </v-img>
                                        </v-list-item-avatar>
                                    </v-list-item>
                                </v-card>
                            </v-row>
                        </v-container>
                    </v-card>
                    <v-data-table :headers="ventasDia" :items="desserts" sort-by="name" class="elevation-24"
                        :search="search">
                    </v-data-table>
                </v-tab-item>
                <!-- Ganancias del dia -->
                <v-tab-item>
                    <v-data-table :headers="comprasDia" :items="desserts" sort-by="name" class="elevation-24"
                        :search="search">
                    </v-data-table>
                </v-tab-item>
            </v-tabs>
        </v-card>
    </admin-layout>
</template>
<script>
import AdminLayout from '@/Layouts/AdminLayout'
export default {
    name: 'hello',
    components: {
        AdminLayout,
    },
    data() {
        return {
            search: '',
            ventasDia: [
                { text: 'NOMBRE', value: 'name' },
                { text: 'DESCRIPCION', value: 'description' },
                { text: 'ACCIONES', value: 'actions', sortable: false },
            ],
            comprasDia: [
                { text: 'hola', value: 'name' },
                { text: 'hola', value: 'description' },
                { text: 'ACCIONES', value: 'actions', sortable: false },
            ],
        }
    },
    methods: {
    },
}
</script>
