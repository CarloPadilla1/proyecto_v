<template>
    <!-- <header_vue></header_vue> -->
    <div style="margin-left: 3vh;" class="d-flex">
              <h1 class="ms-4 btn_title">Marcas</h1>
    </div>
<div class="container-fluid mt-3">
    <div class="container">
        <div class="row">
            <div class="col-12 base_bag_providers">
                        <div >
                            <form @submit.prevent="crearMarca">
                                <h2 style="color: white;">Crear nueva Marca</h2>
                                <div class="mb-3">
                                    <input placeholder="Nombre de la marca" class="form-control" v-model="brandData.name_brand" type="text" id="name_provider" name="name_provider" required>
                                </div>  
                                <div class="mb-3">
                                    <textarea  placeholder="Descripción" v-model="brandData.description" class="form-control text_area_control" required></textarea>
                                </div>  
                                <button style="border: 0px solid; box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.3);" type="submit" class="btn btn-primary btn_config">Crear marca</button>
                            </form>
                            <div v-if="success_created">
                                <h3 class="text-center bg-success rounded" >Marca creada</h3>
                            </div>
                        </div>
                        <div class="base_search">
                            <div class="d-flex  justify-content-end">
                                <div style="width: 400px;">
                                    <SearchComponent @search="getbrandsVuex"/>
                                </div>
                            </div>
                        </div>
            </div>
            <div class="base_pag_pro col-12"  v-for="(marcas, index) in brands" :key="marcas.id_brand"  v-if="brands_quest">
                <div class="row base_bag_pag_pro_content">
                    <div class="col-auto  d-flex align-items-center">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="140" height="140" fill="currentColor" class="bi bi-building-fill" viewBox="0 0 16 16">
                            <path d="M3 0a1 1 0 0 0-1 1v14a1 1 0 0 0 1 1h3v-3.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 .5.5V16h3a1 1 0 0 0 1-1V1a1 1 0 0 0-1-1zm1 2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm3.5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5M4 5.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zM7.5 5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5m2.5.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zM4.5 8h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5m2.5.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm3.5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5"/>
                            </svg>
                        </div>
                    </div>
                    <div class="col-10">
                                    <div class="content_list_of_products">
                                        <div class="border_separator ">
                                            <div class="d-flex justify-content-between">
                                                <h3 class="d-flex align-items-center ">{{ marcas.name_brand }}</h3>
                                            </div>
                                        </div>
                                        <div class="d-inline-block">
                                            <a>{{ marcas.description }}</a>
                                        </div>

                                     </div>
                    </div>
                    <div class="col-12 ">
                        <div class="div">
                            <div class="div ">
                                <div class="d-flex justify-content-end">
                                    <button @click="mostrarFormularioActualizacion(marcas)"  type="button" class="btn btn-primary me-3 btn_config" data-bs-toggle="modal" :data-bs-target="'#exampleModal-' + index">
                                        Actualizar marca
                                    </button>
                                    <button class="btn btn-primary btn_config" @click="eliminarMarca(marcas.id_brand)">Eliminar</button>
                                </div>
                                <div class="modal fade" :id="'exampleModal-' + index" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Actualizar marca: {{ marcas.name_brand }} </h1>
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
                                                <div v-if="success_brand">
                                                    <h3 class="text-center bg-success rounded" >Marca actualizada</h3>
                                                </div>
                                            </div>
                                            <form @submit.prevent="actualizarMarca">
                                                <div class="mb-3">
                                                    <label for="exampleInputEmail1" class="form-label">Nuevo nombre</label>
                                                    <input v-model="updatedBrandData.name_brand" class="form-control base_form_update" type="text" id="update_name_provider" name="update_name_provider" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="exampleInputPassword1" class="form-label">Nueva descripcion</label>
                                                    <input v-model="updatedBrandData.description" type="text" class="form-control base_form_update" id="update_description" name="update_description" required>
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
<div class="border_r" hidden>
    <div class="border_r">
        <ul>
            <li v-for="(marcas, index) in brands" :key="marcas.id_brand">
                {{ marcas.id_brand }}
                {{ marcas.name_brand }}
                {{ marcas.description }}
                <button @click="mostrarFormularioActualizacion(marcas)">Actualizar</button>
                <button @click="eliminarMarca(marcas.id_brand)">Eliminar</button>
    
            </li>
        </ul>
    
    </div>
    <div class="border_black">
        <div>
            <form @submit.prevent="crearMarca">
            <label for="name_brand">Nombre de la marca</label>
            <input v-model="brandData.name_brand" type="text" id="name_brand" name="name_brand" required>
    
            <label for="description">Descripción</label>
            <textarea v-model="brandData.description" id="description" name="description" required></textarea>
    
            <button type="submit">Crear Marca</button>
            </form>
        </div>
    </div>
    <div class="border_y">
        <div class="border_y" v-if="mostrarFormulario">
          <h3>Actualizar Marca</h3>
          <form @submit.prevent="actualizarMarca">
            <label for="update_name_brand">Nuevo nombre</label>
            <input v-model="updatedBrandData.name_brand" type="text" id="update_name_brand" name="update_name_brand" required>
    
            <label for="update_description">Nueva descripción</label>
            <textarea v-model="updatedBrandData.description" id="update_description" name="update_description" required></textarea>
    
            <button type="submit">Guardar Cambios</button>
            <button @click="cancelarActualizacion">Cancelar</button>
          </form>
        </div>
        <div v-if="validationErrors">
                        <ul>
                            <li v-for="(errors, field) in validationErrors">
                                <strong>{{ field }}:</strong>
                                <ul>
                                    <li v-for="error in errors">{{ error }}</li>
                                </ul>
                            </li>
                        </ul>
        </div>
    
    </div>
</div>
    <div>
      <div class="container" v-if="brands_quest == false" >
        <div class="p-4 rounded no_cerf">
          <h2 class="text-center">No hay marcas disponibles</h2>
        </div>
      </div>
    </div>

</template>

<style>

</style>

<script>
import { mapState, mapActions } from 'vuex';
import header_vue from '../js/components/header.vue';
import SearchComponent from '../js/components/SearchComponent.vue';
export default {
    components:{
        header_vue,
        SearchComponent
    },
    data(){
        return{
            brandData: {
                name_brand: '',
                description: '',
            },  
            mostrarFormulario: false,
            success_created: false,
            success_brand: false,
            updatedBrandData: {
                name_brand: '',
                description: '',
            },
            validationErrors: null, // Agrega esta propiedad para almacenar los errores
        }
    },
    computed:{
        ...mapState('brands', ['brands']),
        brands_quest(){
        // console.log(this.brands);
        if(this.brands.length > 0){
        //   console.log('entro aqui a true')
          return true
        }else{
        //   console.log('entro aqui a false')
          return false
        }
      },
    },
    methods:{
        ...mapActions('brands', ['getbrands','createBrand','updateBrand','deleteBrand']), // Mapea la acción para obtener productos
        async getbrandsVuex(search = null) {
            await this.getbrands(search);
        },
        crearMarca(){
            this.createBrand(this.brandData); 
            // console.log('si termino')
            this.success_created = true
            this.brandData = { name_brand: '', description: '' }; // Restablece el formulario
            setTimeout(() => {
                this.success_created = false; 
            }, 3000);
        },
        async actualizarMarca(){
            const actualizacionExitosa = await this.updateBrand({
                id: this.updatedBrandData.id_brand,
                updatedData: this.updatedBrandData,
            });
            if (actualizacionExitosa === true ) {
                // await new Promise((resolve) => setTimeout(resolve, 500));
                // await this.getbrands();
                await this.$store.dispatch('brands/getbrands');
                // console.log('Marca actualizada con éxito');
                this.success_brand = true;
                setTimeout(() => {
                this.success_brand = false; 
                }, 3000);

            } else if (actualizacionExitosa.validationErrors) {
                this.validationErrors = actualizacionExitosa.validationErrors;
                // console.log('Fallo al actualizar la marca',this.validationErrors);
                this.cancelarActualizacion();
            }
        },
        
        mostrarFormularioActualizacion(marcas) {
            this.mostrarFormulario = true;
            this.updatedBrandData = {
                id_brand: marcas.id_brand,
                name_brand: marcas.name_brand,
                description: marcas.description,
            };
        },
        cancelarActualizacion() {
            this.mostrarFormulario = false;
        },
        async eliminarMarca(id) {
            if (confirm('¿Estás seguro de que deseas eliminar esta marca?')) {
                this.deleteBrand(id).then(success => {
                if (success) {
                    // console.log('Marca eliminada con éxito');
                } else {
                    // console.log('Fallo al eliminar la marca');
                }
                });
            }
            await this.$store.dispatch('brands/getbrands');
        },
    },
    mounted(){
        this.getbrandsVuex();
    }



}

</script>