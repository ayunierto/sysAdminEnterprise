<template>
    <admin-layout>

        <template v-slot:company_name>
            <div>{{ company.name }}</div>
        </template>

        <v-container>
            <v-row>
                <!-- <v-col cols="12" sm="6" md="4">
                    <v-card rounded>
                        <v-list-item three-line>
                            <v-list-item-content>
                                <div class="text-overline mb-4">
                                    PRODUCTOS
                                </div>
                                <v-list-item-title class="text-h5 mb-1">
                                    {{ products }}
                                </v-list-item-title>
                            </v-list-item-content>
                            <v-list-item-avatar tile size="80">
                                <v-img
                                    src="https://st.depositphotos.com/1378583/4449/v/600/depositphotos_44495673-stock-illustration-home-repair-logo.jpg">
                                </v-img>
                            </v-list-item-avatar>
                        </v-list-item>

                        <v-card-actions>
                            <inertia-link :href="route('products.index')">
                                <v-btn outlined rounded text>
                                    VER MÁS
                                </v-btn>
                            </inertia-link>
                        </v-card-actions>
                    </v-card>
                </v-col> -->
                <v-col cols="12" sm="6" md="3" class="mt-5">
                    <v-hover v-slot="{ hover }" open-delay="200">
                        <v-card color="amber accent-2" :elevation="hover ? 16 : 2">
                            <v-row>
                                <v-col cols="8" sm="8">
                                    <v-list-item three-line>
                                        <v-list-item-content>
                                            <div>
                                                <inertia-link :href="route('products.index')">
                                                    <v-btn fab color="amber accent-1" elevation="0">
                                                        <v-icon color="white">mdi-one-up</v-icon>
                                                    </v-btn>
                                                </inertia-link>
                                            </div>
                                            <v-list-item-title class="headline mb-1 white--text">
                                                {{ products }}
                                            </v-list-item-title>
                                            <v-list-item-subtitle class="white--text ma-0">PRODUCTOS
                                            </v-list-item-subtitle>
                                        </v-list-item-content>
                                    </v-list-item>
                                </v-col>
                                <v-col cols="4" sm="4">
                                    <v-avatar size="85" class="ml-n10 mt-6" tile>
                                        <v-img contain src="https://cdn-icons-png.flaticon.com/512/743/743007.png">
                                        </v-img>
                                    </v-avatar>
                                </v-col>
                            </v-row>
                        </v-card>
                    </v-hover>
                </v-col>
                <v-col cols="12" sm="6" md="3" class="mt-5">
                    <v-hover v-slot="{ hover }" open-delay="200">
                        <v-card color="cyan darken-1" :elevation="hover ? 16 : 2">
                            <v-row>
                                <v-col cols="8" sm="8">
                                    <v-list-item three-line>
                                        <v-list-item-content>
                                            <div>
                                                <inertia-link :href="route('orders.index')">
                                                    <v-btn fab color="cyan lighten-2" elevation="0">
                                                        <v-icon color="white">mdi-cart</v-icon>
                                                    </v-btn>
                                                </inertia-link>
                                            </div>
                                            <v-list-item-title class="headline mb-1 white--text">
                                                {{ orders }}
                                            </v-list-item-title>
                                            <v-list-item-subtitle class="white--text">VENTAS DEL DÍA
                                            </v-list-item-subtitle>
                                        </v-list-item-content>
                                    </v-list-item>
                                </v-col>
                                <v-col cols="4" sm="4">
                                    <v-avatar size="85" class="ml-n10 mt-6" tile>
                                        <v-img contain
                                            src="https://images.vexels.com/media/users/3/205437/isolated/preview/1d84c7d31a188b47fe75640a85af8d9c-icono-de-trazo-de-venta-de-compras-en-linea.png">
                                        </v-img>
                                    </v-avatar>
                                </v-col>
                            </v-row>
                        </v-card>
                    </v-hover>
                </v-col>
                <v-col cols="12" sm="6" md="3" class="mt-5">
                    <v-hover v-slot="{ hover }" open-delay="200">
                        <v-card color="light-green" :elevation="hover ? 16 : 2">
                            <v-row>
                                <v-col cols="8" sm="8">
                                    <v-list-item three-line>
                                        <v-list-item-content>
                                            <div>
                                                <v-btn fab color="light-green lighten-1" elevation="0">
                                                    <v-icon color="white">mdi-currency-usd</v-icon>
                                                </v-btn>
                                            </div>
                                            <v-list-item-title class="headline mb-1 white--text">
                                                {{totalVent }}
                                            </v-list-item-title>
                                            <v-list-item-subtitle class="white--text">CAJA
                                            </v-list-item-subtitle>
                                        </v-list-item-content>
                                    </v-list-item>
                                </v-col>
                                <v-col cols="4" sm="4">
                                    <v-avatar size="85" class="ml-n10 mt-6" tile>
                                        <v-img contain
                                            src="https://play-lh.googleusercontent.com/NbBfE5lM2isTNrGLiksDl1v49boQP_APd3LvHDSq2WO3iICB7zpe6J3TgHd5FSnEYfBw">
                                        </v-img>
                                    </v-avatar>
                                </v-col>
                            </v-row>
                        </v-card>
                    </v-hover>
                </v-col>
                <v-col cols="12" sm="6" md="3" class="mt-5">
                    <v-hover v-slot="{ hover }" open-delay="200">
                        <v-card color="yellow darken-4" :elevation="hover ? 16 : 2">
                            <v-row>
                                <v-col cols="8" sm="8">
                                    <v-list-item three-line>
                                        <v-list-item-content>
                                            <div>
                                                <inertia-link :href="route('purchases.index')">
                                                    <v-btn fab color="yellow darken-3" elevation="0">
                                                        <v-icon color="white">mdi-account-cash-outline</v-icon>
                                                    </v-btn>
                                                </inertia-link>
                                            </div>
                                            <v-list-item-title class="headline mb-1 white--text">
                                                {{ purchases }}
                                            </v-list-item-title>
                                            <v-list-item-subtitle class="white--text">COMPRAS DEL DÍA
                                            </v-list-item-subtitle>
                                        </v-list-item-content>
                                    </v-list-item>
                                </v-col>
                                <v-col cols="4" sm="4">
                                    <v-avatar size="85" class="ml-n10 mt-6" tile>
                                        <v-img contain
                                            src="https://png.pngtree.com/png-vector/20220719/ourmid/pngtree-shopping-chart-3d-icon-png-image_6006290.png">
                                        </v-img>
                                    </v-avatar>
                                </v-col>
                            </v-row>
                        </v-card>
                    </v-hover>
                </v-col>
                <v-col cols="12" class="mt-3">
                    <v-card elevation="24" color="blue lighten-4" outlined>
                        <v-card-title>
                            PRODUCTOS CON BAJO STOCK
                            <v-spacer></v-spacer>
                            <v-text-field v-model="search" append-icon="mdi-magnify" label="Buscar" single-line
                                hide-details></v-text-field>
                        </v-card-title>
                        <v-data-table :headers="[
                            {text: 'Producto', value: 'name'},
                            {text: 'Stock', value: 'stock', align: 'center',},
                            {text: 'Stock Mínimo', value: 'stock_min', align: 'center',},
                            {text: 'Descripción', value: 'description'}
                        ]" :items="stock_min" :items-per-page="5" class="elevation-1" dense :search="search"
                            locale="es">
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

    props: ['products', 'company', 'stock_min', 'orders', 'totalVent', 'purchases'],

    data() {
        return {
            search: '',
        }
    },
}
</script>
