<template>
    <admin-layout>

        <template v-slot:company_name>
            <div>{{ company.name }}</div>
        </template>

        <v-container>
            <v-row>
                <!-- Caja chica -->
                <v-col cols="12" sm="4" md="3" class="mt-5" v-if="cajaE==1">
                    <v-hover v-slot="{ hover }" open-delay="200">
                        <inertia-link :href="route('pettyCashes.index')">
                            <v-card color="light-green" :elevation="hover ? 16 : 2">
                                <v-row>
                                    <v-col cols="9" sm="9">
                                        <v-list-item three-line>
                                            <v-list-item-content>
                                                <div class="white--text">
                                                    <h4>S/. {{cajaChicaSoles}}</h4>
                                                    <h4>$. {{cajaChicaDolares}}</h4>
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
                                                <div class="white--text">
                                                    <v-list-item-subtitle class="headline mb-1 white--text">
                                                        {{products}}
                                                    </v-list-item-subtitle>
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

                <!-- Vender -->
                <v-col cols="12" sm="4" md="3" class="mt-5">
                    <v-hover v-slot="{ hover }" open-delay="200">
                        <inertia-link :href="route('orders.create')">
                            <v-card color="teal darken-1" :elevation="hover ? 16 : 2">
                                <v-row>
                                    <v-col cols="9" sm="9">
                                        <v-list-item three-line>
                                            <v-list-item-content>
                                                <v-list-item-subtitle class="white--text">VENDER
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

                <!-- Comprar -->
                <v-col cols="12" sm="4" md="3" class="mt-5">
                    <v-hover v-slot="{ hover }" open-delay="200">
                        <inertia-link :href="route('purchases.create')">
                            <v-card color="green " :elevation="hover ? 16 : 2">
                                <v-row>
                                    <v-col cols="9" sm="9">
                                        <v-list-item three-line>
                                            <v-list-item-content>
                                                <v-list-item-subtitle class="white--text">COMPRAR
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

                <!-- Cuentas por Cobrar -->
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

                <!-- Cuetas por Pagar -->
                <v-col cols="12" sm="4" md="3" class="mt-5">
                    <v-hover v-slot="{ hover }" open-delay="200">
                        <inertia-link :href="route('accountPayables.index')">
                            <v-card color="red darken-1" :elevation="hover ? 16 : 2">
                                <v-row>
                                    <v-col cols="9" sm="9">
                                        <v-list-item three-line>
                                            <v-list-item-content>
                                                <div>
                                                    <v-list-item-subtitle class="headline mb-1 white--text">
                                                        {{accountsP }}
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

                <!-- Reportes del Día -->
                <v-col cols="12" sm="4" md="3" class="mt-5">
                    <v-hover v-slot="{ hover }" open-delay="200">
                        <inertia-link :href="route('reports.index')">
                            <v-card color="deep-orange accent-2" :elevation="hover ? 16 : 2">
                                <v-row>
                                    <v-col cols="9" sm="9">
                                        <v-list-item three-line>
                                            <v-list-item-content>
                                                <v-list-item-subtitle class="white--text">REPORTES
                                                </v-list-item-subtitle>
                                            </v-list-item-content>
                                        </v-list-item>
                                    </v-col>
                                    <v-col cols="3" sm="3">
                                        <v-avatar size="60" class="ml-n10 mt-5" tile>
                                            <v-img contain src="/img/dashboard/reportes.png">
                                            </v-img>
                                        </v-avatar>
                                    </v-col>
                                </v-row>
                            </v-card>
                        </inertia-link>
                    </v-hover>
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

    props: ['products', 'services', 'company', 'orders',
        'totalVentSol', 'totalVentDolar', 'purchases', 'accountsR', 'accountsP',
        'cajaChicaSoles', 'cajaChicaDolares', 'cajaE'],

    data() {
        return {
            search: '',
        }
    },
}
</script>