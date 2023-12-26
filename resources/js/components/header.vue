<template>
     <nav style="background-color: #304D30;; box-shadow: 5px 0px 10px rgba(0, 0, 0, 0.3);" class="navbar navbar-expand-lg bg-body-danger base_header">
      <div class="container-fluid ">
        <div class="navbar-collapse  d-flex justify-content-end" >
                <ul class="navbar-nav   justify-content-end">
                    <li class="nav-item" v-if="!isRouteActive('sesion_init')">
                        <a class="nav-link active" aria-current="page" href="#">
                            <RouterLink :to="{ name: 'sesion_init' }">
                                <button style="border: 0px solid;" class="btn btn-primary btn_config rounded-pill" >
                                    Lista de productos
                                </button>
                            </RouterLink>
                        </a>
                    </li>
                    <li class="nav-item" hidden>
                        <a class="nav-link active" aria-current="page" href="#">
                            <button class="btn btn-primary btn_config rounded-pill" @click="mostrarContenidoEnComponente2">Crear Usuario</button>
                        </a>
                    </li>
                    <li class="nav-item" v-if="!isRouteActive('ver_marcas')">
                        <a class="nav-link active" aria-current="page" href="#">
                            <RouterLink :to="{ name: 'ver_marcas' }">
                                <button style="border: 0px solid;" class="btn btn-primary btn_config rounded-pill" >
                                    marcas
                                </button>
                            </RouterLink>
                        </a>
                    </li>
                    <li class="nav-item" v-if="!isRouteActive('ver_productos')">
                        <a class="nav-link active" aria-current="page" href="#">
                            <RouterLink :to="{ name: 'ver_productos' }">
                            <button style="border: 0px solid;" class="btn btn-primary btn_config rounded-pill">
                                    productos
                                </button>
                            </RouterLink>
                        </a>
                    </li>
                    <li class="nav-item" v-if="!isRouteActive('ver_categorias')">
                        <a class="nav-link active" aria-current="page" href="#">
                            <RouterLink :to="{ name: 'ver_categorias' }">
                                <button style="border: 0px solid;" class="btn btn-primary btn_config rounded-pill">
                                    categorias
                                </button>
                            </RouterLink>

                        </a>
                    </li>
                    <li class="nav-item" v-if="!isRouteActive('ver_providers')">
                        <a class="nav-link active" aria-current="page" href="#">
                            <RouterLink :to="{ name: 'ver_providers' }">
                                <button style="border: 0px solid;" class="btn btn-primary btn_config rounded-pill">
                                    provedores
                                </button>
                            </RouterLink>
                        </a>
                    </li>
                    <li class="nav-item" v-if="!isRouteActive('ver_ventas')">
                        <a class="nav-link active" aria-current="page" href="#">
                            <RouterLink :to="{ name: 'ver_ventas' }">
                                <button style="border: 0px solid;" class="btn btn-primary btn_config rounded-pill">
                                    ventas
                                </button>
                            </RouterLink>
                        </a>
                    </li>
                    <li class="nav-item mt-2">
                        <div class="btn-group">
                                          <button type="button" class="btn btn-primary btn_config dropdown-toggle" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-gear-fill" viewBox="0 0 16 16">
                                                <path d="M9.405 1.05c-.413-1.4-2.397-1.4-2.81 0l-.1.34a1.464 1.464 0 0 1-2.105.872l-.31-.17c-1.283-.698-2.686.705-1.987 1.987l.169.311c.446.82.023 1.841-.872 2.105l-.34.1c-1.4.413-1.4 2.397 0 2.81l.34.1a1.464 1.464 0 0 1 .872 2.105l-.17.31c-.698 1.283.705 2.686 1.987 1.987l.311-.169a1.464 1.464 0 0 1 2.105.872l.1.34c.413 1.4 2.397 1.4 2.81 0l.1-.34a1.464 1.464 0 0 1 2.105-.872l.31.17c1.283.698 2.686-.705 1.987-1.987l-.169-.311a1.464 1.464 0 0 1 .872-2.105l.34-.1c1.4-.413 1.4-2.397 0-2.81l-.34-.1a1.464 1.464 0 0 1-.872-2.105l.17-.31c.698-1.283-.705-2.686-1.987-1.987l-.311.169a1.464 1.464 0 0 1-2.105-.872l-.1-.34zM8 10.93a2.929 2.929 0 1 1 0-5.86 2.929 2.929 0 0 1 0 5.858z"/>
                                            </svg>                                
                                          </button>
                                          <ul class="dropdown-menu dropdown-menu-lg-end">
                                            <li>
                                              
                                                  <button class="dropdown-item no_deco">
                                                    <li><a class="dropdown-item" href="#">   
                                                        <button class="dropdown-item " @click="mostrarContenidoEnComponente2">Crear Usuario</button>
                                                    </a></li>
                                                  </button>

                                            </li>
                                            <li>
                                              <button class="dropdown-item" type="button" >
                                                <li><a class="dropdown-item" href="#">
                                                    <button class="dropdown-item " @click="cerrar_sesion">Cerrar Sesión</button>
                                                </a></li>
                                              </button>
                                            </li>
                                          </ul>
                            </div>
                    </li>

                </ul>
        </div>

      </div>
    </nav>
    <register_admin :mostrarContenido="mostrarContenidoComponente2" @cerrar-contenido="cerrarContenidoEnComponente2" ></register_admin>

</template>

<style>

</style>

<script>
import { RouterLink } from 'vue-router';
import { mapActions } from 'vuex';
import register_admin from './register_admin.vue';
import axios from 'axios';
export default{
    data(){
        return{
            mostrarContenidoComponente2: false    
        };
    },
    components:{
        register_admin
    },
    methods:{
        ...mapActions('users',['logout_session']),
        async cerrar_sesion(){
            console.log('si llego')
            this.logout_session()
        },
        isRouteActive(routeName) {
            return this.$route.name === routeName;
        },
        registrarUsuario(){
            console.log('se activo el metodo de registar Usuario');
            axios.get('/register')
            .then(response =>{
                console.log(response)
                const renderedView = response.data.view;
                this.$refs.registroContainer.innerHTML = renderedView;

            })
            .catch(error => {
                console.error(error);
            });
        },
        mostrarContenidoEnComponente2() {
            this.mostrarContenidoComponente2 = true;
        },
        cerrarContenidoEnComponente2() {
         this.mostrarContenidoComponente2 = false;
        },
    },
}
</script>