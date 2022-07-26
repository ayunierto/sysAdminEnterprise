<template>
    <admin-layout>
        <v-card elevation="12">
            <v-card-title primary-title>
                <v-row>
                    <v-col>
                        <h3 class="headline mb-0">Listado de Productos</h3>
                    </v-col>
                    <v-col class="text-right">
                        <inertia-link :href="route('products.create')">
                            <v-btn color="success">Agregar Producto</v-btn>
                        </inertia-link>
                    </v-col>
                    
                </v-row>
            </v-card-title>
            <v-card-text>
                <v-simple-table>
                    <template v-slot:default>
                    <thead>
                        <tr>
                            <th class="text-left">
                                NOMBRE
                            </th>
                            <th class="text-left">
                                CODIGO
                            </th>
                            <th class="text-left">
                                STOCK
                            </th>
                            <!-- <th class="text-left">
                                PRECIO COMPRA
                            </th> -->
                            <th class="text-left">
                                PRECIO VENTA
                            </th>
                            <th class="text-left">
                                CATEGORIA
                            </th>
                            
                            <th class="text-left">
                                MEDIDA
                            </th>
                            <th class="text-left">
                                PROVEEDOR
                            </th>
                            <th class="text-center">
                                ACCIONES
                            </th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <tr
                        v-for="item in products"
                        :key="item.name"
                        >
                            <td>{{ item.name }}</td>
                            <td>{{ item.code }}</td>
                            <td>{{ item.stock }}</td>
                            <!-- <td>{{ item.purchase_price }}</td> -->
                            <td>{{ item.sale_price }}</td>
                            <td>{{ item.category }}</td>
                            <td>{{ item.measure }}</td>
                            <td>{{ item.provider }}</td>
                            <td>
                                <v-row justify="center">
                                    <v-col cols="4">
                                        <inertia-link :href="route('products.show', item.id)">
                                            <v-btn icon color="green"> 
                                                <v-icon>mdi-eye</v-icon>
                                            </v-btn>
                                        </inertia-link>
                                    </v-col>
                                    <v-col cols="4">
                                        <inertia-link :href="route('products.edit', item.id)">
                                            <v-btn icon color="blue">
                                                <v-icon>mdi-pencil</v-icon>
                                            </v-btn>
                                        </inertia-link>
                                    </v-col>
                                    <v-col cols="4">
                                        <inertia-link :href="route('products.destroy', item.id)">
                                            <v-btn icon color="red">
                                                <v-icon>mdi-delete</v-icon>
                                            </v-btn>
                                        </inertia-link>
                                    </v-col>
                                </v-row>
                            </td>
                        </tr>
                    </tbody>
                    </template>
                </v-simple-table>
            </v-card-text>
        </v-card>
    </admin-layout>
</template>

<script>
    import AdminLayout from '@/Layouts/AdminLayout'

    export default {
        props: [
            'products', 
            'companies', 
            'categories', 
            'marks',
            'measures',
            'providers',
            'presentations',
            'batches',
        ],
        components: {
            AdminLayout
        },
        data () {
            return {
                
                dialog: false,

            }
        },

        
    }

</script>