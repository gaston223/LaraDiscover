require('./bootstrap');
require('popper.js')
import router from "./routes";
import VueRouter from "vue-router";
import Index from "./Index";
//require('bootstrap/dist/css/bootstrap.min.css');
//require('mdbvue/lib/css/mdb.min.css');

window.Vue = require('vue');

/*Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('example-component2', require('./components/ExampleComponent2.vue').default);*/

Vue.use(VueRouter);

const app = new Vue({
    el: '#app',
    router,
    components : {
        "index": Index
    }
});
