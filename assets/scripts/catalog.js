
import Vue from 'vue';
import App from '../vue/CatalogApp.vue';

import { createPinia, PiniaVuePlugin } from 'pinia';

//import { createPinia } from 'pinia';
//import { createApp } from 'vue';

Vue.use(PiniaVuePlugin)
const pinia = createPinia();
//const app = createApp(App);
//app.use(pinia);


// new Vue({
//     render: h => h(App),
// }).$mount('.catalog-vue-app');



new Vue({
    render: h => h(App),
    pinia
}).$mount('.catalog-vue-app');


//createApp(App).use(pinia).mount('.catalog-vue-app');
