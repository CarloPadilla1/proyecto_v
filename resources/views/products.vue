<template>
  <div style="margin-left: 6vh;" class="d-flex">
              <h1 class="ms-4 btn_title">Productos</h1>
  </div>
  <div class="container-fluid mt-3">
    <div class="container ">
      <div style="display: flex; justify-content: center; align-items: center;" class="row">

        <!-- Button trigger modal -->
        <button style="background-color: #b06c14; border: 0px solid; box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.3); width: 30vh;" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal_create">
          Agregar producto
        </button>
        <!-- Modal de creacion de productos -->
        <div class="modal fade" id="exampleModal_create" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <div class="container-fluid mt-3">
                  <div class="container ">
                    <div style="display: flex; justify-content: center; align-items: center;" class="row">
                      <!-- nuevo Formulario xd -->
                      <div style="background-color: white; width: 200vh; box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.3); border-bottom-left-radius: 20px; border-bottom-right-radius: 20px;" class="col-12 base_bag_providers" >
                        <div class="">
                          <form style="text-align: center;" @submit.prevent="crearProducto()" class="product-form">
                            <h2 style="color: rgb(102, 83, 24);">Agregar Nuevo Producto</h2>
                              <!-- nombre -->
                            <div class="mb-3">
                                <input placeholder="Nombre del Producto" class="form-control" v-model="productData.name_product" type="text" id="name_product" name="name_producto" required>
                            </div>
                            <!--descripción  -->
                            <div class="mb-3">
                                <textarea  placeholder="Descripción" v-model="productData.description" class="form-control text_area_control" required></textarea>
                            </div>
                            <!-- marca -->
                            <div class="mb-3">
                              <!-- <label for="id_brand"></label>  -->
                              <select name="id_brand" class="form-select" id="id_brand" v-model="productData.id_brand">
                                  <option value="" disabled selected><p style="opacity: 0.5;">Marca</p></option> 
                                  <option v-for="marcas in brands" :key="marcas.id_brand" :value="marcas.id_brand">
                                  {{ marcas.name_brand }}
                                  </option>
                              </select>
                            </div>
                            <!-- proveedor -->
                            <div class="mb-3">
                            <!-- <label for="id_provider">Proveedor:</label> -->
                            <select class="form-select" id="id_provider" v-model="productData.id_provider">
                              <option value="" disabled selected><p style="opacity: 0.5;">Proveedor</p></option> 
                                <option v-for="provedores in providers" :key="provedores.id_provider" :value="provedores.id_provider">
                                {{ provedores.name_provider }}
                                </option>
                            </select>
                            </div>
                            <div style="text-align: center;" class="mb-3">
                            <!-- categoria -->
                            <label for="id_category"><p style="color: rgb(102, 83, 24);">Categoría:</p></label>
                            <select class="form-select" id="id_category" v-model="productData.id_category" multiple>
                                <option v-for="categorias in categories" :key="categorias.id_category" :value="categorias.id_category">
                                {{ categorias.name_category }}
                                </option>
                            </select>
                            </div>
                            <!-- Agregar precio de compra al producto -->
                            <div class="mb-3">
                              <input placeholder="Precio de compra" class="form-control" v-model="productData.purchase_price" type="number" id="purchase_price" name="purchase_price" required min="0" step="0.1">
                            </div>
                            <!-- Agregar precio de venta al producto -->
                            <div class="mb-3">
                              <input placeholder="Precio de venta" class="form-control" v-model="productData.sale_price" type="number" id="sale_price" name="sale_price" required min="0" step="0.1">
                            </div>
                            <!-- Agregar stock -->
                            <div class="mb-3">
                              <input placeholder="Stock" class="form-control" v-model="productData.stock" type="number" id="stock" name="stock" required min="0">
                            </div>
                            <!-- Seleccionar medida-->
                            <div class="mb-3">
                              <!-- <label for="id_measurement">Medida:</label>  -->
                              <select class="form-select" id="id_measurement" v-model="productData.id_measurements">
                                <option value="" disabled selected><p style="opacity: 0.5;">Medida</p></option> 
                                <option v-for="measurement in medidas" :key="measurement.id_measurements" :value="measurement.id_measurements">
                                {{ measurement.measurement }}
                                </option>
                              </select>
                            </div>
                            <button style="margin-bottom: 3vh;" type="submit"  class="btn btn-primary">Crear Producto</button>
                          </form>
                        </div>
                          <div v-if="success_created" class="bg-success rounded pt-2 pb-2">
                            <h3 class="text-center " >Producto creado</h3>
                          </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                
              </div>

            </div>
          </div>
        </div>
        <!-- modal de errores al crear productos -->
        <div class="modal fade" id="exampleModal_error" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalToggleLabel2">Error al crear el producto</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <div v-if="validationErrors">
                    <ul class="list_deco_error">
                      <li v-for="(errors, field) in validationErrors" class="bg-danger rounded p-2">
                        <strong>{{ field }}:</strong>
                        <ul>
                            <li v-for="error in errors"><p>{{ error }}</p></li>
                        </ul>
                      </li>
                    </ul>
                </div>
              </div>
              <div class="modal-footer">
                <button class="btn btn-success" data-bs-target="#exampleModalToggle" data-bs-toggle="modal">Cerrar</button>
              </div>
            </div>
          </div>
        </div>
        
        <!-- Aquí se muestran los Productos, también están los botones de Update y Delete del producto  -->
        <div class="row  p-0">
            <div class="col-4 ">
              <h3>
                <p class="btn_search">Buscar un producto</p>
              </h3>
              <SearchComponent @search="getproductsVuex"/>
            </div>
        </div>
        <div class="base_pag_pro col-12">
          <br><br>
          <table style="box-shadow:5px 5px 10px rgba(0, 0, 0, 0.3) ;">
            <thead>
              <tr>
                <th>Producto</th>
                <th>Precio de Compra</th>
                <th>Precio de Venta</th>
                <th>Stock</th>
                <th>Categoría</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(product, index) in productos" :key="product.id_product"  v-if="products_quest" >
                <td>
                  <h2>{{ product.name_product }}</h2>
                </td>
                <td>
                  Precio de Compra: {{ product.inventory.purchase_price }}
                </td>
                <td>
                  Precio de Venta: {{ product.inventory.sale_price }}
                </td>
                <td>

                  <div v-if="!edit_stockupdated.includes(product.id_product)">
                      Stock: {{ product.inventory.stock }} 
                      <button class="btn" @click="stock_update(product.inventory.stock,product.id_product)"> 
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-seam" viewBox="0 0 16 16">
                            <path d="M8.186 1.113a.5.5 0 0 0-.372 0L1.846 3.5l2.404.961L10.404 2zm3.564 1.426L5.596 5 8 5.961 14.154 3.5zm3.25 1.7-6.5 2.6v7.922l6.5-2.6V4.24zM7.5 14.762V6.838L1 4.239v7.923l6.5 2.6zM7.443.184a1.5 1.5 0 0 1 1.114 0l7.129 2.852A.5.5 0 0 1 16 3.5v8.662a1 1 0 0 1-.629.928l-7.185 2.874a.5.5 0 0 1-.372 0L.63 13.09a1 1 0 0 1-.63-.928V3.5a.5.5 0 0 1 .314-.464L7.443.184z"/>
                        </svg>
                      </button>
                  </div>
                  <div v-else-if="edit_stockupdated.includes(product.id_product)">
                      <input v-model="stockEditValues[product.id_product]"   style="width: 50px;" type="number"  :min="product.inventory.stock" />
                      <button class="btn" @click="update_stock(product.id_product,stockEditValues[product.id_product])">Guardar</button>
                      <button class="btn" @click="close_upstock(product.id_product)">Cancelar</button>
                  </div>
                    medicion:
                    {{ product.inventory.measurement?.measurement }}

                </td>
                <td>
                  <div v-for="categoria in product.categories">
                    <h4>{{ categoria.name_category }}</h4>
                  </div>
                </td>
                <td>
                  <button @click="mostrarFormularioActualizacion(product)" type="button" data-bs-toggle="modal" :data-bs-target="'#exampleModal-' + index">
                    Actualizar producto
                  </button>
                  <button class="ms-2 btn btn-danger" @click="eliminarProducto(product.id_product)">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-trash2-fill" viewBox="0 0 16 16">
                      <path d="M2.037 3.225A.703.703 0 0 1 2 3c0-1.105 2.686-2 6-2s6 .895 6 2a.702.702 0 0 1-.037.225l-1.684 10.104A2 2 0 0 1 10.305 15H5.694a2 2 0 0 1-1.973-1.671L2.037 3.225zm9.89-.69C10.966 2.214 9.578 2 8 2c-1.58 0-2.968.215-3.926.534-.477.16-.795.327-.975.466.18.14.498.307.975.466C5.032 3.786 6.42 4 8 4s2.967-.215 3.926-.534c.477-.16.795-.327.975-.466-.18-.14-.498-.307-.975-.466z"/>
                    </svg>
                  </button>
                </td>
                <!-- modal -->
                <div class="modal fade" :id="'exampleModal-' + index" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                      <div class="modal-content">
                      <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Actualizar producto: <b>{{ updatedProductData.name_product }}</b> </h1>
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
                            <div v-if="success_product">
                              <h3 class="text-center bg-success rounded" >Producto actualizado</h3>
                            </div>
                          </div>
                          <form @submit.prevent="actualizarProducto" class="update-form">
                            <!-- Contenido del formulario de actualización -->
                            <label for="update_name_product">Nuevo nombre</label>
                            <input v-model="updatedProductData.name_product" type="text" id="update_name_product" name="update_name_product" required style="width: 100%;">

                            <label for="update_description">Nueva descripción</label>
                            <textarea v-model="updatedProductData.description" id="update_description" name="update_description" required style="width: 100%;"></textarea>

                            <label for="update_purchase_price">Nuevo Precio de compra</label>
                            <input type="text" v-model="updatedProductData.purchase_price" id="update_purchase_price" name="update_purchase_price" required min="0" pattern="\d+(\.\d{1,2})?" title="Ingrese un número válido" style="width: 100%;">

                            <label for="update_sale_price">Nueva Precio de venta</label>
                            <input type="text" v-model="updatedProductData.sale_price" id="update_sale_price" name="update_sale_price" required min="0" pattern="\d+(\.\d{1,2})?" title="Ingrese un número válido" style="width: 100%;">

                            <label for="update_stock">Stock:</label>
                            <input type="number" v-model="updatedProductData.stock" id="update_stock" class="input-field" required min="0" style="width: 100%;">
                            <label for="update_id_measurement">Medida:</label>
                            <select class="form-select" id="update_id_measurement" v-model="updatedProductData.id_measurements" required>
                              <option v-for="measurement in medidas" :key="measurement.id_measurements" :value="measurement.id_measurements">
                                {{ measurement.measurement }}
                              </option>
                            </select>
                            <div class="form-group">
                              <label for="update_id_category">Nueva Categoría:</label>
                              <select class="form-select" id="update_id_category" v-model="updatedProductData.id_category" multiple>
                                <option v-for="categorias in categories" :key="categorias.id_category" :value="categorias.id_category">
                                  {{ categorias.name_category }}
                                </option>
                              </select>
                            </div>
                            <div>
                              <label for="update_id_provider">nuevo Proveedor:</label>
                              <select class="form-select" id="update_id_provider" v-model="updatedProductData.id_provider" required> 
                                <option v-for="provedores in providers" :key="provedores.id_provider" :value="provedores.id_provider">
                                  {{ provedores.name_provider }}
                                </option>
                              </select>
                            </div>
                            <div class="form-group">
                              <!-- select de marca, ya vale no le mueva que se suicida padilla -->
                              <label for="update_id_brand">Marca:</label>
                              <select class="form-select" id="update_id_brand" v-model="updatedProductData.id_brand" required>
                                <option v-for="marcas in brands" :key="marcas.id_brand" :value="marcas.id_brand">
                                  {{ marcas.name_brand }}
                                </option>
                              </select>
                            </div>
                              <button class="btn btn-primary" type="submit">Guardar Cambios</button>
                              <button type="button" class="btn btn-secondary ms-3" data-bs-dismiss="modal">Cerrar</button>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                </tr>
              </tbody>
          </table>
        </div>
      </div> 
    </div>
  </div>
  <div>
      <div class="container" v-if="products_quest == false">
        <div class="p-4 rounded no_cerf">
          <h2 class="text-center">No hay productos en el inventario</h2>
        </div>
      </div>
  </div>


</template>
    
<script>
  import header_vue from '../js/components/header.vue';
  import SearchComponent from '../js/components/SearchComponent.vue';
  import { provide } from 'vue';
  import { mapGetters, mapActions, mapState } from 'vuex';
  
  export default {
    components:{
      header_vue,
      SearchComponent
    },

    data(){
      return{
        productData: {
          name_product: '',
          description: '',
          id_brand: '',
          id_provider: '',
          id_measurements: '',
          id_category: [],
          purchase_price: '',
          sale_price: '',
          stock: '',
        },
        success_product: false,
        success_created: false,
        mostrarFormulario: false,
          updatedProductData: {
            name_product: '',
            description: '',
            id_brand: '',
            id_provider: '',
            purchase_price: '',
            sale_price: '',
            stock: '',
            id_measurements: '', 
            id_category: [],
          },  
        validationErrors: null, // Agrega esta propiedad para almacenar los errores
        edit_show: false,
        edit_stockupdated: [],
        stockEditValues: {},

      }
    },
    computed: {
      ...mapState('products', ['productos', 'medidas']),
      ...mapState('brands', ['brands']),
      ...mapState('providers', ['providers']),
      ...mapState('categories',['categories']),
      products_quest(){
        // console.log(this.productos);
        if(this.productos.length > 0){
          // console.log('entro aqui a true')
          return true
        }else{
          // console.log('entro aqui a false')
          return false
        }
      },
    },
    methods: {
      ...mapActions('products', ['fetchProducts','createProduct', 'updateProducts','deleteProduct','updateStock' ]), // Mapea la acción para obtener productos
      ...mapActions('brands', ['getbrands']),
      ...mapActions('providers', ['getProviders']),
      ...mapActions('categories',['getCategories']),

      stock_edit(){
        if(this.edit_show == false){
          this.edit_show = true;
        }else{
          this.edit_show = false;
        }
      },
      getMinValue(productId) {
          return this.stockEditValues[productId];
      },
      stock_update(product_up,product_id){
        // console.log(product_up);
        // console.log(product_id);
        this.edit_show = true;
        if (this.edit_stockupdated.includes(product_id)) {
          this.edit_stockupdated = this.editedProducts.filter(item => item !== product_id);
        } else {

          this.stockEditValues[product_id] = product_up;
          this.edit_stockupdated.push(product_id);
        }

      },
      close_upstock(product_id){
        // console.log(product_id) 
        this.edit_stockupdated = this.edit_stockupdated.filter(item => item !== product_id);

      },
      async update_stock(product_id,stock_change){
        const productId = product_id;
        const nuevoStock = stock_change;
        const stock_existoso = await this.updateStock({
          productId: productId,
          newStock: nuevoStock ,
        });
        
      },
      async getproductsVuex(search = null) {
          await this.fetchProducts(search);
      },

      async crearProducto(){
        const productoCreado = await this.createProduct(this.productData);
        if(productoCreado === true){
          await this.$store.dispatch('products/fetchProducts');
          // console.log('Producto creado exitosamente');
          this.success_created = true
          setTimeout(() => {
            this.success_created = false
          }, 3000);
        }else if (productoCreado.validationErrors) {
                bootstrap.Modal.getInstance(document.getElementById('exampleModal_create')).hide();
                const tercerModal = new bootstrap.Modal(document.getElementById('exampleModal_error'));
                tercerModal.show()
                this.validationErrors = productoCreado.validationErrors;
                console.log('Fallo al crear el producto',this.validationErrors);
                this.cancelarActualizacion();
        }
      },

      async actualizarProducto(){
        // console.log('Haciendo clic en Crear Producto');
        const actualizacionExitosa = await this.updateProducts({
          id: this.updatedProductData.id_product,
          updatedData: this.updatedProductData,
          
        });
        if (actualizacionExitosa === true ) {
          // console.log('Marca actualizada con éxito');    
          this.success_product = true;      
          setTimeout(() => {
                this.success_product = false; 
          }, 3000);  
        } else if (actualizacionExitosa.validationErrors) {
          this.validationErrors = actualizacionExitosa.validationErrors;
          // console.log('Fallo al actualizar la marca',this.validationErrors);
          this.cancelarActualizacion();
        }
        
        await this.$store.dispatch('products/fetchProducts');
      },
 
      mostrarFormularioActualizacion(product) {
        this.mostrarFormulario = true;
        this.updatedProductData = {
          id_product: product.id_product,
          name_product: product.name_product,
          description:  product.description,
          id_brand: product.brand.id_brand,
          id_provider: product.provider.id_provider,
          id_measurements: product.inventory.measurement.id_measurements,
          id_category: product.categories.map(categoria => categoria.id_category),
          purchase_price: product.inventory.purchase_price,
          sale_price: product.inventory.sale_price,
          stock: product.inventory.stock,
        };
      },

      cancelarActualizacion() {
        this.mostrarFormulario = false;
      },
      
      async eliminarProducto(id) {
        if (confirm('¿Estás seguro de que deseas eliminar este Producto?')) {
          this.deleteProduct(id).then(success => {
            if (success) {
              console.log('Producto eliminado con éxito');
            } else {
              console.log('Fallo al eliminar el producto');
            }
          });
        }
        await this.$store.dispatch('products/fetchProducts');
      },
  
    },

    created() {
      this.getbrands();
      this.getProviders();
      this.getCategories();
      this.fetchProducts();
      this.$store.dispatch('products/fetchProducts');
    },
  
  };
</script>
<style scoped>
.no_cerf{
    background-color: #333; /* Cambia el color de fondo según tus preferencias */
    color: rgba(237, 237, 237, 0.992);
}
  table {
    border-collapse: collapse;
    width: 100%;
  }

  th, td {
    padding: 12px;
    text-align: left;
    border-bottom: 1px solid #ddd;
  }

  thead {
    background-color: #f2f2f2;
  }

  th {
    background-color: rgb(173, 108, 23);
    color: white;
  }

  tr {
    background-color: #B6C4B6;
  }

  td button {
    padding: 5px 10px;
    background-color: rgb(173, 108, 23);;
    border: none;
    color: white;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s;
  }

  td button:hover {
    background-color: rgb(173, 108, 23);;
  }

  
</style>
  