<template>
    <admin-layout>
        <inertia-link :href="route('categories.create')">
            <v-btn color="primary" elevation="2" class="mb-4">Crear Categoría</v-btn>
        </inertia-link>
        <template>
            <v-data-table
            :headers="headers"
            :items="desserts"
            :items-per-page="5"
            class="elevation-1"
            ></v-data-table>
        </template>
        <!-- {{ $page.props.categories }} -->
    </admin-layout>
</template>

<script>
    import AdminLayout from '@/Layouts/AdminLayout'

    export default {
        props: ['categories'],
        components: {
            AdminLayout,
        },
        data () {
            return {
                headers: [
                    { text: 'Nombre', value: 'name' },
                    { text: 'Descripción', value: 'description' },
                ],
                desserts: this.categories
            }
        },
    }
</script>
