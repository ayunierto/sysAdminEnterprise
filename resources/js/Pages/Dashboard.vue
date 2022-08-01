<template>
    <admin-layout>

        <template v-slot:company_name>
            <div>{{ company.name }}</div>
        </template>

        <v-row>
            <v-col cols="12" sm="6" md="4">
                <v-card rounded>
                    <v-list-item three-line>
                        <v-list-item-content>
                            <div class="text-overline mb-4">
                                PRODUCTOS
                            </div>
                            <v-list-item-title class="text-h5 mb-1" >
                                {{ products }}
                            </v-list-item-title>
                        </v-list-item-content>
                        <v-list-item-avatar tile size="80">
                            <v-img
                                src="https://www.zarla.com/images/zarla-al-pan-pan-1x1-2400x2400-20220119-47tq9t6cx4cyjdyhyrgt.png?crop=1:1,smart&width=250&dpr=2"
                            ></v-img>
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
            </v-col>
        </v-row>
    </admin-layout>
</template>

<script>
    import AdminLayout from '@/Layouts/AdminLayout'

    export default {
        components: {
            AdminLayout,
        },

        props: ['products', 'company'],
    }
</script>
