<template>

<div style="margin-left: 3.5vh;" class="d-flex">
              <h1 class="ms-4 btn_title">Provedores</h1>
</div>

<!-- <header_vue></header_vue> -->
<div class="container-fluid mt-3">
    <div class="container ">
        <div class="row">
            <div class="col-12 base_bag_providers">
                        <div >
                            <form @submit.prevent="crearProvedores">
                                <h2 style="color: white;">Crear nuevo Provedor</h2>
                                <div class="mb-3">
                                    <input placeholder="Nombre del provedor" class="form-control" v-model="providerData.name_provider" type="text" id="name_provider" name="name_provider" required>
                                </div>  
                                <div class="mb-3">
                                    <textarea  placeholder="Descripción" v-model="providerData.description" class="form-control text_area_control" required></textarea>
                                </div>  
                                <button style="border: 0px solid; box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.3);" type="submit" class="btn btn-primary btn_config">Crear proveedor</button>
                            </form>
                            <div v-if="success_created">
                                <h3 class="text-center bg-success rounded" >Provedor Creado</h3>
                            </div>
                        </div>
                        <div class="base_search">
                            <div class="d-flex  justify-content-end">
                                <div style="width: 400px;">
                                    <SearchComponent @search="getProvidersVuex"/>
                                </div>
                            </div>
                        </div>
            </div>
            <div class="base_pag_pro col-12"  v-for="(provedores, index) in providers" :key="provedores.id_provider" v-if="providers_quest">
                <div class="row base_bag_pag_pro_content">
                    <div class="col-auto  d-flex align-items-center">
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="140" height="140" fill="currentColor" class="bi bi-person-square" viewBox="0 0 16 16">
                                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
                                <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zm12 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1v-1c0-1-1-4-6-4s-6 3-6 4v1a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1z"/>
                                </svg>
                            </div>
                    </div>
                    <div class="col-10">
                                    <div class="content_list_of_products">
                                        <div class="border_separator ">
                                            <div class="d-flex justify-content-between">
                                                <h3 class="d-flex align-items-center">{{ provedores.name_provider }}</h3>
                                            </div>
                                        </div>
                                        <div class="d-inline-block">
                                            <a>{{ provedores.description }}</a>
                                        </div>

                                     </div>
                    </div>
                    <div class="col-12 ">
                        <div class="div">
                            <div class="div ">
                                <div class="d-flex justify-content-end">
                                    <button  @click="mostrarFormularioActualizacion(provedores)"  type="button" class="btn btn-primary me-3 btn_config" data-bs-toggle="modal" :data-bs-target="'#exampleModal-' + index">
                                        Actualizar provedores
                                    </button>
                                    <button class="btn btn-danger" @click="eliminarMarca(provedores.id_provider)">Eliminar</button>
                                </div>
                                <div class="modal fade" :id="'exampleModal-' + index" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Actualizar producto: {{ provedores.name_provider }} </h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div>
                                                <div v-if="validationErrors">
                                                    <ul>
                                                        <li v-for="(errors, field) in validationErrors" class="bg-danger rounded p-2">
                                                            <strong>{{ field }}:</strong>
                                                            <ul>
                                                                <li v-for="error in errors">{{ error }}</li>
                                                            </ul>
                                                        </li>
                                                    </ul>
                                                </div>  
                                            </div>
                                            <div>
                                                <div v-if="success_provider">
                                                    <h3 class="text-center bg-success rounded" >Provedor actualizado</h3>
                                                </div>
                                            </div>
                                            <form @submit.prevent="actualizarProvedor">
                                                <div class="mb-3">
                                                    <label for="exampleInputEmail1" class="form-label">Nuevo nombre</label>
                                                    <input v-model="updatedProvedorData.name_provider" class="form-control base_form_update" type="text" id="update_name_provider" name="update_name_provider" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="exampleInputPassword1" class="form-label">Nueva descripcion</label>
                                                    <input v-model="updatedProvedorData.description" type="text" class="form-control base_form_update" id="update_description" name="update_description" required>
                                                </div>
                                                <button class="btn btn-primary" type="submit">Guardar Cambios</button>
                                                <button type="button" class="btn btn-secondary ms-3" data-bs-dismiss="modal">Close</button>
                                            </form>

                                        </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>

</div>
    <div>
      <div class="container" v-if="providers_quest == false">
        <div class="p-4 rounded no_cerf">
          <h2 class="text-center">No hay categorias disponibles en el inventario</h2>
        </div>
      </div>
    </div>





</template>

<style>

</style>

<script>
import { mapState, mapActions } from 'vuex';
import header_vue from '../js/components/header.vue'
import SearchComponent from '../js/components/SearchComponent.vue';
export default {
    components:{
      header_vue,
      SearchComponent
    },
    data(){
        return{
            providerData: {
                name_provider: '',
                description: '',
            },  
            mostrarFormulario: false,
            success_provider: false,
            success_created: false,
            updatedProvedorData: {
                name_provider: '',
                description: '',
            },
            validationErrors: null,
        }
    },
    computed:{
        ...mapState('providers', ['providers']),
        providers_quest(){
        // console.log(this.providers);
        if(this.providers.length > 0){
        //   console.log('entro aqui a true')
          return true
        }else{
        //   console.log('entro aqui a false')
          return false
        }
      },
    },
    methods:{
        ...mapActions('providers', ['getProviders','createProviders','updateProviders','deleteProviders']), // Mapea la acción para obtener productos
        async getProvidersVuex(search = null){
            // console.log('si entro a la funcion')
            await this.getProviders(search);
        },
        crearProvedores(){
            this.createProviders(this.providerData);
            // console.log('si termino');
            this.success_created = true
            this.providerData = { name_provider: '', description: ''  }
            setTimeout(() => {
                this.success_created = false; 
            }, 3000);
        },

        async actualizarProvedor(){
            const actualizacionExitosa = await this.updateProviders({
                id: this.updatedProvedorData.id_provider,
                updatedData: this.updatedProvedorData,
            });
            if (actualizacionExitosa === true ) {
                // await new Promise((resolve) => setTimeout(resolve, 500));
                // await this.getbrands();
                await this.$store.dispatch('providers/getProviders');
                this.success_provider = true;
                setTimeout(() => {
                    this.success_provider = false; 
                }, 3000);
                // console.log('Marca actualizada con éxito');
            } else if (actualizacionExitosa.validationErrors) {
                this.validationErrors = actualizacionExitosa.validationErrors;
                // console.log('Fallo al actualizar la marca',this.validationErrors);
                this.cancelarActualizacion();
            }
        },
        mostrarFormularioActualizacion(provedores) {
            //this.mostrarFormulario= true;
            this.updatedProvedorData = {
                id_provider: provedores.id_provider,
                name_provider: provedores.name_provider,
                description: provedores.description,
            };
        },
        cancelarActualizacion() {
            this.mostrarFormulario = false;
        },
        async eliminarMarca(id){
            if (confirm('¿Estás seguro de que deseas eliminar esta marca?')) {
                this.deleteProviders(id).then(success => {
                if (success) {
                    console.log('Marca eliminada con éxito');
                } else {
                    console.log('Fallo al eliminar la marca');
                }
                });
            }
            await this.$store.dispatch('providers/getProviders');
        }
    },
    mounted(){
        this.getProvidersVuex();
    }    
}
</script>