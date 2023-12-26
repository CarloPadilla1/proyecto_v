<template>
  <!-- PRECIO total y precio unitario -->
          <div class="border_blac">
            <div style="margin-left: 3vh;" class="d-flex">
              <h1 class="ms-4 btn_title">Productos</h1>
            </div>
                  <div class="container-fluid ">
                    <div class="row ">
                      <div class="col-md-1 ms-5 offset-md-2 ms-0"></div>
                      <div class="col-md-2 ms-3 ">
                        <SelectCategories @filter_category="Category"/>
                      </div>
                      <div class="col-md-5 ms-0 offset-md-2 ms-0 "></div>
                      <div class="col-2 ms-3  p-1 ">
                        <SearchComponent @search="Search"/>
                      </div>
                    </div>
                  </div>
                  <br><br>
          </div>
          <div v-if="see_palet"  class="border_r base_ventana_list ">
            <div>
              <h4 class="text-center btn_edit_d">Lista de productos vendidos</h4>
              <p>total: {{ total_precio }} </p>
            </div>

            <div class="d-flex justify-content-center">
              <button class="btn btn-success" @click="enviar_datos_venta(paletItems, total_precio)">
                Completar venta
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-check-fill" viewBox="0 0 16 16">
                  <path d="M4 .5a.5.5 0 0 0-1 0V1H2a2 2 0 0 0-2 2v1h16V3a2 2 0 0 0-2-2h-1V.5a.5.5 0 0 0-1 0V1H4zM16 14V5H0v9a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2m-5.146-5.146-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 0 1 .708-.708L7.5 10.793l2.646-2.647a.5.5 0 0 1 .708.708z"/>
                </svg>
              </button>
            </div>
            <div v-for="(infusion, index) in paletItems" :key="index">
                    <div>
                          <h5 class="mt-4 mb-3"> 
                          - {{ infusion.product_infu }} - stock: {{ infusion.stock_infu }}- Cantidad: {{ infusion.count }}
                          Ventas: {{ infusion.sale_infusion }}
                        </h5>
                        <div>Total Producto: {{ infusion.totalProducto_infusion.toFixed(2) }}</div>
                        <button type="button" class="btn btn-success me-2" @click="up_count(index)">+</button>
                        <button type="button" class="btn btn-danger"       @click="down_count(index)">X</button>

                    </div>
                    <h5 v-if="infusion.count >= infusion.stock_infu" class="mt-4 ">
                        Alcanzaste el limite de este producto {{ infusion.product_infu }}
                    </h5>
              </div>
          </div> 
        <div v-if="products_quest">
          <div class="mt-2">
              <div class="container" >
                  <div class="row ">
                      <div class="base_pag_pro col-12  mt-2 " v-for="(producto, index) in products" :key="producto.id" >
                              <div style="border-radius: 10px;" class="row base_bag_pag_pro_content">
                                  <div class="col-auto  d-flex align-items-center">
                                      <!-- <img class="img_base_list_of_products" src="../../../public/place_holder.jpg" > -->
                                      <div>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="140" height="140" fill="currentColor" class="bi bi-box-fill" viewBox="0 0 16 16">
                                          <path fill-rule="evenodd" d="M15.528 2.973a.75.75 0 0 1 .472.696v8.662a.75.75 0 0 1-.472.696l-7.25 2.9a.75.75 0 0 1-.557 0l-7.25-2.9A.75.75 0 0 1 0 12.331V3.669a.75.75 0 0 1 .471-.696L7.443.184l.004-.001.274-.11a.75.75 0 0 1 .558 0l.274.11.004.001 6.971 2.789Zm-1.374.527L8 5.962 1.846 3.5 1 3.839v.4l6.5 2.6v7.922l.5.2.5-.2V6.84l6.5-2.6v-.4l-.846-.339Z"/>
                                        </svg>
                                      </div>
                                  </div>
                                  <div class="col-10">
                                      <div class="content_list_of_products">
                                          <div class="border_separator mb-2">
                                              <div class="d-flex justify-content-between">
                                                  <h3 class="d-flex align-items-center">{{ producto.name_product }}</h3>
                                                  <p class="button_pro">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-seam" viewBox="0 0 16 16">
                                                      <path d="M8.186 1.113a.5.5 0 0 0-.372 0L1.846 3.5l2.404.961L10.404 2zm3.564 1.426L5.596 5 8 5.961 14.154 3.5zm3.25 1.7-6.5 2.6v7.922l6.5-2.6V4.24zM7.5 14.762V6.838L1 4.239v7.923l6.5 2.6zM7.443.184a1.5 1.5 0 0 1 1.114 0l7.129 2.852A.5.5 0 0 1 16 3.5v8.662a1 1 0 0 1-.629.928l-7.185 2.874a.5.5 0 0 1-.372 0L.63 13.09a1 1 0 0 1-.63-.928V3.5a.5.5 0 0 1 .314-.464L7.443.184z"/>
                                                    </svg>
                                                    : {{ producto.inventory?.stock }}
                                                  </p>
                                              </div>
                                          </div>
                                          <p ><p class="btn btn-success rounded-pill m-0">Descripcion:</p> {{ producto.description }}</p>
                                          <div class="d-inline-block" >
                                              <p class="me-3" v-for="categoria in producto.categories"><p class="btn btn-secondary rounded-pill m-0">Categoria:</p> {{ categoria.name_category }}</p>
                                          </div>
                                          <div class="d-inline-block">
                                              <p><p class="btn btn-secondary rounded-pill m-0">Provedor:</p> {{ producto.provider.name_provider }} </p>
                                              <p><p class="btn btn-secondary rounded-pill m-0">Marca:</p>  {{ producto.brand.name_brand }}</p>
                                          </div>
                                          <div class="ms-5 d-inline-block ">
                                              <p><p class="btn btn-info rounded-pill m-0">Valor de compra:</p> ${{ producto.inventory.purchase_price }}</p>
                                              <p><p class="btn btn-info rounded-pill m-0">Valor de venta:</p> ${{ producto.inventory.sale_price }}</p>
                                          </div>
                                          <div class="d-inline-block ">
                                                  <button type="button" class="btn btn-dark ms-4 p-2" :title="producto.inventory.stock>0 ? 'Añadir venta': 'No hay stock'"
                                                    :disabled="producto.inventory.stock===0" @click="toogle_palet(index,producto.name_product,producto.inventory.stock, producto.id_product, producto.inventory.sale_price )">
                                                    Añadir ventas
                                                  </button>
                                          </div>
                                       </div>
                                        
                                  </div>
                              </div>
                      </div>
                  </div>
              </div>
          </div>
          <div class="container mt-4">
              <div class="d-flex justify-content-center ">
          
                  <button @click="prevPage" :disabled="isAtLowerLimit" class="pagination-button prev-button">
                      <svg xmlns="http://www.w3.org/2000/svg" width="26" height="20" fill="currentColor" class="bi bi-arrow-left-circle" viewBox="0 0 16 16">
                          <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-4.5-.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z"/>
                      </svg>
                  </button>
                      <div class="pagination " >
                           <div v-for="(pageNumber,index) in page_cal" :key="index">
                            <!-- goToPage(page) -->
                               <button class="pagination-button numbered-button" @click="fetchPage(pageNumber)" :class="{ 'pagination-button-active': pageNumber === currentPage }">
                                {{ pageNumber }}
                              </button>
                            </div>
                      </div>
                  <button @click="nextPage" :disabled="isAtUpperLimit" class="pagination-button next-button">
                      <svg xmlns="http://www.w3.org/2000/svg" width="26" height="20" fill="currentColor" class="bi bi-arrow-right-circle" viewBox="0 0 16 16">
                          <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM4.5 7.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H4.5z"/>
                      </svg>
                  </button>
            </div>
          </div>
        </div>

        <div>
          <div class="container" v-if="products_quest == false" >
            <div class="p-4 rounded no_cerf">
              <h2 class="text-center">No hay productos</h2>
            </div>
          </div>
        </div>




</template>

<style>
            .prev-button {
              border-top-right-radius: 0;
            }
            
            .next-button {
              border-top-left-radius: 0;
            }
            
            .pagination {
              display: flex;
              justify-content: center;
              align-items: center;
            }
            
            .pagination-button {
              background-color: rgb(162, 145, 53); /* Fondo transparente */
              border: none; /* Sin borde */
              margin: 0 2px; /* Separación entre botones enumerados */
              cursor: pointer;
              border-radius: 5px; /* Redondeo en todos los lados */
              padding: 5px 10px; /* Espaciado interno */
              color: rgb(213, 216, 218); /* Color de texto predeterminado */
            }
            
            .pagination-button:hover {
              background-color: rgb(112, 43, 43); /* Fondo blanco al pasar el mouse */
              color: rgb(52, 143, 213); /* Color de texto al pasar el mouse */
            }
            
            .pagination-button-active {
              background-color: #304D30; /* Color de fondo cuando está activo */
              color: white; /* Color de texto cuando está activo */
            }
</style>

<script>
import { mapState, mapActions, mapGetters } from 'vuex';
import create_purchase from '../components/create_purchase.vue'
import SearchComponent from './SearchComponent.vue';
import SelectCategories from './SelectCategories.vue';

export default {
    components:{
      create_purchase,
      SearchComponent,
      SelectCategories
    },
    data(){
      return{
        active_purchase_view:1,
        see_palet:false,
        products_list_infusion:{
          infusion_product_get:'',
          infusion_stock_get:'',
          infusion_id:'',
        },
        paletItems:[],
        search:'',
        filter_category:''
      }
    },  
    computed:{
        //en limit pusiste una variable en ves de eso pondras this.per_page para no haber problemas
        ...mapState('list_of_products', ['products','currentPage', 'last_page','total_pages','per_page']),
        products_quest(){
        // console.log(this.products);
        if(this.products.length > 0){
          // console.log('entro aqui a true')
          return true
        }else{
          // console.log('entro aqui a false')
          return false
        }
      },


        total_precio(){
          const total = this.paletItems.reduce((total, existe) => total + (existe.count * existe.sale_infusion), 0);
          return total.toFixed(2);
        },
        isAtLowerLimit() {
            return this.currentPage === 1;
        },
        isAtUpperLimit() {
            return this.currentPage === this.last_page;
        },
        page_cal(){
            const elementspage= this.total_pages;
            const starIndex = 1;
            const endIndex  =this.last_page;
            const currentPage = this.currentPage;
            const limit = 2; 
            // console.log(starIndex)
            // console.log(endIndex)
            // console.log(elementspage)
            // console.log(currentPage)
            const page_array = []
            if(endIndex <= limit){
              for (let i = starIndex; i <= endIndex; i++) {
                page_array.push(i);
              }
            }else{
              const halfLimit = Math.floor(limit / 2);
              let start = currentPage - halfLimit;
              let end = currentPage + halfLimit;

              if (start < starIndex) {
                start = starIndex;
                end = start + limit - 1;
              } else if (end > endIndex) {
                end = endIndex;
                start = end - limit + 1;
              }
              if (start > starIndex) {
                page_array.push('...');
     
              }
              for (let i = start; i <= end; i++) {
                page_array.push(i);
              }
              if (end < endIndex) {
                page_array.push('...');
                page_array.push(endIndex);

              }
            }
            //console.log(page_array)
            return page_array
        },
    },
    methods:{
        ...mapActions('list_of_products', ['getproducts']), // Mapea la acción para obtener productos
        ...mapActions('products',['enviar_purchase']),
        //el problema es la paginacion de productos con esto debo hacerlo funcar con ello
        //tengo que hacerlo con el buscador si no funcara
        toogle_palet(index_s,infusion_product,infusion_stock,infusion_id, infusion_ventas){
          //console.log(infusion_ventas);
          //console.log(index_s,infusion_product, infusion_stock, infusion_id);
          //console.log(infusion_id);
          if(this.see_palet == false){
            this.see_palet = true;
          }
          //console.log(this.paletItems);
          let existe = this.paletItems.find(item_infusion => item_infusion.id_infusion === infusion_id);

          if (!existe) {
            existe = {
              product_infu: infusion_product,
              stock_infu: infusion_stock,
              id_infusion: infusion_id,
              sale_infusion: infusion_ventas,
              count: 0,
              totalProducto_infusion: 0,
            };
            this.paletItems.push(existe);
          }

          if (infusion_stock > existe.count) {
            existe.count += 1;
            existe.totalProducto_infusion = existe.count * existe.sale_infusion;
          } else {
            console.log('No puedes añadir más');
          }

        },
        down_count (index) {
          const product = this.paletItems[index];
          if (product.count > 0) {
            product.count -= 1;
            product.totalProducto_infusion = product.count * product.sale_infusion;
          }
          if (this.paletItems[index].count === 0) {
            this.paletItems.splice(index, 1);
            if(this.paletItems.length === 0){
              this.see_palet = false;
            }
          }
        },
        up_count(index) {
          const product = this.paletItems[index];
          if (product.count < product.stock_infu) {
            product.count += 1;
            product.totalProducto_infusion = product.count * product.sale_infusion;
          }
        },

        async enviar_datos_venta(palet){
          console.log(palet);
          const total_sale_en = this.total_precio;
          this.envi_sale = total_sale_en;
          //console.log(palet, total_sale_en);
          console.log(this.envi_sale)
          const sale_note = {
            paletItems: this.paletItems,
            totalSale: this.envi_sale,
          };
          console.log(sale_note)
          await this.enviar_purchase(sale_note)
          this.see_palet = false;
        },
        purchase_view(){
          this.active_purchase_view=true;
        },
        reverse_view(){
          this.active_purchase_view=false;
        },
        async fetchPage(pageNumber, search = null, filter_category = null){
            // if (pageNumber === '...') return;
            await   this.getproducts({pageNumber, search, filter_category});
            const targetPage = this.currentPage ;
            this.$router.push({ query: { page: targetPage } });
        },
        //Esta es la funcion del emit de fetchPage, donde se obtiene el valor de la search y se aplica en la funcion principal de fetchPage
        async Search (handleSearch){
          this.search =handleSearch;
          this.fetchPage(this.currentPage, handleSearch);
        },
        //Esta es la funcion del emit de selectCategory, donde se obtiene el valor de la categoria y se aplica en la funcion principal de fetchPage
        async Category(handleCategory){
          this.filter_category = handleCategory;
          this.fetchPage(this.currentPage, this.search, handleCategory);
        },
        async prevPage() {
            if (!this.isAtLowerLimit) { // Verifica que no estemos en la primera página
              const targetPage = this.currentPage - 1;
              await this.$store.commit('list_of_products/setCurrentPage', targetPage);
              await this.getproducts();
              this.$router.push({ query: { page: targetPage } });
            }
        },
        async nextPage() {
            if (!this.isAtUpperLimit) { // Verifica que no estemos en la última página
              const targetPage = this.currentPage + 1;
              await this.$store.commit('list_of_products/setCurrentPage', targetPage);
              await this.getproducts();
              this.$router.push({ query: { page: targetPage } });
            }
        },
        goToPage(page) {
            if (page === '...') return; // No hacer nada si se hace clic en "..."
            this.$store.commit('list_of_products/setCurrentPage', page);
            this.fetchReviewsData(page).then(() => {
              this.$router.push({ query: { page } });
            });
        },
    },
    mounted(){
        this.getproducts();
    }


};
</script>