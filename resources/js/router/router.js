import { createRouter, createWebHistory } from "vue-router";
import sesion_init from '../../views/index.vue'
import vista_main from '../../views/vista_main.vue'
import ver_marcas from '../../views/brands.vue'
import store from '../store/store.js'
import ver_productos from '../../views/products.vue'
import ver_categorias from '../../views/categories.vue'
import ver_providers from '../../views/provider.vue'
import ver_ventas from '../../views/ventas.vue'

const router = createRouter({
    history: createWebHistory (),
    routes:[
        {path: '/home',
        name:'sesion_init',
        component:sesion_init, 
        },
        {
            path: '/vista',
            name:'vista_main'  ,
            component: vista_main,

        },
        {
            path:'/ver_marcas',
            name:'ver_marcas',
            component: ver_marcas
        },
        {
            path:'/ver_categorias',
            name:'ver_categorias',
            component: ver_categorias,
        },
        {
            path:'/ver_providers',
            name:'ver_providers',
            component: ver_providers, 
        },
        {
            path:'/ver_productos',
            name:'ver_productos',
            component: ver_productos,
        },
        {
            path:'/ver_ventas',
            name:'ver_ventas',
            component: ver_ventas,
        }


        
    ]

});




router.beforeEach((to, from, next) => {
    if (to.matched.some((record) => record.meta.requiresAuth)) {
        console.log(store.state.login.isAuthenticated)
        if (store.state.login.isAuthenticated) {
            console.log('llegue a true')
            next();
        } else {
            console.log('llego al false')
            next({ name: 'sesion_init' }); // Redirige a la página de inicio de sesión
        }
    } else {
        next();
    }
});


export default router
