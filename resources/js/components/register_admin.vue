<template>
    <div v-if="mostrarContenido" class="base_module">
        <button v-if="render_second" @click="cerrarContenido" class="buton_espcter " >Cerrar Contenido</button>
        <div ref="registroContainer" >

        </div>
    </div>



</template>
<style>


</style>
<script>
export default {
  data(){
    return{
      render_second:false
    };  
  },
  props: {
    mostrarContenido: Boolean
  },
  methods:{
    cerrarContenido() {
      this.$emit('cerrar-contenido');
    },
    cargarContenido(){
            axios.get('/register')
            .then(response =>{
                console.log(response)
                const renderedView = response.data.view;
                this.$refs.registroContainer.innerHTML = renderedView;
                //tengo que hacer que primero renderize la vista y luego renderize el boton
                if(renderedView){
                  this.render_second = true;
                }
            })
            .catch(error => {
                console.error(error);
            });
    }, 
  },
  watch:{
    mostrarContenido(nuevoValor) {
      if (nuevoValor) {
        this.cargarContenido();
      }
    }   
  }

}
</script>