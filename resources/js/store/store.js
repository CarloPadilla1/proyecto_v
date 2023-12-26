import { createStore } from "vuex";
import axios from 'axios';
const list_of_products = {
    namespaced: true,
    state: ()=>({
        products: [],
        currentPage: 1,   
        last_page: 1, 
        total_pages: 1,
        per_page:1,
    }),
    mutations:{
        setProducts(state, productsData) {
            state.products = productsData;
        },
        setCurrentPage(state, page_i) {
            state.currentPage = page_i;
        },
          setpage_l(state,page_l){
            state.last_page = page_l
        },
          total_pages(state,total_pages){
            state.total_pages = total_pages;
        },
          per_page(state,per_page){
            state.per_page = per_page;
        },
    },
    actions:{ 
        async getproducts({commit,state},data){
            let page = data?.pageNumber!== undefined ? data?.pageNumber: state.currentPage;
            let url = '/get_paginate?page='+page;
            if(data?.search){
                url+= `&search=${data.search}`
            }
            if(data?.filter_category){
                url+=`&categories=${data.filter_category}`;
            }
            // ejemplo de como debe ser axios.get('/get_paginate?page='+page+'&categories=Bebidas&search=Cerveza')
            // como funciona filtro de varias categorias = '/get_paginate?page='+page+'&categories=Mayores de edad, Bebidas'
            return new Promise(( resolve, reject )=>{
                axios.get(url)
                .then(response =>{
                    const productsData = response.data.data;
                    const page_i = response.data.current_page;
                    const page_l = response.data.last_page;
                    const total_pages = response.data.total;
                    const per_page = response.data.per_page;

                    // console.log(productsData)
                    // console.log(page_i)
                    // console.log(page_l)
                    // console.log(total_pages)
                    // console.log(per_page)

                    commit('setProducts', productsData);
                    commit ('setCurrentPage', page_i);
                    commit('setpage_l',page_l);
                    commit('total_pages',total_pages);
                    commit('per_page',per_page);
                })
        
            })
        }

  
    },
    getters:{
  
    },
    
}

const brands = {
    namespaced: true,
    state: ()=>({
        brands:[]
    }),
    mutations:{
        setBrands(state, brandsData) {
            state.brands = brandsData;
        },
        addBrand(state, brand) {
            state.brands.push(brand);
        },
        updateBrand(state, updatedBrand) {
            // console.log(updatedBrand.id_brand)
            const index = state.brands.findIndex(brand => brand.id_brand === updatedBrand.id_brand);
        },
        removeBrand(state, response) {
            const index = state.brands.findIndex(brand => brand.id_brand === response);
            if (index !== -1) {
              state.brands.splice(index, 1);
            }
        }
    },
    actions:{ 
        async getbrands({ commit }, search = null){
            try {
                let url = '/home/get_brands';
                if(search !== null && search !== ''){
                    url += `?search=${search}`;
                }
                const response = await axios.get(url)
                const brandsData = response.data.brands
                // console.log(brandsData)
                commit('setBrands', brandsData)
            } catch (error) {
                console.error(error);

            }
        },
        async createBrand({ commit, dispatch }, brandsData){
            try {
                const response = await axios.post('/home/create_brand', brandsData)
                const newBrand = response.data; // Suponiendo que el servidor devuelve la nueva marca
                commit('addBrand', newBrand);
                dispatch('getbrands');
            } catch (error) {
                console.log(error);
            }
        },
        async updateBrand({ commit }, { id, updatedData }) {
            // console.log(updatedData)
            try {
              const response = await axios.put(`/home/update_brand/${id}`, updatedData);
            //   console.log(response.data)
              const updatedBrand = response.data.brand;
              commit('updateBrand', updatedBrand);
              return true;
            } catch (error) {
              console.error(error);
            //   console.log(error.response.data.errors)
                if (error.response.status === 422) {
                    const validationErrors = error.response.data.errors;
                    return { validationErrors };
                } else {
                    console.error(error);
                    return false;
                }
            }
        },
        async deleteBrand({ commit },id){
            try {
                const response = await axios.delete(`/home/delete_brand/${id}`)
                //const response = await axios.delete('/home/delete_brand/' + id);
                commit('removeBrand',response)
                return true
            } catch (error) {
                // console.log(error.response.data)
                console.error(error);
                return false                
            }
        }


    },

    getters:{
  
    },
    
}
const categories = {
    namespaced: true,
    state: ()=>({
        categories:[],
    }),
    mutations:{
        setCategories(state, categoriesData){
            state.categories = categoriesData
        },
        addCategory(state, category){
            state.categories.push(category);
        },
        updateCategory(state, updateCategory){
            // console.log(updateCategory.id_category)
        },
        removeCategory(state,response){
            const index = state.categories.findIndex(categories => categories.id_category === response);
            if (index !== -1) {
              state.categories.splice(index, 1);
            }
        }
  
    },
    actions:{ 
        async getCategories({ commit }, search = null){
            try {
                let url = '/home/get_categories';
                if(search !== null && search!==''){
                    url += `?search=${search}`;
                }
                const response = await axios.get(url);
                const categoriesData = response.data.categories
                // console.log(categoriesData);
                commit('setCategories',categoriesData)
            } catch (error) {
                console.error(error);
            }
        },
        async createCategories({commit, dispatch}, categoryData){
            try {
                const response = await axios.post('/home/create_category',categoryData);
                const newCategory  = response.data
                commit ('addCategory', newCategory)
                dispatch('getCategories')
            } catch (error) {
                console.error(error)
            }
        },
        async updateCategories({ commit }, { id, updatedData }){
            // console.log(id)
            // console.log(updatedData)
            try {
                const response = await axios.put(`/home/update_category/${id}`, updatedData)
                // console.log(response.data)
                const updateCategory = response.data.category
                commit('updateCategory',updateCategory)
                return true
            } catch (error) {
                console.error(error);
                // console.log(error.response.data.errors)
                if (error.response.status === 422) {
                    const validationErrors = error.response.data.errors;
                    return { validationErrors };
                } else {
                    console.error(error);
                    return false;
                }
                
            }
        },
        async deleteCategories({ commit } , id){
            try {
                const response = await axios.delete(`/home/delete_category/${id}`)
                //const response = await axios.delete('/home/delete_category/' + id);
                commit('removeCategory',response)
                return true
            } catch (error) {
                // console.log(error.response.data)
                console.error(error);
                return false         
            }
        }
  
    },
    getters:{
        getCategories: state=> state.categories
    },
    
}
const providers = {
    namespaced: true,
    state: ()=>({
        providers:[],
    }),
    mutations:{
        setProviders(state, providersData){
            state.providers = providersData
        },
        
        addProviders(state, providers){ 
            state.providers.push(providers)
        },
        updateProviders(state, updateProviders){
            //console.log(updateProviders.id_providers)
            //const index = state.Providers.findIndex(Providers => Providers.id_provider === updateProviders.id_providers);
            //
        },
        removeProviders(state, response){
            const index = state.providers.findIndex(providers => providers.id_provider === response);
            if (index !== -1) {
              state.brands.splice(index, 1);
            }
        },
    },
    actions:{ 
        async getProviders({ commit }, search = null){
            // console.log('si entro al vuex')
            try {
                let url = '/home/get_providers';
                if(search !== null && search!== ''){
                    url += `?search=${search}`;
                }
                const response = await axios.get(url);
                const providersData = response.data.providers
                // console.log(providersData)
                commit('setProviders', providersData)
            } catch (error) {
                console.log(error);
            }
        },
        async createProviders({ commit,dispatch}, providersData){
            // console.log(providersData)
            try {
                const response = await axios.post('/home/create_provider', providersData)
                const newProviders = response.data; // Suponiendo que el servidor devuelve la nueva marca
                commit('addProviders', newProviders);
                dispatch('getProviders');
            } catch (error) {
                console.log(error);
            }
        },
        async updateProviders({ commit },{ id, updatedData }){
            // console.log(updatedData)
            try {
                const response = await axios.put(`/home/update_provider/${id}`, updatedData);
                // console.log(response.data)
                const updateProviders = response.data.providers;
                commit('updateProviders', updateProviders);
                return true;
            } catch (error) {
                console.error(error);
                // console.log(error.response.data.errors)
                if (error.response.status === 422) {
                      const validationErrors = error.response.data.errors;
                      return { validationErrors };
                } else {
                      console.error(error);
                      return false;
                }
            }

        },
        async deleteProviders({ commit }, id){
            try {
                const response = await axios.delete(`/home/delete_provider/${id}`)
                //const response = await axios.delete('/home/delete_brand/' + id);
                commit('removeProviders',response)
                return true 
            } catch (error) {
                // console.log(error.response.data)
                console.error(error);
                return false  
            }
        },
    },
    getters:{
  
    },
    
}

const products = {
    namespaced: true,
    state: {
      productos: [],
      medidas: [],
    },
    mutations: {
        setProducts(state, productsData) {
            state.productos = productsData;
            // console.log(state.productos);
        },
        setMeasurements(state, measurementsData){
            state.medidas = measurementsData;
        },
        addProduct(state, product) {
            state.productos.push(product);
        },
        updateProducts(state, updateProduct){
            // console.log(updateProduct.id_products)
            const index = state.productos.findIndex(productos => productos.id_products === updateProduct.id_products);
        },
        removeProduct(state, response) {
            const index = state.productos.findIndex(product => product.id_brand === response);
            if (index !== -1) {
              state.productos.splice(index, 1);
            }
        }
    },
    actions: {
      async fetchProducts({ commit }, search = null) {
        try {
            let url = 'home/get_products';
            if(search !== null && search !==''){
                url += `?search=${search}`
            }
          const response = await axios.get(url); // Asegúrate de que la URL coincida con la ruta en tu controlador
        //   console.log(response)
          const measurementsData=response.data.measurements;
        //   const productsData=response.data.products;
          commit('setProducts', response.data.products);
          commit('setMeasurements', measurementsData);
        } catch (error) {
          console.error(error);
        }
      },
      async createProduct({ commit, dispatch }, productData) {
        try {
        //   console.log(productData);
            const response = await axios.post('home/create_product', productData);
            // console.log(response);
            return true;
            const newProduct = response.data.product; // Suponiendo que el servidor devuelve el nuevo producto
            commit('addProduct' , productData);
            dispatch('fetchProducts'); // Asegúrate de que esta acción refleje cómo obtienes la lista de productos.
        } catch (error) {
            console.error(error);
            // console.log(error.response.data.errors) 
            if (error.response.status === 422) {
                  const validationErrors = error.response.data.errors;
                  return { validationErrors };
            } else {
                  console.error(error);
                  return false;
            }
        }
      },
      async updateProducts({ commit },{ id, updatedData }){
        try {
            const response = await axios.put(`/home/update_product/${id}`, updatedData);
            // console.log(response.data)
            const updateProduct = response.data.products;
            commit('updateProduct', updateProduct);
            return true;
        } catch (error) {
            console.error(error);
            // console.log(error.response.data.errors) 
            if (error.response.status === 422) {
                  const validationErrors = error.response.data.errors;
                  return { validationErrors };
            } else {
                  console.error(error);
                  return false;
            }
        }

      },

      async updateStock({ commit },data){
        try {
                const response = await axios.put('/home/update_stock', data, {withCredentials:true});
                // console.log(response);
            // console.log(response.data)
        } catch (error) {
            console.log(error);
        }
    
      },

      async deleteProduct({ commit },id){
        try {
            const removeProduct = await axios.delete(`/home/delete_product/${id}`)
            //const response = await axios.delete('/home/delete_brand/' + id);
            // console.log(removeProduct)
            commit('removeProduct', removeProduct)

            return true
        } catch (error) {
            console.log(error.removeProduct)
            console.error(error);
            return false                
        }
      },
      async enviar_purchase({commit},data ){
        try {
            const response = await axios.post('/home/confirm_purchase',data,{
                withCredentials:true
            });
            // console.log(response);
        } catch (error) {
            console.log(error);
        }
      },
    },
    
    getters: {  
      getProducts: (state) => state.productos,
      getBrands: (state) => state.brands,
      getCategories: (state) => state.categories,
    },
};

const ventas = {
    namespaced: true,
    state: ()=>({
        sells:[],
    }),
    mutations:{
        setSells(state, sellsData){
            state.sells = sellsData;
        },
    },
    actions:{ 
        async getSells({ commit }, search = null){
            let url = '/home/get_sells';
            if(search !== null && search !== ''){
                url += `?search=${search}`
            }
            const response = await axios.get(url);
            // console.log(response.data.sells);
            const sellsData = response.data.sells
            // console.log(sellsData)
            commit('setSells', sellsData)
        }
    },
    getters:{
  
    },
    
};
const user = {
    namespaced: true,
    state: ()=>({
  
    }),
    mutations:{
  
    },
    actions:{ 
        async logout_session(){
            try {
                const response = await axios.get('/logout')
                window.location.reload(true);

            } catch (error) {
                console.log(error)
            }
        },
    },
    getters:{
  
    },
    
}

export default createStore({
    modules:{
        list_of_products:list_of_products,
        brands: brands,
        products: products,
        categories: categories,
        providers:providers,
        ventas: ventas,
        users:user,
    },
  
})



const estructura = {
    namespaced: true,
    state: ()=>({
  
    }),
    mutations:{
  
    },
    actions:{ 
  
    },
    getters:{
  
    },
    
}