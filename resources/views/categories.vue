<template>
<!-- <header_vue></header_vue> -->
<div style="margin-left: 3.5vh;" class="d-flex">
    <h1 class="ms-4 btn_title">Categorias</h1>
</div>

<div class="container-fluid mt-3">
    <div class="container ">
        <div style="box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.3);" class="row">
            <div class="col-12 base_bag_providers">
                        <div >
                            <form @submit.prevent="crearCategoria">
                                <h2 style="color: white;">Crear nueva categoria</h2>
                                <div class="mb-3">
                                    <input placeholder="Nombre de la categoria" class="form-control" v-model="categoryData.name_category" type="text" id="name_provider" name="name_provider" required>
                                </div>  
                                <div class="mb-3">
                                    <textarea  placeholder="Descripción" v-model="categoryData.description" class="form-control text_area_control" required></textarea>
                                </div>  
                                <button style="border: 0px solid; box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.3);" type="submit" class="btn btn-primary btn_config">Crear Categoria</button>
                            </form>
                            <div v-if="success_created">
                                <h3 class="text-center bg-success rounded" >Categoria Creada</h3>
                            </div>
                        </div>
                        <div class="base_search">
                            <div class="d-flex  justify-content-end">
                                <div style="width: 400px;">
                                    <SearchComponent @search="getcategoriesVuex"/>
                                    <!-- <form class="d-flex" role="search">
                                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                                    <button class="btn btn-danger" type="submit">Search</button>
                                    </form> -->
                                </div>
                            </div>
                        </div>
            </div>
            <div class="base_pag_pro col-12"  v-for="(categorias, index) in categories" :key="categorias.id_category"  v-if="categories_quest">
                <div class="row base_bag_pag_pro_content">
                    <div class="col-auto  d-flex align-items-center">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="140" height="140" fill="currentColor" class="bi bi-basket2-fill" viewBox="0 0 16 16">
                            <path d="M5.929 1.757a.5.5 0 1 0-.858-.514L2.217 6H.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h.623l1.844 6.456A.75.75 0 0 0 3.69 15h8.622a.75.75 0 0 0 .722-.544L14.877 8h.623a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1.717L10.93 1.243a.5.5 0 1 0-.858.514L12.617 6H3.383L5.93 1.757zM4 10a1 1 0 0 1 2 0v2a1 1 0 1 1-2 0zm3 0a1 1 0 0 1 2 0v2a1 1 0 1 1-2 0zm4-1a1 1 0 0 1 1 1v2a1 1 0 1 1-2 0v-2a1 1 0 0 1 1-1"/>
                            </svg>
                        </div>
                    </div>
                    <div class="col-10">
                                    <div class="content_list_of_products">
                                        <div class="border_separator ">
                                            <div class="d-flex justify-content-between">
                                                <h3 class="d-flex align-items-center">{{ categorias.name_category }}</h3>
                                            </div>
                                        </div>
                                        <div class="d-inline-block">
                                            <a>{{ categorias.description }}</a>
                                        </div>

                                     </div>
                    </div>
                    <div class="col-12 ">
                        <div class="div">
                            <div class="div ">
                                <div class="d-flex justify-content-end">
                                    <button  @click="mostrarFormularioActualizacion(categorias)"  type="button" class="btn btn-primary me-3 btn_config" data-bs-toggle="modal" :data-bs-target="'#exampleModal-' + index">
                                        Actualizar Categorias
                                    </button>
                                    <button class="btn btn-danger" @click="eliminarCategoria(categorias.id_category)">Eliminar</button>
                                </div>
                                <div class="modal fade" :id="'exampleModal-' + index" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Actualizar categoria: {{ categorias.name_category }} </h1>
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
                                                <div v-if="success_category">
                                                    <h3 class="text-center bg-success rounded" >Categoria actualizada</h3>
                                                </div>
                                            </div>
                                            <form @submit.prevent="actualizarCategoria">
                                                <div class="mb-3">
                                                    <label for="exampleInputEmail1" class="form-label">Nuevo nombre</label>
                                                    <input v-model="updatedCategoryData.name_category" class="form-control base_form_update" type="text" id="update_name_provider" name="update_name_provider" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="exampleInputPassword1" class="form-label">Nueva descripcion</label>
                                                    <input v-model="updatedCategoryData.description" type="text" class="form-control base_form_update" id="update_description" name="update_description" required>
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
      <div class="container" v-if="categories_quest == false">
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
            categoryData:{
                name_category:'',
                description:'',
            },
            success_category: false,
            success_created: false,
            mostrarFormulario: false,
            updatedCategoryData:{
                name_category:'',
                description:'',
            },
            validationErrors:null,
        }
    },
    computed:{
        ...mapState('categories',['categories']),
        categories_quest(){
        // console.log(this.categories);
        if(this.categories.length > 0){
        //   console.log('entro aqui a true')
          return true
        }else{
        //   console.log('entro aqui a false')
          return false
        }
      },
    },
    methods:{
        ...mapActions('categories',['getCategories','createCategories','updateCategories','deleteCategories']),
        async getcategoriesVuex(search = null){
            await this.getCategories(search);
        },
        crearCategoria(){
            this.createCategories(this.categoryData);
            this.success_created = true
            // console.log('si termino')
            this.categoryData = { name_brand: '', description: '' };
            setTimeout(() => {
                this.success_created = false; 
            }, 3000);
        },
        async actualizarCategoria(){
            const actualizacionExitosa = await this.updateCategories({
                id: this.updatedCategoryData.id_category,
                updatedData: this.updatedCategoryData,
            })
            if(actualizacionExitosa === true){
                await this.$store.dispatch('categories/getCategories');
                // console.log('categoria actualizada con éxito');
                this.success_provider = true;
                this.cancelarActualizacion();
            } else if (actualizacionExitosa.validationErrors){
                this.validationErrors = actualizacionExitosa.validationErrors;
                // console.log('Fallo al actualizar la categoria',this.validationErrors);
                this.cancelarActualizacion();
            }
        },
        mostrarFormularioActualizacion(categorias){
            this.mostrarFormulario = true;
            this.updatedCategoryData ={
                id_category: categorias.id_category,
                name_category: categorias.name_category,
                description: categorias.description,
            };
        },
        cancelarActualizacion() {
            this.mostrarFormulario = false;
        },
        async eliminarCategoria(id){
            if (confirm('¿Estás seguro de que deseas eliminar esta categoria')) {
                this.deleteCategories(id).then(success => {
                if (success) {
                    console.log('categoria eliminada con éxito');
                } else {
                    console.log('Fallo al eliminar la categoria');
                }
                });
            }
            await this.$store.dispatch('categories/getCategories');
        }

    },
    mounted(){
        this.getcategoriesVuex();
    }
}
</script>