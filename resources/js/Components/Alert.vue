<template>
    <div>
        <div v-for="item in Object.keys(errors)" :key="item">
            <v-alert type="warning" border="left" dismissible>
                {{ errors[item] }}
            </v-alert>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        errors: {
            required: true,
            type: Object,
        },
    }
}
</script>
