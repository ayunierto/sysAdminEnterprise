<template>
    <admin-layout>

        <template v-slot:company_name>
            <div>{{ company.name }}</div>
        </template>

        <v-container>
            <v-row>
                <!-- Caja chica -->
                <v-col cols="12" sm="4" md="3" class="mt-5" v-if="cajaChicaSoles > 0 || cajaChicaDolares>0">
                    <v-hover v-slot="{ hover }" open-delay="200">
                        <inertia-link :href="route('pettyCashes.index')">
                            <v-card color="light-green" :elevation="hover ? 16 : 2">
                                <v-row>
                                    <v-col cols="9" sm="9">
                                        <v-list-item three-line>
                                            <v-list-item-content>
                                                <div class="white--text">
                                                    <h4>S/. {{cajaChicaSoles}} <br> $. {{cajaChicaDolares}}</h4>
                                                </div>
                                                <v-list-item-subtitle class="white--text">CAJA CHICA
                                                </v-list-item-subtitle>
                                            </v-list-item-content>
                                        </v-list-item>
                                    </v-col>
                                    <v-col cols="3" sm="3">
                                        <v-avatar size="60" class="ml-n10 mt-5" tile>
                                            <v-img contain src="/img/dashboard/caja.png">
                                            </v-img>
                                        </v-avatar>
                                    </v-col>
                                </v-row>
                            </v-card>
                        </inertia-link>
                    </v-hover>
                </v-col>
                <!-- Productos -->
                <v-col cols="12" sm="4" md="3" class="mt-5">
                    <v-hover v-slot="{ hover }" open-delay="200">
                        <inertia-link :href="route('products.index')">
                            <v-card color="amber accent-2" :elevation="hover ? 16 : 2">
                                <v-row>
                                    <v-col cols="9" sm="9">
                                        <v-list-item three-line>
                                            <v-list-item-content>
                                                <div>
                                                    <v-list-item-title class="headline mb-2 white--text">
                                                        {{ products }}
                                                    </v-list-item-title>
                                                </div>
                                                <v-list-item-subtitle class="white--text">PRODUCTOS
                                                </v-list-item-subtitle>
                                            </v-list-item-content>
                                        </v-list-item>
                                    </v-col>
                                    <v-col cols="3" sm="3">
                                        <v-avatar size="60" class="ml-n10 mt-5" tile>
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
                                    <v-col cols="9" sm="9">
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
                                    <v-col cols="3" sm="3">
                                        <v-avatar size="60" class="ml-n10 mt-5" tile>
                                            <v-img contain src="/img/dashboard/services.png">
                                            </v-img>
                                        </v-avatar>
                                    </v-col>
                                </v-row>
                            </v-card>
                        </inertia-link>
                    </v-hover>
                </v-col>
                <!-- Ventas -->
                <v-col cols="12" sm="4" md="3" class="mt-5">
                    <v-hover v-slot="{ hover }" open-delay="200">
                        <inertia-link :href="route('orders.index')">
                            <v-card color="cyan darken-1" :elevation="hover ? 16 : 2">
                                <v-row>
                                    <v-col cols="9" sm="9">
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
                                    <v-col cols="3" sm="3">
                                        <v-avatar size="60" class="ml-n10 mt-5" tile>
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
                                    <v-col cols="9" sm="9">
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
                                    <v-col cols="3" sm="3">
                                        <v-avatar size="60" class="ml-n10 mt-5" tile>
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
                                    <v-col cols="9" sm="9">
                                        <v-list-item three-line>
                                            <v-list-item-content>
                                                <div>
                                                    <v-list-item-subtitle class="headline mb-1 white--text">
                                                        {{accountsR }}
                                                    </v-list-item-subtitle>
                                                </div>
                                                <v-list-item-subtitle class="white--text">CUENTAS X COBRAR
                                                </v-list-item-subtitle>
                                            </v-list-item-content>
                                        </v-list-item>
                                    </v-col>
                                    <v-col cols="3" sm="3">
                                        <v-avatar size="60" class="ml-n10 mt-5" tile>
                                            <v-img contain src="/img/dashboard/cobrar.png">
                                            </v-img>
                                        </v-avatar>
                                    </v-col>
                                </v-row>
                            </v-card>
                        </inertia-link>
                    </v-hover>
                </v-col>

                <!-- Cuetas por pAGAR -->
                <v-col cols="12" sm="4" md="3" class="mt-5">
                    <v-hover v-slot="{ hover }" open-delay="200">
                        <inertia-link :href="route('accountPayables.index')">
                            <v-card color="indigo lighten-4" :elevation="hover ? 16 : 2">
                                <v-row>
                                    <v-col cols="9" sm="9">
                                        <v-list-item three-line>
                                            <v-list-item-content>
                                                <div>
                                                    <v-list-item-subtitle class="headline mb-1 white--text">
                                                        {{accountsR }}
                                                    </v-list-item-subtitle>
                                                </div>
                                                <v-list-item-subtitle class="white--text">CUENTAS X PAGAR
                                                </v-list-item-subtitle>
                                            </v-list-item-content>
                                        </v-list-item>
                                    </v-col>
                                    <v-col cols="3" sm="3">
                                        <v-avatar size="60" class="ml-n10 mt-5" tile>
                                            <v-img contain src="/img/dashboard/pagar.png">
                                            </v-img>
                                        </v-avatar>
                                    </v-col>
                                </v-row>
                            </v-card>
                        </inertia-link>
                    </v-hover>
                </v-col>

                <!-- Grafica de ventas -->
                <!-- <v-col cols="12" sm="4" md="3" class="mt-2">
                    <v-card class="mx-auto text-center" color="green" dark>
                        <v-card-text>
                            <div class="text-h5 font-weight-thin" style="height: 10px;">
                                VENTAS DIARIAS
                            </div>
                        </v-card-text>
                        <v-card-text>
                            <v-sheet color="transparent">
                                <v-sparkline auto-draw :value="datos" :labels="texto" color="rgba(255, 255, 255, .7)"
                                    height="40" line-width="1" smooth>
                                </v-sparkline>
                            </v-sheet>
                        </v-card-text>

                        <v-divider></v-divider>

                        <v-card-actions class="justify-center">
                            <v-btn block text>
                                DESCARGAR REPORTE
                            </v-btn>
                        </v-card-actions>
                    </v-card>
                </v-col> -->
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

    props: ['products', 'services', 'company', 'orders',
        'totalVentSol', 'totalVentDolar', 'purchases', 'accountsR', 'cajaChicaSoles', 'cajaChicaDolares'],

    data() {
        return {
            search: '',
            // datos: [
            //     10,
            //     23,
            //     34,
            //     9,
            //     18,
            //     24,
            //     36,
            // ],
            // texto: [
            //     'LU',
            //     'MA',
            //     'MI',
            //     'JU',
            //     'VI',
            //     'SA',
            //     'DO',
            // ],
        }
    },
}
</script>