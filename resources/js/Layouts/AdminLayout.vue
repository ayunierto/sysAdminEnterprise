<template>
    <v-app>
        <!-- memú vertical y horizontal -->
        <template>
            <!-- Menú vertical -->
            <!-- <v-navigation-drawer app v-model="drawer" v-bind="color"> -->
            <v-navigation-drawer app v-model="drawer" v-bind:style="{ background: colorMenu}">
            <!-- style="background: linear-gradient(90deg, rgba(2,0,36,1) 0%, rgba(25,71,154,1) 35%);" -->
                <!-- cambio colores -->
                <!-- v-bind:class="{ red: colorrojo}" -->
                <v-list class="ma-2">
                    <!-- <v-card color="#3463B3" >
                            <v-img height="150" src="../img/empresa1/ecsmac9.png">
                            </v-img>
                    </v-card> -->
                    <v-list-item class="px-2">
                        <v-avatar size="70">
                            <v-img src="../img/empresa1/ecsmac8.png">
                            </v-img>
                        </v-avatar>
                        <v-list-item-title class="text-h6" v-bind:style="{ color: colorText}">
                            <slot name="company_name"></slot>
                        </v-list-item-title>
                    </v-list-item>
                    <v-list-item>
                        <v-list-item-content>
                            <v-list-item-subtitle v-bind:style="{ color: colorText}">
                                {{this.$page.props.company.description}}
                            </v-list-item-subtitle>
                        </v-list-item-content>

                        <!-- Personalizar colores -->
                        <!-- <v-fab-transition>
                            <v-btn v-show="!hidden" color="pink" fab dark small absolute bottom right>
                                <v-icon v-bind:style="{ color: colorText}">mdi-spin mdi-cog</v-icon>
                            </v-btn>
                        </v-fab-transition> -->

                    </v-list-item>
                </v-list>
                <!-- linea divisora -->
                <v-divider></v-divider>

                <!-- CONTENIDO MENU VERTICAL -->
                <v-list nav dense>
                    <v-list-item-group>

                        <inertia-link :href="route('dashboard')">
                            <v-list-item link v-bind:style="{ color: colorText}" v-if="$page.props.user.role != 'seller'">
                                <v-list-item-icon>
                                    <v-icon v-bind:style="{ color: colorText}">mdi-monitor-multiple</v-icon>
                                </v-list-item-icon>
                                <v-list-item-content>
                                    <v-list-item-title>INICIO</v-list-item-title>
                                </v-list-item-content>
                            </v-list-item>
                        </inertia-link>

                        <v-list-group class="white--text" v-bind:style="{ color: colorText}" v-if="$page.props.user.role == 'master'">
                            <v-icon slot="prependIcon" v-bind:style="{ color: colorText}">mdi-account-tie</v-icon>
                            <template v-slot:activator>
                                <v-list-item-content v-bind:style="{ color: colorText}">
                                    <v-list-item-title>ADMINISTRACION</v-list-item-title>
                                </v-list-item-content>
                            </template>
                            <v-card v-bind:style="{ background: colorFooter}">
                                <v-list-item-group class="white--text" v-bind:style="{ color: colorText}">

                                    <inertia-link :href="route('companies.index')">
                                        <v-list-item link v-bind:style="{ color: colorText}">
                                            <v-list-item-icon>
                                                <v-spacer></v-spacer>
                                                <v-icon v-bind:style="{ color: colorText}" small>mdi-office-building</v-icon>
                                            </v-list-item-icon>
                                            <v-list-item-title>
                                                <h5>EMPRESAS</h5>
                                            </v-list-item-title>
                                        </v-list-item>
                                    </inertia-link>
                                    <inertia-link :href="route('customizers.index')">
                                        <v-list-item link v-bind:style="{ color: colorText}">
                                            <v-list-item-icon>
                                                <v-spacer></v-spacer>
                                                <v-icon v-bind:style="{ color: colorText}" small>mdi-invert-colors</v-icon>
                                            </v-list-item-icon>
                                            <v-list-item-title>
                                                <h5>PERSONALIZACIÓN</h5>
                                            </v-list-item-title>
                                        </v-list-item>
                                    </inertia-link>

                                    <inertia-link :href="route('users.index')">
                                        <v-list-item link v-bind:style="{ color: colorText}">
                                            <v-list-item-icon>
                                                <v-spacer></v-spacer>
                                                <v-icon v-bind:style="{ color: colorText}" small>mdi-account-key</v-icon>
                                            </v-list-item-icon>
                                            <v-list-item-title>
                                                <h5>USUARIOS</h5>
                                            </v-list-item-title>
                                        </v-list-item>
                                    </inertia-link>


                                    <inertia-link :href="route('measures.index')">
                                        <v-list-item link v-bind:style="{ color: colorText}">
                                            <v-list-item-icon>
                                                <v-spacer></v-spacer>
                                                <v-icon v-bind:style="{ color: colorText}" small>mdi-weight-kilogram</v-icon>
                                            </v-list-item-icon>
                                            <v-list-item-title>
                                                <h5>UNIDADES DE MEDIDA</h5>
                                            </v-list-item-title>
                                        </v-list-item>
                                    </inertia-link>

                                    <inertia-link :href="route('proofPayments.index')">
                                        <v-list-item link v-bind:style="{ color: colorText}">
                                            <v-list-item-icon>
                                                <v-spacer></v-spacer>
                                                <v-icon v-bind:style="{ color: colorText}" small>mdi-note-text-outline</v-icon>
                                            </v-list-item-icon>
                                            <v-list-item-title>
                                                <h5>COMPROBANTES DE PAGO</h5>
                                            </v-list-item-title>
                                        </v-list-item>
                                    </inertia-link>

                                    <inertia-link :href="route('coins.index')">
                                        <v-list-item link v-bind:style="{ color: colorText}">
                                            <v-list-item-icon>
                                                <v-spacer></v-spacer>
                                                <v-icon v-bind:style="{ color: colorText}" small>mdi-currency-usd</v-icon>
                                            </v-list-item-icon>
                                            <v-list-item-title>
                                                <h5>MONEDAS</h5>
                                            </v-list-item-title>
                                        </v-list-item>
                                    </inertia-link>

                                    <inertia-link :href="route('paymentMethods.index')">
                                        <v-list-item link v-bind:style="{ color: colorText}">
                                            <v-list-item-icon>
                                                <v-spacer></v-spacer>
                                                <v-icon v-bind:style="{ color: colorText}" small>mdi-account-cash</v-icon>
                                            </v-list-item-icon>
                                            <v-list-item-title>
                                                <h5>MÉTODOS DE PAGO</h5>
                                            </v-list-item-title>
                                        </v-list-item>
                                    </inertia-link>

                                    <inertia-link :href="route('vouchers.index')">
                                        <v-list-item link v-bind:style="{ color: colorText}">
                                            <v-list-item-icon>
                                                <v-spacer></v-spacer>
                                                <v-icon v-bind:style="{ color: colorText}" small>mdi-file-document</v-icon>
                                            </v-list-item-icon>
                                            <v-list-item-title>
                                                <h5>COMPROBANTES</h5>
                                            </v-list-item-title>
                                        </v-list-item>
                                    </inertia-link>

                                </v-list-item-group>
                            </v-card>


                        </v-list-group>

                        <v-list-group class="white--text" v-bind:style="{ color: colorText}" v-if="$page.props.user.role != 'seller'">
                            <v-icon slot="prependIcon" v-bind:style="{ color: colorText}">mdi-cart</v-icon>
                            <template v-slot:activator>
                                <v-list-item-content v-bind:style="{ color: colorText}">
                                    <v-list-item-title>VENTAS</v-list-item-title>
                                </v-list-item-content>
                            </template>
                            <v-card v-bind:style="{ background: colorFooter}">
                                <v-list-item-group class="white--text" v-bind:style="{ color: colorText}">

                                    <inertia-link>
                                        <v-list-item link v-bind:style="{ color: colorText}">
                                            <v-list-item-icon>
                                                <v-spacer></v-spacer>
                                                <v-icon v-bind:style="{ color: colorText}" small>mdi-cart-plus</v-icon>
                                            </v-list-item-icon>
                                            <v-list-item-title>
                                                <h5>NUEVA VENTA</h5>
                                            </v-list-item-title>
                                        </v-list-item>
                                    </inertia-link>

                                    <inertia-link>
                                        <v-list-item link v-bind:style="{ color: colorText}">
                                            <v-list-item-icon>
                                                <v-spacer></v-spacer>
                                                <v-icon v-bind:style="{ color: colorText}" small>mdi-cards-variant</v-icon>
                                            </v-list-item-icon>
                                            <v-list-item-title>
                                                <h5>LISTA DE VENTAS</h5>
                                            </v-list-item-title>
                                        </v-list-item>
                                    </inertia-link>

                                </v-list-item-group>
                            </v-card>
                        </v-list-group>

                        <v-list-group class="white--text" v-bind:style="{ color: colorText}" v-if="$page.props.user.role != 'seller'">
                            <v-icon slot="prependIcon" v-bind:style="{ color: colorText}">mdi-cash-multiple</v-icon>
                            <template v-slot:activator>
                                <v-list-item-content v-bind:style="{ color: colorText}">
                                    <v-list-item-title>COMPRAS</v-list-item-title>
                                </v-list-item-content>
                            </template>
                            <v-card v-bind:style="{ background: colorFooter}">
                                <v-list-item-group class="white--text" v-bind:style="{ color: colorText}">

                                    <inertia-link >
                                        <v-list-item link v-bind:style="{ color: colorText}">
                                            <v-list-item-icon>
                                                <v-spacer></v-spacer>
                                                <v-icon v-bind:style="{ color: colorText}" small>mdi-cart-plus</v-icon>
                                            </v-list-item-icon>
                                            <v-list-item-title>
                                                <h5>NUEVA COMPRA</h5>
                                            </v-list-item-title>
                                        </v-list-item>
                                    </inertia-link>

                                    <inertia-link>
                                        <v-list-item link v-bind:style="{ color: colorText}">
                                            <v-list-item-icon>
                                                <v-spacer></v-spacer>
                                                <v-icon v-bind:style="{ color: colorText}" small>mdi-cards-variant</v-icon>
                                            </v-list-item-icon>
                                            <v-list-item-title>
                                                <h5>LISTA DE COMPRAS</h5>
                                            </v-list-item-title>
                                        </v-list-item>
                                    </inertia-link>

                                </v-list-item-group>
                            </v-card>
                        </v-list-group>

                        <v-list-group class="white--text" v-bind:style="{ color: colorText}">
                            <v-icon slot="prependIcon" v-bind:style="{ color: colorText}">mdi-spin mdi-cube</v-icon>
                            <template v-slot:activator>
                                <v-list-item-content v-bind:style="{ color: colorText}">
                                    <v-list-item-title>PRODUCTOS</v-list-item-title>
                                </v-list-item-content>
                            </template>

                            <v-card v-bind:style="{ background: colorFooter}">
                                <v-list-item-group class="white--text" v-bind:style="{ color: colorText}">

                                    <inertia-link :href="route('products.index')">
                                        <v-list-item link v-bind:style="{ color: colorText}">
                                            <v-list-item-icon>
                                                <v-spacer></v-spacer>
                                                <v-icon v-bind:style="{ color: colorText}" small>mdi-format-list-bulleted</v-icon>
                                            </v-list-item-icon>

                                            <v-list-item-title>
                                                <h5>
                                                    LISTA PRODUCTOS
                                                </h5>
                                            </v-list-item-title>
                                        </v-list-item>
                                    </inertia-link>

                                    <!-- <v-list-item link v-bind:style="{ color: colorText}" v-if="$page.props.user.role != 'seller'">
                                        <v-list-item-icon>
                                            <v-spacer></v-spacer>
                                            <v-icon v-bind:style="{ color: colorText}" small>mdi-cube-send</v-icon>
                                        </v-list-item-icon>

                                        <v-list-item-title>
                                            <h5>
                                                AGREGAR PRODUCTOS
                                            </h5>
                                        </v-list-item-title>
                                    </v-list-item> -->

                                    <inertia-link :href="route('categories.index')"
                                        v-if="$page.props.user.role != 'seller'">
                                        <v-list-item link v-bind:style="{ color: colorText}">
                                            <v-list-item-icon>
                                                <v-spacer></v-spacer>
                                                <v-icon v-bind:style="{ color: colorText}" small>mdi-book-variant</v-icon>
                                            </v-list-item-icon>
                                            <v-list-item-title>
                                                <h5>CATEGORIAS</h5>
                                            </v-list-item-title>
                                        </v-list-item>
                                    </inertia-link>

                                    <inertia-link :href="route('marks.index')" v-if="$page.props.user.role != 'seller'">
                                        <v-list-item link v-bind:style="{ color: colorText}">
                                            <v-list-item-icon>
                                                <v-spacer></v-spacer>
                                                <v-icon v-bind:style="{ color: colorText}" small>mdi-bookmark-plus</v-icon>
                                            </v-list-item-icon>
                                            <v-list-item-title>
                                                <h5>MARCAS</h5>
                                            </v-list-item-title>
                                        </v-list-item>
                                    </inertia-link>


                                    <!-- <v-list-item link v-bind:style="{ color: colorText}"  v-if="$page.props.user.role != 'seller'">
                                        <v-list-item-icon>
                                            <v-spacer></v-spacer>
                                            <v-icon v-bind:style="{ color: colorText}" small>mdi-currency-usd</v-icon>
                                        </v-list-item-icon>
                                        <v-list-item-title>
                                            <h5>PRECIOS DE PRODUCTOS</h5>
                                        </v-list-item-title>
                                    </v-list-item> -->

                                    <inertia-link :href="route('presentations.index')"
                                        v-if="$page.props.user.role != 'seller'">
                                        <v-list-item link v-bind:style="{ color: colorText}">
                                            <v-list-item-icon>
                                                <v-spacer></v-spacer>
                                                <v-icon v-bind:style="{ color: colorText}" small>mdi-package-variant-closed</v-icon>
                                            </v-list-item-icon>
                                            <v-list-item-title>
                                                <h5>PRESENTACIÓN DE PRODUCTOS</h5>
                                            </v-list-item-title>
                                        </v-list-item>
                                    </inertia-link>

                                    <!-- <v-list-item link v-bind:style="{ color: colorText}"  v-if="$page.props.user.role != 'seller'">
                                        <v-list-item-icon>
                                            <v-spacer></v-spacer>
                                            <v-icon v-bind:style="{ color: colorText}" small>mdi-package-variant</v-icon>
                                        </v-list-item-icon>
                                        <v-list-item-title>
                                            <h5>LOTES DE PRODUCTOS</h5>
                                        </v-list-item-title>
                                    </v-list-item> -->

                                </v-list-item-group>
                            </v-card>

                        </v-list-group>
                        <inertia-link :href="route('customers.index')" v-if="$page.props.user.role != 'seller'">
                            <v-list-item link v-bind:style="{ color: colorText}">
                                <v-list-item-icon>
                                    <v-icon v-bind:style="{ color: colorText}">mdi-account-group</v-icon>
                                </v-list-item-icon>
                                <v-list-item-content>
                                    <v-list-item-title>CLIENTES</v-list-item-title>
                                </v-list-item-content>
                            </v-list-item>
                        </inertia-link>

                        <v-list-item link v-bind:style="{ color: colorText}" v-if="$page.props.user.role != 'seller'">
                            <v-list-item-icon>
                                <v-icon v-bind:style="{ color: colorText}">mdi-account-heart-outline</v-icon>
                            </v-list-item-icon>
                            <v-list-item-content>
                                <v-list-item-title>EMPLEADOS</v-list-item-title>
                            </v-list-item-content>
                        </v-list-item>

                        <inertia-link :href="route('providers.index')" v-if="$page.props.user.role != 'seller'">
                            <v-list-item link v-bind:style="{ color: colorText}">
                                <v-list-item-icon>
                                    <v-icon v-bind:style="{ color: colorText}">mdi-account-hard-hat</v-icon>
                                </v-list-item-icon>
                                <v-list-item-content>
                                    <v-list-item-title>PROVEEDORES</v-list-item-title>
                                </v-list-item-content>
                            </v-list-item>
                        </inertia-link>

                        <v-list-item link v-bind:style="{ color: colorText}" v-if="$page.props.user.role != 'seller'">
                            <v-list-item-icon>
                                <v-icon v-bind:style="{ color: colorText}">mdi-spin mdi-cog</v-icon>
                            </v-list-item-icon>
                            <v-list-item-content>
                                <v-list-item-title>AJUSTES</v-list-item-title>
                            </v-list-item-content>
                        </v-list-item>

                    </v-list-item-group>
                </v-list>
            </v-navigation-drawer>
            <!-- CONTENIDO MENU VERTICAL END-->


            <!-- Menú horizontal -->
            <!-- <v-app-bar app v-bind="color"> -->
            <v-app-bar app v-bind:style="{ background: colorHeader}">
                <v-app-bar-nav-icon @click="drawer = !drawer" v-bind:style="{ color: colorText}"></v-app-bar-nav-icon>

                <v-toolbar-title>
                    <!-- INICIO -->
                </v-toolbar-title>

                <v-spacer></v-spacer>
                <!-- <v-list-item-avatar>
                    <v-img
                        src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRBwr_zZjgvmu4BccwDNIHic8K5dyehw7cSYA&usqp=CAU">
                    </v-img>
                </v-list-item-avatar> -->
                <v-menu left bottom>
                    <template v-slot:activator="{ on, attrs }">
                        <v-btn icon v-bind="attrs" v-on="on" v-bind:style="{ color: colorText}">
                            <v-icon v-bind:style="{ color: colorText}">mdi-dots-vertical</v-icon>
                        </v-btn>
                    </template>
                    <v-list>
                        <v-list-item @click="() => { }">
                            <v-list-item-title>Perfil</v-list-item-title>
                        </v-list-item>
                        <v-list-item @click="logout">
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
        </v-main>

        <!-- PIE DE PAGINA -->
        <!-- <v-footer padless v-bind="color" height="60px"> -->
        <v-footer padless height="60px" v-bind:style="{ background: colorFooter}" app>
            <v-col class="text-center" cols="12" absolute v-bind:style="{ color: colorText}">
                {{ new Date().getFullYear() }} — <strong >{{this.$page.props.company.name}}</strong>
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
            hidden: false,
            colorMenu:this.$page.props.perzonalizer.color_menu,
            colorHeader:this.$page.props.perzonalizer.color_header,
            colorFooter:this.$page.props.perzonalizer.color_footer,
            colorText:this.$page.props.perzonalizer.colot_text,
            
            // color: {
            //     color: "blue",
            // }
        };
    },
    methods: {

        logout() {
            this.$inertia.post(route('logout'));
        },
    }
};
</script>
