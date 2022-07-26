<template>
    <v-app>
        <!-- memú vertical y horizontal -->
        <template>
            <!-- Menú vertical -->
            <v-navigation-drawer app v-model="drawer">
                <v-list>
                    <v-list-item class="px-2">
                        <v-list-item-avatar>
                            <v-img
                            src="https://www.zarla.com/images/zarla-soluciona-1x1-2400x2400-20210603-xv6xrmkbpk3ggkjb6869.png?crop=1:1,smart&width=250&dpr=2"
                            ></v-img>
                        </v-list-item-avatar>
                        <v-list-item-title class="text-h6">ALPA PERÚ</v-list-item-title>
                    </v-list-item>

                    <v-list-item link>
                        <v-list-item-content>
                            <v-list-item-subtitle>correo@gmail.com</v-list-item-subtitle>
                        </v-list-item-content>
                    </v-list-item>
                </v-list>
                <!-- linea divisoria -->
                <v-divider></v-divider>

                <!-- CONTENIDO MENU VERTICAL -->
                <v-list nav dense>

                <v-list-item-group color="primary">

                    <inertia-link :href="route('dashboard')" >
                        <v-list-item link>
                            <v-list-item-icon>
                                <v-icon>mdi-monitor-multiple</v-icon>
                            </v-list-item-icon>

                            <v-list-item-content>
                                <v-list-item-title>INICIO</v-list-item-title>
                            </v-list-item-content>
                        </v-list-item>
                    </inertia-link>

                    <inertia-link :href="route('companies.index')" >
                        <v-list-item link>
                            <v-list-item-icon>
                                <v-icon>mdi-monitor-multiple</v-icon>
                            </v-list-item-icon>

                            <v-list-item-content>
                                <v-list-item-title>EMPRESAS</v-list-item-title>
                            </v-list-item-content>
                        </v-list-item>
                    </inertia-link>

                    <v-list-item link>
                        <v-list-item-icon>
                            <v-icon>mdi-cart</v-icon>
                        </v-list-item-icon>
                        <v-list-item-content>
                            <v-list-item-title>VENTAS</v-list-item-title>
                        </v-list-item-content>
                    </v-list-item>

                    <v-list-item link>
                        <v-list-item-icon>
                            <v-icon>mdi-cash-multiple</v-icon>
                        </v-list-item-icon>
                        <v-list-item-content>
                            <v-list-item-title>COMPRAS</v-list-item-title>
                        </v-list-item-content>
                    </v-list-item>

                    <v-list-group prepend-icon="mdi-cube" color="primary">

                        <template v-slot:activator>
                            <v-list-item-content>
                            <v-list-item-title>PRODUCTOS</v-list-item-title>
                            </v-list-item-content>
                        </template>

                    <v-list-item-group color="primary">

                        <inertia-link :href="route('products.index')">
                            <v-list-item link>
                                <v-list-item-icon>
                                    <v-spacer></v-spacer>
                                    <v-icon small>mdi-cash-multiple</v-icon>
                                </v-list-item-icon>

                                    <v-list-item-title>LISTA PRODUCTOS</v-list-item-title>
                            </v-list-item>
                        </inertia-link>

                        <v-list-item link>
                            <v-list-item-icon>
                                <v-spacer></v-spacer>
                                <v-icon small>mdi-cash-multiple</v-icon>
                            </v-list-item-icon>

                            <v-list-item-title>AGREGAR PRODUCTOS</v-list-item-title>
                        </v-list-item>

                        <v-list-item link>
                        <v-list-item-icon>
                            <v-spacer></v-spacer>
                            <v-icon small>mdi-cash-multiple</v-icon>
                        </v-list-item-icon>
                        <v-list-item-title
                            >CATEGORIAS</v-list-item-title
                        >
                        </v-list-item>
                        <v-list-item link>
                        <v-list-item-icon>
                            <v-spacer></v-spacer>
                            <v-icon small>mdi-cash-multiple</v-icon>
                        </v-list-item-icon>
                        <v-list-item-title
                            >MARCAS</v-list-item-title
                        >
                        </v-list-item>
                        <v-list-item link>
                        <v-list-item-icon>
                            <v-spacer></v-spacer>
                            <v-icon small>mdi-cash-multiple</v-icon>
                        </v-list-item-icon>
                        <v-list-item-title
                            >PRECIOS DE PRODUCTOS</v-list-item-title
                        >
                        </v-list-item>
                        <v-list-item link>
                        <v-list-item-icon>
                            <v-spacer></v-spacer>
                            <v-icon small>mdi-cash-multiple</v-icon>
                        </v-list-item-icon>
                        <v-list-item-title
                            >UNIDADES DE MEDIDA</v-list-item-title
                        >
                        </v-list-item>
                        <v-list-item link>
                        <v-list-item-icon>
                            <v-spacer></v-spacer>
                            <v-icon small>mdi-cash-multiple</v-icon>
                        </v-list-item-icon>
                        <v-list-item-title
                            >PRESENTACIÓN DE PRODUCTOS</v-list-item-title
                        >
                        </v-list-item>
                        <v-list-item link>
                        <v-list-item-icon>
                            <v-spacer></v-spacer>
                            <v-icon small>mdi-cash-multiple</v-icon>
                        </v-list-item-icon>
                        <v-list-item-title
                            >LOTES DE PRODUCTOS</v-list-item-title
                        >
                        </v-list-item>
                    </v-list-item-group>
                    </v-list-group>
                    <v-list-item link>
                    <v-list-item-icon>
                        <v-icon>mdi-contacts</v-icon>
                    </v-list-item-icon>
                    <v-list-item-content>
                        <v-list-item-title>CLIENTES</v-list-item-title>
                    </v-list-item-content>
                    </v-list-item>
                    <v-list-item link>
                    <v-list-item-icon>
                        <v-icon>mdi-account-settings</v-icon>
                    </v-list-item-icon>
                    <v-list-item-content>
                        <v-list-item-title>EMPLEADOS</v-list-item-title>
                    </v-list-item-content>
                    </v-list-item>
                    <v-list-item link>
                    <v-list-item-icon>
                        <v-icon>mdi-account-multiple</v-icon>
                    </v-list-item-icon>
                    <v-list-item-content>
                        <v-list-item-title>PROVEEDORES</v-list-item-title>
                    </v-list-item-content>
                    </v-list-item>
                    <v-list-item link>
                    <v-list-item-icon>
                        <v-icon>mdi-account-key</v-icon>
                    </v-list-item-icon>
                    <v-list-item-content>
                        <v-list-item-title>ADMINISTRACIÓN</v-list-item-title>
                    </v-list-item-content>
                    </v-list-item>
                </v-list-item-group>
                </v-list>
                <!-- CONTENIDO MENU VERTICAL END-->

            </v-navigation-drawer>

            <!-- Menú horizontal -->
            <v-app-bar app color="white">
                <v-app-bar-nav-icon @click="drawer=!drawer"></v-app-bar-nav-icon>

                <v-toolbar-title>INICIO</v-toolbar-title>

                <v-spacer></v-spacer>
                <v-list-item-avatar>
                    <v-img
                    src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRBwr_zZjgvmu4BccwDNIHic8K5dyehw7cSYA&usqp=CAU"
                    ></v-img>
                </v-list-item-avatar>

                <v-menu left bottom>
                    <template v-slot:activator="{ on, attrs }">
                        <v-btn icon v-bind="attrs" v-on="on">
                            <v-icon>mdi-dots-vertical</v-icon>
                        </v-btn>
                    </template>

                    <v-list>
                        <v-list-item @click="() => {}">
                            <v-list-item-title>Perfil</v-list-item-title>
                        </v-list-item>

                        <v-list-item @click="() => {}">
                            <v-list-item-title>Cerrar Session</v-list-item-title>
                        </v-list-item>
                    </v-list>
                </v-menu>
            </v-app-bar>
        </template>

        <v-main>
            <v-container>
                <!-- Dashboard contenido -->
                <slot></slot>
            </v-container>

            <pre>{{ $page }}</pre>
        </v-main>
        <!-- Dashboard end-->

        <!-- PIE DE PAGINA -->
        <v-footer app>
            <v-col class="text-center" cols="12">
                {{ new Date().getFullYear() }} — <strong>ALPA PERÚ</strong>
            </v-col>
        </v-footer>
        <!-- PIE DE PAGINA END -->
    </v-app>
</template>

<script>
    export default {
        data () {
            return {
                drawer: null,
            }
        },
    }
</script>

