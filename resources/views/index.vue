<template>

  <list_of_products></list_of_products>

</template>

<style scoped>
.border_r{
    border: 5px solid red;
}
</style>

<script>
import { defineComponent } from 'vue'
import { mapActions  } from 'vuex';
import { inject } from 'vue';
import list_of_products from '../js/components/list_of_products.vue'
import header_vue from '../js/components/header.vue'
export default defineComponent({
    components:{
      list_of_products,
      header_vue,
    }

 

  
})
</script>

