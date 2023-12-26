import './bootstrap';
import '../css/app.css';

import { createApp } from 'vue'
import app from './components/app.vue'
import store from './store/store.js'
import router from './router/router.js'

const App = createApp(app); 
App.use(router);
App.use(store);







App.config.globalProperties.$axios = axios;
App.mount("#app");
