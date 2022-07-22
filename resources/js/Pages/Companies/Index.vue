<template>
    <admin-layout>
        {{ companies }}
    </admin-layout>
</template>

<script>
    import AdminLayout from '@/Layouts/AdminLayout'

    export default {
        props: ['companies'],
        components: {
            AdminLayout,
        },
    }
</script>
