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
                            <v-list-item-subtitle>
                                correo@gmail.com
                            </v-list-item-subtitle>
                        </v-list-item-content>
                    </v-list-item>
                </v-list>
                <!-- linea divisoria -->
                <v-divider></v-divider>

                <!-- CONTENIDO MENU VERTICAL -->
                <v-list nav dense>
                    <v-list-item-group color="primary">

                        <inertia-link :href="route('dashboard')">
                            <v-list-item link>
                                <v-list-item-icon>
                                    <v-icon>mdi-monitor-multiple</v-icon>
                                </v-list-item-icon>
                                <v-list-item-content>
                                    <v-list-item-title>INICIO</v-list-item-title>
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
                        <v-list-group
                            prepend-icon="mdi-spin mdi-cube"
                            color="primary">

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
                                            <v-icon small>mdi-format-list-bulleted</v-icon>
                                        </v-list-item-icon>

                                        <v-list-item-title
                                            ><h5>
                                                LISTA PRODUCTOS
                                            </h5>
                                        </v-list-item-title>
                                    </v-list-item>
                                </inertia-link>

                                <v-list-item link>
                                    <v-list-item-icon>
                                        <v-spacer></v-spacer>
                                        <v-icon small>mdi-cube-send</v-icon>
                                    </v-list-item-icon>

                                    <v-list-item-title
                                        ><h5>
                                            AGREGAR PRODUCTOS
                                        </h5>
                                    </v-list-item-title>
                                </v-list-item>

                                <inertia-link :href="route('categories.index')">
                                    <v-list-item link>
                                        <v-list-item-icon>
                                            <v-spacer></v-spacer>
                                            <v-icon small>mdi-book-variant</v-icon>
                                        </v-list-item-icon>
                                        <v-list-item-title>
                                            <h5>CATEGORIAS</h5>
                                        </v-list-item-title>
                                    </v-list-item>
                                </inertia-link>

                                <v-list-item link>
                                    <v-list-item-icon>
                                        <v-spacer></v-spacer>
                                        <v-icon small>mdi-bookmark-plus</v-icon>
                                    </v-list-item-icon>
                                    <v-list-item-title>
                                        <h5>MARCAS</h5>
                                    </v-list-item-title>
                                </v-list-item>

                                <v-list-item link>
                                    <v-list-item-icon>
                                        <v-spacer></v-spacer>
                                        <v-icon small>mdi-currency-usd</v-icon>
                                    </v-list-item-icon>
                                    <v-list-item-title>
                                        <h5>PRECIOS DE PRODUCTOS</h5>
                                        </v-list-item-title>
                                </v-list-item>

                                <v-list-item link>
                                    <v-list-item-icon>
                                        <v-spacer></v-spacer>
                                        <v-icon small>mdi-weight-kilogram</v-icon>
                                    </v-list-item-icon>
                                    <v-list-item-title>
                                        <h5>UNIDADES DE MEDIDA</h5>
                                    </v-list-item-title>
                                </v-list-item>

                                <v-list-item link>
                                    <v-list-item-icon>
                                        <v-spacer></v-spacer>
                                        <v-icon small>mdi-package-variant-closed</v-icon>
                                    </v-list-item-icon>
                                    <v-list-item-title>
                                        <h5>PRESENTACIÓN DE PRODUCTOS</h5>
                                    </v-list-item-title>
                                </v-list-item>

                                <v-list-item link>
                                    <v-list-item-icon>
                                        <v-spacer></v-spacer>
                                        <v-icon small>mdi-package-variant</v-icon>
                                    </v-list-item-icon>
                                    <v-list-item-title>
                                        <h5>LOTES DE PRODUCTOS</h5>
                                    </v-list-item-title>
                                </v-list-item>

                            </v-list-item-group>

                        </v-list-group>

                        <v-list-item link>
                            <v-list-item-icon>
                                <v-icon>mdi-account-group</v-icon>
                            </v-list-item-icon>
                            <v-list-item-content>
                                <v-list-item-title>CLIENTES</v-list-item-title>
                            </v-list-item-content>
                        </v-list-item>

                        <v-list-item link>
                            <v-list-item-icon>
                                <v-icon>mdi-account-heart-outline</v-icon>
                            </v-list-item-icon>
                            <v-list-item-content>
                                <v-list-item-title>EMPLEADOS</v-list-item-title>
                            </v-list-item-content>
                        </v-list-item>

                        <v-list-item link>
                            <v-list-item-icon>
                                <v-icon>mdi-account-hard-hat</v-icon>
                            </v-list-item-icon>
                            <v-list-item-content>
                                <v-list-item-title>PROVEEDORES</v-list-item-title>
                            </v-list-item-content>
                        </v-list-item>
                        
                        <v-list-item link>
                            <v-list-item-icon>
                                <v-icon>mdi-spin mdi-cog</v-icon>
                            </v-list-item-icon>
                            <v-list-item-content>
                                <v-list-item-title>AJUSTES</v-list-item-title>
                            </v-list-item-content>
                        </v-list-item>

                        <v-list-group prepend-icon="mdi-account-tie" color="primary">

                            <template v-slot:activator>
                                <v-list-item-content>
                                    <v-list-item-title>ADMINISTRACION</v-list-item-title>
                                </v-list-item-content>
                            </template>

                            <v-list-item-group color="primary">

                                <v-list-item link>
                                    <v-list-item-icon>
                                        <v-spacer></v-spacer>
                                        <v-icon small>mdi-office-building</v-icon>
                                    </v-list-item-icon>
                                    <v-list-item-title>
                                        <h5>EMPRESAS</h5>
                                    </v-list-item-title>
                                </v-list-item>

                                <v-list-item link>
                                    <v-list-item-icon>
                                        <v-spacer></v-spacer>
                                        <v-icon small>mdi-account-key</v-icon>
                                    </v-list-item-icon>
                                    <v-list-item-title
                                        ><h5>ACCESOS</h5>
                                    </v-list-item-title>
                                </v-list-item>

                            </v-list-item-group>

                        </v-list-group>

                    </v-list-item-group>

                </v-list>
            </v-navigation-drawer>
                <!-- CONTENIDO MENU VERTICAL END-->


            <!-- Menú horizontal -->
            <v-app-bar app color="white">
                <v-app-bar-nav-icon
                    @click="drawer = !drawer"
                ></v-app-bar-nav-icon>

                <v-toolbar-title>
                    <!-- INICIO -->
                </v-toolbar-title>

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
                <slot></slot>
            </v-container>

            <pre>{{ $page }}</pre>
        </v-main>

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
    data() {
        return {
            drawer: null,
        };
    },
};
</script>
