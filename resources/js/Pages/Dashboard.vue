<template>
    <admin-layout>

        <template v-slot:company_name>
            <div>{{ company.name }}</div>
        </template>

        <v-container>
            <v-row>
                <!-- Productos -->
                <v-col cols="12" sm="4" md="3" class="mt-5">
                    <v-hover v-slot="{ hover }" open-delay="200">
                        <inertia-link :href="route('products.index')">
                            <v-card color="amber accent-2" :elevation="hover ? 16 : 2">
                                <v-row>
                                    <v-col cols="8" sm="8">
                                        <v-list-item three-line>
                                            <v-list-item-content>
                                                <div>
                                                    <v-list-item-title class="headline mb-1 white--text">
                                                        {{ products }}
                                                    </v-list-item-title>
                                                </div>
                                                <v-list-item-subtitle class="white--text ma-0">PRODUCTOS
                                                </v-list-item-subtitle>
                                            </v-list-item-content>
                                        </v-list-item>
                                    </v-col>
                                    <v-col cols="4" sm="4">
                                        <v-avatar size="85" class="ml-n10 mt-6" tile>
                                            <v-img contain src="/img/dashboard/productos.png">
                                            </v-img>
                                        </v-avatar>
                                    </v-col>
                                </v-row>
                            </v-card>
                        </inertia-link>
                    </v-hover>
                </v-col>
                <!-- Servicios -->
                <v-col cols="12" sm="4" md="3" class="mt-5" v-if="this.services>0" v-show="true">
                    <v-hover v-slot="{ hover }" open-delay="200">
                        <inertia-link :href="route('services.index')">
                            <v-card color="blue-grey" :elevation="hover ? 16 : 2">
                                <v-row>
                                    <v-col cols="8" sm="8">
                                        <v-list-item three-line>
                                            <v-list-item-content>
                                                <div>
                                                    <v-list-item-title class="headline mb-1 white--text">
                                                        {{ services }}
                                                    </v-list-item-title>
                                                </div>
                                                <v-list-item-subtitle class="white--text ma-0">SERVICIOS
                                                </v-list-item-subtitle>
                                            </v-list-item-content>
                                        </v-list-item>
                                    </v-col>
                                    <v-col cols="4" sm="4">
                                        <v-avatar size="85" class="ml-n10 mt-6" tile>
                                            <v-img contain src="/img/dashboard/services.png">
                                            </v-img>
                                        </v-avatar>
                                    </v-col>
                                </v-row>
                            </v-card>
                        </inertia-link>
                    </v-hover>
                </v-col>
                <!-- Caja Soles -->
                <v-col cols="12" sm="4" md="3" class="mt-5">
                    <v-hover v-slot="{ hover }" open-delay="200">
                        <v-card color="light-green" :elevation="hover ? 16 : 2">
                            <v-row>
                                <v-col cols="8" sm="8">
                                    <v-list-item three-line>
                                        <v-list-item-content>
                                            <div>
                                                <v-list-item-subtitle class="headline mb-1 white--text">
                                                    S/ {{totalVentSol }}
                                                </v-list-item-subtitle>
                                            </div>
                                            <v-list-item-subtitle class="white--text">CAJA SOLES
                                            </v-list-item-subtitle>
                                        </v-list-item-content>
                                    </v-list-item>
                                </v-col>
                                <v-col cols="4" sm="4">
                                    <v-avatar size="85" class="ml-n10 mt-6" tile>
                                        <v-img contain src="/img/dashboard/caja.png">
                                        </v-img>
                                    </v-avatar>
                                </v-col>
                            </v-row>
                        </v-card>
                    </v-hover>
                </v-col>
                <!-- Caja Dolares -->
                <v-col cols="12" sm="4" md="3" class="mt-5">
                    <v-hover v-slot="{ hover }" open-delay="200">
                        <v-card color="green darken-1" :elevation="hover ? 16 : 2">
                            <v-row>
                                <v-col cols="8" sm="8">
                                    <v-list-item three-line>
                                        <v-list-item-content>
                                            <div>
                                                <v-list-item-subtitle class="headline mb-1 white--text">
                                                    $. {{totalVentDolar }}
                                                </v-list-item-subtitle>
                                            </div>
                                            <v-list-item-subtitle class="white--text">CAJA DOLARES
                                            </v-list-item-subtitle>
                                        </v-list-item-content>
                                    </v-list-item>
                                </v-col>
                                <v-col cols="4" sm="4">
                                    <v-avatar size="85" class="ml-n10 mt-6" tile>
                                        <v-img contain src="/img/dashboard/cajadolares.png">
                                        </v-img>
                                    </v-avatar>
                                </v-col>
                            </v-row>
                        </v-card>
                    </v-hover>
                </v-col>
                <!-- Ventas -->
                <v-col cols="12" sm="4" md="3" class="mt-5">
                    <v-hover v-slot="{ hover }" open-delay="200">
                        <inertia-link :href="route('orders.index')">
                            <v-card color="cyan darken-1" :elevation="hover ? 16 : 2">
                                <v-row>
                                    <v-col cols="8" sm="8">
                                        <v-list-item three-line>
                                            <v-list-item-content>
                                                <div>

                                                    <v-list-item-title class="headline mb-1 white--text">
                                                        {{ orders }}
                                                    </v-list-item-title>

                                                </div>
                                                <v-list-item-subtitle class="white--text">VENTAS DEL DÍA
                                                </v-list-item-subtitle>
                                            </v-list-item-content>
                                        </v-list-item>
                                    </v-col>
                                    <v-col cols="4" sm="4">
                                        <v-avatar size="85" class="ml-n10 mt-6" tile>
                                            <v-img contain src="/img/dashboard/ventas.png">
                                            </v-img>
                                        </v-avatar>
                                    </v-col>
                                </v-row>
                            </v-card>
                        </inertia-link>
                    </v-hover>
                </v-col>
                <!-- Compras -->
                <v-col cols="12" sm="4" md="3" class="mt-5">
                    <v-hover v-slot="{ hover }" open-delay="200">
                        <inertia-link :href="route('purchases.index')">
                            <v-card color="yellow darken-4" :elevation="hover ? 16 : 2">
                                <v-row>
                                    <v-col cols="8" sm="8">
                                        <v-list-item three-line>
                                            <v-list-item-content>
                                                <div>

                                                    <v-list-item-title class="headline mb-1 white--text">
                                                        {{ purchases }}
                                                    </v-list-item-title>

                                                </div>

                                                <v-list-item-subtitle class="white--text">COMPRAS DEL DÍA
                                                </v-list-item-subtitle>
                                            </v-list-item-content>
                                        </v-list-item>
                                    </v-col>
                                    <v-col cols="4" sm="4">
                                        <v-avatar size="85" class="ml-n10 mt-6" tile>
                                            <v-img contain src="/img/dashboard/compras.png">
                                            </v-img>
                                        </v-avatar>
                                    </v-col>
                                </v-row>
                            </v-card>
                        </inertia-link>
                    </v-hover>
                </v-col>      
                <!-- Cuetas por Cobrar -->
                <v-col cols="12" sm="4" md="3" class="mt-5">
                    <v-hover v-slot="{ hover }" open-delay="200">
                        <inertia-link :href="route('accountReceivables.index')">
                        <v-card color="orange accent-2" :elevation="hover ? 16 : 2">
                            <v-row>
                                <v-col cols="8" sm="8">
                                    <v-list-item three-line>
                                        <v-list-item-content>
                                            <div>
                                                <v-list-item-subtitle class="headline mb-1 white--text">
                                                    {{accountsR }}
                                                </v-list-item-subtitle>
                                            </div>
                                            <v-list-item-subtitle class="white--text">CUENTAS POR COBRAR
                                            </v-list-item-subtitle>
                                        </v-list-item-content>
                                    </v-list-item>
                                </v-col>
                                <v-col cols="4" sm="4">
                                    <v-avatar size="85" class="ml-n10 mt-6" tile>
                                        <v-img contain src="/img/dashboard/cobrar.png">
                                        </v-img>
                                    </v-avatar>
                                </v-col>
                            </v-row>
                        </v-card>
                    </inertia-link>
                    </v-hover>
                </v-col>          
                <!-- Grafica de ventas -->
                <!-- <v-col cols="12" sm="4" md="9" class="mt-5">
                    <v-card class="mx-auto text-center" color="green" dark>
                        <v-card-text>
                            <v-sheet color="rgba(0, 0, 0, .12)">
                                <v-sparkline :value="value" color="rgba(255, 255, 255, .7)" height="50" line-width="1"
                                    smooth>
                                    <template v-slot:label="item">
                                        ${{ item.value }}
                                    </template>
                                </v-sparkline>
                            </v-sheet>
                        </v-card-text>

                        <v-card-text>
                            <div class="text-h4 font-weight-thin">
                                Sales Last 24h
                            </div>
                        </v-card-text>

                        <v-divider></v-divider>

                        <v-card-actions class="justify-center">
                            <v-btn block text>
                                Go to Report
                            </v-btn>
                        </v-card-actions>
                    </v-card>
                </v-col> -->
                <!-- Tabla Productos -->
                <v-col cols="12" class="mt-3">
                    <v-card elevation="24" color="blue lighten-4" outlined>
                        <v-card-title>
                            PRODUCTOS CON BAJO STOCK
                            <v-spacer></v-spacer>
                            <v-text-field v-model="search" append-icon="mdi-magnify" label="Buscar" single-line
                                hide-details></v-text-field>
                            <v-spacer></v-spacer>
                            <inertia-link :href="route('purchases.create')">
                                <v-btn color="primary" dark class="mb-2">
                                    COMPRAR
                                </v-btn>
                            </inertia-link>
                        </v-card-title>
                        <v-data-table :headers="[
                        {text: 'Producto', value: 'name'},
                        {text: 'Marca', value: 'nameMark'},
                        {text: 'Almacén', value: 'nameWarehouse'},
                        {text: 'Stock', value: 'stock', align: 'center',},
                        {text: 'Stock Mínimo', value: 'stock_min', align: 'center',},
                        {text: 'Descripción', value: 'description'}]" :items="stock_min" :items-per-page="5"
                            class="elevation-1" dense :search="search" locale="es">
                            <template v-slot:[`item.stock_min`]="{ item }">
                                <v-chip color="warning" dark>
                                    {{ item.stock_min }}
                                </v-chip>
                            </template>
                            <template v-slot:no-data>
                                No hay productos con stock mínimo
                            </template>
                        </v-data-table>
                    </v-card>
                </v-col>

            </v-row>
        </v-container>
    </admin-layout>
</template>

<script>
import AdminLayout from '@/Layouts/AdminLayout'

export default {
    components: {
        AdminLayout,
    },

    props: ['products', 'services', 'company', 'stock_min', 'orders', 
    'totalVentSol', 'totalVentDolar', 'purchases','accountsR'],

    data() {
        return {
            search: '',
            // value: [
            //     423,
            //     446,
            //     675,
            //     510,
            //     590,
            //     610,
            //     760,
            // ],
        }
    },
}
</script>