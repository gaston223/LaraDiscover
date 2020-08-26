require('./bootstrap');
require('popper.js')
import router from "./routes";
import VueRouter from "vue-router";
import Index from "./Index";
import moment from "moment";
import StarRating from "./shared/components/StarRating";
import FatalError from "./shared/components/FatalError"
//require('bootstrap/dist/css/bootstrap.min.css');
//require('mdbvue/lib/css/mdb.min.css');

window.Vue = require('vue');

/*Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('example-component2', require('./components/ExampleComponent2.vue').default);*/

Vue.use(VueRouter);

//Moment.js
Vue.filter("fromNow", value => moment(value).fromNow());
moment.locale('fr');

//vue-numeral-filter
import vueNumeralFilterInstaller from 'vue-numeral-filter';

Vue.use(vueNumeralFilterInstaller, { locale: 'fr'});

Vue.component("star-rating", StarRating);
Vue.component("fatal-error", FatalError);

const app = new Vue({
    el: '#app',
    router,
    components : {
        "index": Index,

    }
});
