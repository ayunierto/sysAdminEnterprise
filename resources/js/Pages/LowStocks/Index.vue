<template>
    <admin-layout>

        <template v-slot:company_name>
            <div>{{ company.name }}</div>
        </template>

        <v-alert type="success" border="left" dismissible v-if="$page.props.flash.message">
            {{ $page.props.flash.message }}
        </v-alert>

        <!-- Alertas -->
        <div v-if="$page.props.errorBags.default">
            <div v-for="item in Object.keys($page.props.errors)" :key="item">
                <v-alert type="warning" border="left" dismissible>
                    {{ $page.props.errors[item] }}
                </v-alert>
            </div>
        </div>
        <!-- Fin de Alertas -->

        <v-card elevation="24" color="blue lighten-4" outlined>
            <v-card-title>
                PRODUCTOS CON BAJO STOCK
                <v-spacer></v-spacer>
                <v-text-field v-model="search" append-icon="mdi-magnify" label="Buscar" single-line hide-details>
                </v-text-field>
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
            {text: 'Descripción', value: 'description'}]" :items="products" :items-per-page="5"
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

    </admin-layout>
</template>

<script>
import AdminLayout from '@/Layouts/AdminLayout'
import route from '../../../../vendor/tightenco/ziggy/src/js'

export default {
    props: [
        'products',
        'company',
    ],
    components: {
        AdminLayout,
    },
    data() {
        return {
            search: '',
        }
    },
}
</script>
