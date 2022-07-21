<template>
    <admin-layout>
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

            }
        },
    }
</script>
