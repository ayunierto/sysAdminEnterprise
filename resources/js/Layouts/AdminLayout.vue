<template>
    <v-app>
        <!-- memú vertical y horizontal -->
        <template>
            <!-- Menú vertical -->
            <!-- <v-navigation-drawer app v-model="drawer" v-bind="color="> -->
            <v-navigation-drawer app v-model="drawer" :color="colorMenu">
                <!-- style="background: linear-gradient(90deg, rgba(2,0,36,1) 0%, rgba(25,71,154,1) 35%);" -->
                <!-- cambio colores -->
                <!-- v-bind:class="{ red: colorrojo}" -->
                <v-list class="ma-2">
                    <v-img aspect-ratio="2.5" contain :src='logoEmpresa'>
                    </v-img>
                    <!-- <v-list-item class="px-2">
                        <v-avatar size="70">
                            <v-img src="../img/empresa1/empresa01.png">
                            </v-img>
                        </v-avatar>
                        <v-list-item-title class="text-h6" color="#FFFFFFFF">
                            <span :style="item_style()"></span>
                        </v-list-item-title>
                    </v-list-item>
                    <v-list-item> -->
                    <v-list-item-content>
                        <v-list-item-subtitle style="text-align:center ;">
                            <span :style="item_style()">{{ this.$page.props.company.description }}</span>
                        </v-list-item-subtitle>
                    </v-list-item-content>

                    <!-- Personalizar colores -->
                    <!-- <v-fab-transition>
                            <v-btn v-show="!hidden" color="pink" fab dark small absolute bottom right>
                                <v-icon :style="item_style()">mdi-spin mdi-cog</v-icon>
                            </v-btn>
                        </v-fab-transition> -->

                    <!-- </v-list-item> -->
                </v-list>
                <!-- linea divisora -->
                <v-divider></v-divider>

                <!-- CONTENIDO MENU VERTICAL -->
                <v-list nav dense>
                    <v-list-item-group color="primary">

                        <inertia-link :href="route('dashboard')">
                            <v-list-item link v-if="$page.props.user.role != 'seller'" :style="item_style()">
                                <v-list-item-icon>
                                    <v-icon :style="item_style()">mdi-monitor-multiple</v-icon>
                                </v-list-item-icon>
                                <v-list-item-content>
                                    <v-list-item-title>INICIO</v-list-item-title>
                                </v-list-item-content>
                            </v-list-item>
                        </inertia-link>

                        <v-list-group v-if="$page.props.user.role == 'master'">
                            <v-icon slot="prependIcon" :style="item_style()">mdi-account-tie</v-icon>
                            <template v-slot:activator>
                                <v-list-item-content :style="item_style()">
                                    <v-list-item-title>ADMINISTRACION</v-list-item-title>
                                </v-list-item-content>
                            </template>
                            <v-card :color="colorSubMenu">
                                <v-list-item-group>

                                    <inertia-link :href="route('companies.index')">
                                        <v-list-item :style="item_style()">
                                            <v-list-item-icon>
                                                <v-spacer></v-spacer>
                                                <v-icon small :style="item_style()">mdi-office-building</v-icon>
                                            </v-list-item-icon>
                                            <v-list-item-title>
                                                <h5>EMPRESAS</h5>
                                            </v-list-item-title>
                                        </v-list-item>
                                    </inertia-link>

                                    <inertia-link :href="route('customizers.index')">
                                        <v-list-item link :style="item_style()">
                                            <v-list-item-icon>
                                                <v-spacer></v-spacer>
                                                <v-icon :style="item_style()" small>mdi-invert-colors</v-icon>
                                            </v-list-item-icon>
                                            <v-list-item-title>
                                                <h5>PERSONALIZACIÓN</h5>
                                            </v-list-item-title>
                                        </v-list-item>
                                    </inertia-link>

                                    <inertia-link :href="route('users.index')">
                                        <v-list-item link :style="item_style()">
                                            <v-list-item-icon>
                                                <v-spacer></v-spacer>
                                                <v-icon small :style="item_style()">mdi-account-key</v-icon>
                                            </v-list-item-icon>
                                            <v-list-item-title>
                                                <h5>USUARIOS</h5>
                                            </v-list-item-title>
                                        </v-list-item>
                                    </inertia-link>

                                    <inertia-link :href="route('measures.index')">
                                        <v-list-item link :style="item_style()">
                                            <v-list-item-icon>
                                                <v-spacer></v-spacer>
                                                <v-icon :style="item_style()" small>mdi-weight-kilogram</v-icon>
                                            </v-list-item-icon>
                                            <v-list-item-title>
                                                <h5>UNIDADES DE MEDIDA</h5>
                                            </v-list-item-title>
                                        </v-list-item>
                                    </inertia-link>

                                    <inertia-link :href="route('proofPayments.index')">
                                        <v-list-item link :style="item_style()">
                                            <v-list-item-icon>
                                                <v-spacer></v-spacer>
                                                <v-icon :style="item_style()" small>mdi-note-text-outline</v-icon>
                                            </v-list-item-icon>
                                            <v-list-item-title>
                                                <h5>COMPROBANTES DE PAGO</h5>
                                            </v-list-item-title>
                                        </v-list-item>
                                    </inertia-link>

                                    <inertia-link :href="route('coins.index')">
                                        <v-list-item link :style="item_style()">
                                            <v-list-item-icon>
                                                <v-spacer></v-spacer>
                                                <v-icon :style="item_style()" small>mdi-currency-usd</v-icon>
                                            </v-list-item-icon>
                                            <v-list-item-title>
                                                <h5>MONEDAS</h5>
                                            </v-list-item-title>
                                        </v-list-item>
                                    </inertia-link>

                                    <inertia-link :href="route('paymentMethods.index')">
                                        <v-list-item link :style="item_style()">
                                            <v-list-item-icon>
                                                <v-spacer></v-spacer>
                                                <v-icon :style="item_style()" small>mdi-account-cash</v-icon>
                                            </v-list-item-icon>
                                            <v-list-item-title>
                                                <h5>MÉTODOS DE PAGO</h5>
                                            </v-list-item-title>
                                        </v-list-item>
                                    </inertia-link>
                                    <inertia-link :href="route('documents.index')">
                                        <v-list-item link :style="item_style()">
                                            <v-list-item-icon>
                                                <v-spacer></v-spacer>
                                                <v-icon :style="item_style()" small>mdi-smart-card</v-icon>
                                            </v-list-item-icon>
                                            <v-list-item-title>
                                                <h5>DOCUMENTOS</h5>
                                            </v-list-item-title>
                                        </v-list-item>
                                    </inertia-link>

                                </v-list-item-group>
                            </v-card>
                        </v-list-group>

                        <v-list-group :style="item_style()" v-if="$page.props.user.role != 'seller'">
                            <v-icon slot="prependIcon" :style="item_style()">mdi-cart</v-icon>
                            <template v-slot:activator>
                                <v-list-item-content :style="item_style()">
                                    <v-list-item-title>VENTAS</v-list-item-title>
                                </v-list-item-content>
                            </template>
                            <v-card :color="colorSubMenu">
                                <v-list-item-group :style="item_style()">

                                    <inertia-link :href="route('orders.create')">
                                        <v-list-item link :style="item_style()">
                                            <v-list-item-icon>
                                                <v-spacer></v-spacer>
                                                <v-icon :style="item_style()" small>mdi-cart-plus</v-icon>
                                            </v-list-item-icon>
                                            <v-list-item-title>
                                                <h5>NUEVA VENTA</h5>
                                            </v-list-item-title>
                                        </v-list-item>
                                    </inertia-link>

                                    <inertia-link :href="route('orders.index')">
                                        <v-list-item link :style="item_style()">
                                            <v-list-item-icon>
                                                <v-spacer></v-spacer>
                                                <v-icon :style="item_style()" small>mdi-cards-variant</v-icon>
                                            </v-list-item-icon>
                                            <v-list-item-title>
                                                <h5>LISTA DE VENTAS</h5>
                                            </v-list-item-title>
                                        </v-list-item>
                                    </inertia-link>

                                    <inertia-link :href="route('accountReceivables.index')">
                                        <v-list-item link :style="item_style()">
                                            <v-list-item-icon>
                                                <v-spacer></v-spacer>
                                                <v-icon :style="item_style()" small>mdi-account-cash</v-icon>
                                            </v-list-item-icon>
                                            <v-list-item-title>
                                                <h5>CUENTAS POR COBRAR</h5>
                                            </v-list-item-title>
                                        </v-list-item>
                                    </inertia-link>

                                </v-list-item-group>
                            </v-card>
                        </v-list-group>

                        <v-list-group :style="item_style()" v-if="$page.props.user.role != 'seller'">
                            <v-icon slot="prependIcon" :style="item_style()">mdi-cash-multiple</v-icon>
                            <template v-slot:activator>
                                <v-list-item-content :style="item_style()">
                                    <v-list-item-title>COMPRAS</v-list-item-title>
                                </v-list-item-content>
                            </template>
                            <v-card :color="colorSubMenu">
                                <v-list-item-group :style="item_style()">

                                    <inertia-link :href="route('purchases.create')">
                                        <v-list-item link :style="item_style()">
                                            <v-list-item-icon>
                                                <v-spacer></v-spacer>
                                                <v-icon :style="item_style()" small>mdi-cart-plus</v-icon>
                                            </v-list-item-icon>
                                            <v-list-item-title>
                                                <h5>NUEVA COMPRA</h5>
                                            </v-list-item-title>
                                        </v-list-item>
                                    </inertia-link>

                                    <inertia-link :href="route('purchases.index')">
                                        <v-list-item link :style="item_style()">
                                            <v-list-item-icon>
                                                <v-spacer></v-spacer>
                                                <v-icon :style="item_style()" small>mdi-cards-variant</v-icon>
                                            </v-list-item-icon>
                                            <v-list-item-title>
                                                <h5>LISTA DE COMPRAS</h5>
                                            </v-list-item-title>
                                        </v-list-item>
                                    </inertia-link>

                                    <inertia-link :href="route('accountPayables.index')">
                                        <v-list-item link :style="item_style()">
                                            <v-list-item-icon>
                                                <v-spacer></v-spacer>
                                                <v-icon :style="item_style()" small>mdi-account-cash</v-icon>
                                            </v-list-item-icon>
                                            <v-list-item-title>
                                                <h5>CUENTAS POR PAGAR</h5>
                                            </v-list-item-title>
                                        </v-list-item>
                                    </inertia-link>

                                </v-list-item-group>
                            </v-card>
                        </v-list-group>

                        <v-list-group :style="item_style()">
                            <v-icon slot="prependIcon" :style="item_style()">mdi-spin mdi-cube</v-icon>
                            <template v-slot:activator>
                                <v-list-item-content :style="item_style()">
                                    <v-list-item-title>PRODUCTOS</v-list-item-title>
                                </v-list-item-content>
                            </template>

                            <v-card :color="colorSubMenu">
                                <v-list-item-group :style="item_style()">

                                    <inertia-link :href="route('products.index')">
                                        <v-list-item link :style="item_style()">
                                            <v-list-item-icon>
                                                <v-spacer></v-spacer>
                                                <v-icon :style="item_style()" small>mdi-format-list-bulleted</v-icon>
                                            </v-list-item-icon>
                                            <v-list-item-title>
                                                <h5>
                                                    LISTA PRODUCTOS
                                                </h5>
                                            </v-list-item-title>
                                        </v-list-item>
                                    </inertia-link>

                                    <inertia-link :href="route('categories.index')"
                                        v-if="$page.props.user.role != 'seller'">
                                        <v-list-item link :style="item_style()">
                                            <v-list-item-icon>
                                                <v-spacer></v-spacer>
                                                <v-icon :style="item_style()" small>mdi-book-variant</v-icon>
                                            </v-list-item-icon>
                                            <v-list-item-title>
                                                <h5>CATEGORIAS</h5>
                                            </v-list-item-title>
                                        </v-list-item>
                                    </inertia-link>

                                    <inertia-link :href="route('marks.index')" v-if="$page.props.user.role != 'seller'">
                                        <v-list-item link :style="item_style()">
                                            <v-list-item-icon>
                                                <v-spacer></v-spacer>
                                                <v-icon :style="item_style()" small>mdi-bookmark-plus</v-icon>
                                            </v-list-item-icon>
                                            <v-list-item-title>
                                                <h5>MARCAS</h5>
                                            </v-list-item-title>
                                        </v-list-item>
                                    </inertia-link>

                                    <inertia-link :href="route('presentations.index')"
                                        v-if="$page.props.user.role != 'seller'">
                                        <v-list-item link :style="item_style()">
                                            <v-list-item-icon>
                                                <v-spacer></v-spacer>
                                                <v-icon :style="item_style()" small>mdi-package-variant-closed</v-icon>
                                            </v-list-item-icon>
                                            <v-list-item-title>
                                                <h5>PRESENTACIÓN DE PRODUCTOS</h5>
                                            </v-list-item-title>
                                        </v-list-item>
                                    </inertia-link>
                                </v-list-item-group>
                            </v-card>

                        </v-list-group>

                        <v-list-group :style="item_style()">
                            <v-icon slot="prependIcon" :style="item_style()">mdi-spin mdi-alpha-s-circle</v-icon>
                            <template v-slot:activator>
                                <v-list-item-content :style="item_style()">
                                    <v-list-item-title>SERVICIOS</v-list-item-title>
                                </v-list-item-content>
                            </template>

                            <v-card :color="colorSubMenu">
                                <v-list-item-group :style="item_style()">

                                    <inertia-link :href="route('services.index')">
                                        <v-list-item link :style="item_style()">
                                            <v-list-item-icon>
                                                <v-spacer></v-spacer>
                                                <v-icon :style="item_style()" small>mdi-format-list-bulleted</v-icon>
                                            </v-list-item-icon>
                                            <v-list-item-title>
                                                <h5>
                                                    LISTA SERVICIOS
                                                </h5>
                                            </v-list-item-title>
                                        </v-list-item>
                                    </inertia-link>
                                </v-list-item-group>
                            </v-card>

                        </v-list-group>

                        <inertia-link :href="route('customers.index')" v-if="$page.props.user.role != 'seller'">
                            <v-list-item link :style="item_style()">
                                <v-list-item-icon>
                                    <v-icon :style="item_style()">mdi-account-group</v-icon>
                                </v-list-item-icon>
                                <v-list-item-content>
                                    <v-list-item-title>CLIENTES</v-list-item-title>
                                </v-list-item-content>
                            </v-list-item>
                        </inertia-link>

                        <!-- <v-list-item link :style="item_style()" v-if="$page.props.user.role != 'seller'">
                            <v-list-item-icon>
                                <v-icon :style="item_style()">mdi-account-heart-outline</v-icon>
                            </v-list-item-icon>
                            <v-list-item-content>
                                <v-list-item-title>EMPLEADOS</v-list-item-title>
                            </v-list-item-content>
                        </v-list-item> -->

                        <inertia-link :href="route('providers.index')" v-if="$page.props.user.role != 'seller'">
                            <v-list-item link :style="item_style()">
                                <v-list-item-icon>
                                    <v-icon :style="item_style()">mdi-account-hard-hat</v-icon>
                                </v-list-item-icon>
                                <v-list-item-content>
                                    <v-list-item-title>PROVEEDORES</v-list-item-title>
                                </v-list-item-content>
                            </v-list-item>
                        </inertia-link>

                        <inertia-link :href="route('warehouses.index')" v-if="$page.props.user.role != 'seller'">
                            <v-list-item link :style="item_style()">
                                <v-list-item-icon>
                                    <v-icon :style="item_style()">mdi-warehouse</v-icon>
                                </v-list-item-icon>
                                <v-list-item-content>
                                    <v-list-item-title>ALMACENES</v-list-item-title>
                                </v-list-item-content>
                            </v-list-item>
                        </inertia-link>

                        <v-list-group v-if="$page.props.user.role == 'master'">
                            <v-icon slot="prependIcon" :style="item_style()">mdi-spin mdi-cog</v-icon>
                            <template v-slot:activator>
                                <v-list-item-content :style="item_style()">
                                    <v-list-item-title>AJUSTES</v-list-item-title>
                                </v-list-item-content>
                            </template>
                            <v-card :color="colorSubMenu">
                                <v-list-item-group>

                                    <inertia-link :href="route('settings.index')">
                                        <v-list-item :style="item_style()">
                                            <v-list-item-icon>
                                                <v-spacer></v-spacer>
                                                <v-icon small :style="item_style()">mdi-format-color-highlight</v-icon>
                                            </v-list-item-icon>
                                            <v-list-item-title>
                                                <h5>PERSONALIZAR</h5>
                                            </v-list-item-title>
                                        </v-list-item>
                                    </inertia-link>

                                    <inertia-link :href="route('printers.index')">
                                        <v-list-item link :style="item_style()">
                                            <v-list-item-icon>
                                                <v-spacer></v-spacer>
                                                <v-icon :style="item_style()" small>mdi-printer</v-icon>
                                            </v-list-item-icon>
                                            <v-list-item-title>
                                                <h5>IMPRESORAS</h5>
                                            </v-list-item-title>
                                        </v-list-item>
                                    </inertia-link>

                                </v-list-item-group>
                            </v-card>
                        </v-list-group>

                    </v-list-item-group>
                </v-list>
            </v-navigation-drawer>
            <!-- CONTENIDO MENU VERTICAL END-->


            <!-- Menú horizontal -->
            <v-app-bar app :color="colorHeader" dense elevation="24">
                <v-app-bar-nav-icon @click="drawer = !drawer" :style="item_style()"></v-app-bar-nav-icon>

                <v-toolbar-title>
                    <!-- INICIO -->
                </v-toolbar-title>

                <v-spacer></v-spacer>
                <v-list-item right>
                    <v-spacer></v-spacer>
                    <inertia-link :href="route('lowStocks.index')">
                        <v-icon medium dark>mdi-bell</v-icon>
                        <v-badge offset-y="-9" offset-x="-5" dot left overlap color="red" content="1"
                            v-if="this.$page.props.flash.nrodts>0" v-show="true">
                        </v-badge>
                    </inertia-link>
                </v-list-item>
                <v-card>
                    
                </v-card>

                <v-menu left bottom>
                    <template v-slot:activator="{ on, attrs }">
                        <v-btn icon v-bind="attrs" v-on="on" :style="item_style()">
                            <v-icon :style="item_style()">mdi-dots-vertical</v-icon>
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
            <pre>{{ $page }}</pre>
        </v-main>

        <!-- PIE DE PAGINA -->
        <!-- <v-footer padless v-bind="color=" height="60px"> -->
        <v-footer padless height="60px" :color="colorFooter" app>
            <v-col class="text-center" cols="12" absolute :style="item_style()">
                {{ new Date().getFullYear() }} — <strong>{{this.$page.props.company.name}}</strong>
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
            logoEmpresa: this.$page.props.colors[0].logo,
            colorMenu: this.$page.props.colors[0].color_menu,
            colorSubMenu: this.$page.props.colors[0].color_sub_menu,
            colorHeader: this.$page.props.colors[0].color_header,
            colorFooter: this.$page.props.colors[0].color_footer,
            colorText: this.$page.props.colors[0].color_text,
        };
    },
    methods: {

        logout() {
            this.$inertia.post(route('logout'));
        },
        item_style() {
            return {
                color: this.colorText,
            }
        }
    }
};
</script>
