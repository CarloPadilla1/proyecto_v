<template>
<div style="margin-left: 5vh;" class="d-flex">
              <h1 class="ms-4 btn_title">Ventas</h1>
</div>

<div>
  <div class="container-fluid mt-3">
    <div class="container ">
        <div class="row">
            <div class="col-12 ">
                        <div class="base_bag_providers">
                            <form>
                                <h2 style="color: white;" class="ms-3">Gestor de ventas</h2>
                                <div class="container-fluid">
                                  <div class="row">
                                    <div style="width: 50%;" class="col-4">
                                      <div class="d-flex mt-2 mb-2">
                                        <button style="border: 0px solid;" type="button" class="btn btn-primary me-3 btn_config">#venta</button>
                                        <form  role="search" class="flex-grow-0" @submit.prevent="getsellsVuex(id_venta)">
                                          <input v-model="id_venta" class="me-2 form_search_edit" type="search" placeholder="Search" aria-label="Search">
                                          <button style="border: 0px solid;" class="btn btn-danger btn_config" type="submit">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
                                            </svg>                                          
                                        </button>
                                        </form>
                                      </div>
                                      <div class="d-flex mt-2 mb-2">
                                        <button style="border: 0px solid;" type="button" class="btn btn-primary me-3 btn_config">Cliente</button>
                                        <form  role="search" class="flex-grow-0" @submit.prevent="getsellsVuex(venta_name_user)">
                                          <input v-model="venta_name_user" class="me-2 form_search_edit" type="search" placeholder="Search" aria-label="Search">
                                          <button class="btn btn-danger btn_config" type="submit">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
                                            </svg>    
                                          </button>
                                        </form>
                                      </div>
                                    </div>
                                    <div style="width: 50%;" class="col-8">
                                      <div class="base_search base_bag_providers_search">
                                        <div style="margin-bottom: 5vh;" class="d-flex mt-0  justify-content-end">
                                          <h3 class="btn_edit ">Buscar Productos</h3>
                                            <div style="width: 400px;">
                                                <SearchComponent @search="getsellsVuex"/>
                                            </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>

                            </form>
                        </div>

            </div>


          </div>
        <!-- el v-for deberia ir aqui donde esta la clase del row por que viendo el ejemplo habra que que tomar cada fila con sus respectivo historial -->
        <!-- ay dos formas de hacerlo o se hace que solo haya unos datos activos y que el col-9 y el col-3 vayan muntando o hacer que en historial se realize caundo se haga un click un desplegable en base a la index -->
        
        <div class="container-fluid relleno_w p-4">

          <div class="row border_vista_1 relleno_w">
                <!-- toda venta que se agregue debe ser la que se muestre en el col-9 y col-3 y la anterior debe ir al historial-->
                <div class="col-9  " v-if="preview_sell">
                  <div class="base_purchase_state mt-3 mb-3 ">
                    <h2>Fecha  {{ preview_sell.created_at }}</h2>
                    <div class="boeder_o table-responsive">
                      <table class="table table-borderless table align-middle">
                            <thead>
                              <tr>
                                <th scope="col" >#De venta</th>
                                <th scope="col" >Categoria</th>
                                <th scope="col" >Usuario</th>
                                <th scope="col" >Total</th>
                                <th scope="col" >Descripcion</th>
                              </tr>
                            </thead>
                              <tbody>
                                <tr>
                                  <th scope="col">V/00{{ preview_sell.sell }}</th>
                                  <td>
                                      <a v-for="linea_ventapre in preview_sell.sale_line">
                                          <a v-for="linea_categories in linea_ventapre.product.categories">
                                          {{ linea_categories.name_category }},
                                        </a>
                                      </a> 
                                  </td>
                                  <td>{{ preview_sell.user.name_user }}</td>
                                  <td>${{ preview_sell.total_amount }}</td>
                                  <td>
                                    <p v-for="linea_ventapre in preview_sell.sale_line">.....</p>
                                  </td>
                                </tr>
                              </tbody>
                              <thead>
                                <tr>
                                  <th scope="col" class="align-top">
                                      Productos
                                  </th>
                                  <th scope="col" class="align-top">Cantidad</th>
                                  <th scope="col" class="align-top">precio * U</th>
                                  <th scope="col" class="align-top">Impuesto</th>
                                  <th scope="col" class="align-top">Total</th>
                                </tr>
                              </thead>
                              <tbody>
                                <tr>
                                  <th scope="row" >
                                    <p v-for="linea_ventapre in preview_sell.sale_line" >{{ linea_ventapre.product.name_product }}</p>
                                  </th>
                                  <td > 
                                    <p class="ms-3" v-for="linea_ventapre in preview_sell.sale_line" >{{ linea_ventapre.quantity }}</p> 
                                  </td>
                                  <td > 
                                    <p class="ms-3" v-for="linea_ventapre in preview_sell.sale_line" >{{ linea_ventapre.product.inventory.sale_price }}</p>
                                   </td>
                                  <td>0.00 USD</td>
                                  <td><p class="bar_top">${{ preview_sell.total_amount }}</p></td>
                                </tr>
                              </tbody>
                      </table>

                    </div>
                  </div>
                </div>
                <div class="col-3 " v-if="preview_sell" >

                    <div class="d-flex justify-content-end mt-3 me-3">
                      <button @click="reverse_view()">
                        <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-triangle-fill" viewBox="0 0 16 16">
                          <path fill-rule="evenodd" d="M7.022 1.566a1.13 1.13 0 0 1 1.96 0l6.857 11.667c.457.778-.092 1.767-.98 1.767H1.144c-.889 0-1.437-.99-.98-1.767L7.022 1.566z"/>
                        </svg>
                      </button>
                    </div>
                </div>

                <div class="col-12">
                  <div class="base_purchase_state " :class="{ 'border_vista_2': active_purchase_view }"  >
                    <!-- historial deberia ser que cuando se haga click en la flecha de desplegar debe llamar al index con su numero de venta para que cambie el estado de col-9 y col-3  -->
                    <table class="table table-borderless">
                      <thead v-for="(ventas, module) in sells" :key="ventas.sell">
                        <tr>
                          <th scope="col">V/00{{ ventas.sell }}</th>
                          <th scope="col">{{ ventas.name_product }}</th>
                          <th scope="col">{{ ventas.user.name_user }}</th>
                          <th scope="col">${{ ventas.total_amount }}</th>
                          <th scope="col" >

                          </th>
                          <th scope="col">
                              <button @click="purchase_view(ventas)">
                                <img src="../../public/down-arrow_4238471.png" height="20" width="20">
                              </button>
                          </th>
                        </tr>
                      </thead>
                    </table>
                  </div>
                </div>
          </div>

        </div>
    </div>
</div>

 </div>       



</template>

<script>
import { mapState, mapActions } from 'vuex';
import create_purchase from '../js/components/create_purchase.vue';
import SearchComponent from '../js/components/SearchComponent.vue';
export default{
    components:{
        create_purchase,
        SearchComponent
    },
    data(){
      return{
        active_purchase_view: true,
        preview_sell:null,
        id_venta:null,
        venta_name_user:null,
      }
    }, 
    computed:{
      ...mapState('ventas',['sells'])
    },
    methods:{
      ...mapActions('ventas',['getSells']),
        async getsellsVuex(search = null){
          await this.getSells(search);
        }, 

        purchase_view(ventas){
          // console.log(ventas);
          // console.log(ventas.sell);
          const fechaVenta = new Date(ventas.created_at);
          const fechaFormateada = fechaVenta.toISOString().split('T')[0];
          this.preview_sell = {
            ...ventas,
            created_at: fechaFormateada,
          };

          // this.preview_sell = ventas;
          // console.log(this.preview_sell.created_at);
          this.active_purchase_view=true;
        },
        reverse_view(){
              this.preview_sell = null;
        },
    },
    watch: {
      id_venta: function(newVal, oldVal) {

        console.log(`Nuevo valor de id_venta: ${newVal}`);
        this.getsellsVuex(newVal);
      },
      venta_name_user: function(newVal, oldVal) {
        this.getsellsVuex(newVal);
      },
    },
    mounted(){
       this.getsellsVuex();
    }

}
</script>

<style>

</style>