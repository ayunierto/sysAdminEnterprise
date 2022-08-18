<template>
    <div>
        <!-- <div v-for="item in Object.keys(errors)" :key="item">
            <v-alert type="warning" border="left" dismissible>
                {{ errors[item] }}
            </v-alert>
        </div> -->
        <div v-show="$page.props.errorBags.default" style="position: absolute; right: 10px; top: 20px; z-index:3;">
            <div v-for="item in Object.keys($page.props.errors)" :key="item">
                <v-expand-transition>
                    <div border="left" id="alerts" class="elevation-15 warning mb-2 px-3 py-3 " style="color: white;" @click="seen = !seen">
                        <v-icon class="mr-2"  style="color: white;">mdi-alert</v-icon>
                        {{ $page.props.errors[item] }}
                    </div>
                </v-expand-transition>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data(){
        return {
            seen: true
        }
    }
}
</script>
