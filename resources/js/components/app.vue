<template>

    <header_vue></header_vue>

        <router-view>
        </router-view>
</template>

<style>

</style>
<script>
import header_vue from './header.vue';
export default{
    components:{
        header_vue
    }
}
</script>