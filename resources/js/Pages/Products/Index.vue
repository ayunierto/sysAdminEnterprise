<template>
    <admin-layout>

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