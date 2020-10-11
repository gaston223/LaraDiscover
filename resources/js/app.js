require('./bootstrap');
require('popper.js');

import router from "./routes";
import VueRouter from "vue-router";
import Vuex from 'vuex';
import moment from "moment";
import Index from "./Index";
import StarRating from "./shared/components/StarRating";
import FatalError from "./shared/components/FatalError"
import AlreadyRated from "./shared/components/AlreadyRated"
import Success from "./shared/components/Success"
import ValidationErrors from "./shared/components/ValidationErrors"
import storeDefinition from "./store";



//require('bootstrap/dist/css/bootstrap.min.css');
//require('mdbvue/lib/css/mdb.min.css');

window.Vue = require('vue');
Vue.use(VueRouter);
Vue.use(Vuex)


//Moment.js
Vue.filter("fromNow", value => moment(value).fromNow());
Vue.filter("date", value => moment(value).format('DD-MM-YYYY'));
moment.locale('fr');

//vue-numeral-filter
import vueNumeralFilterInstaller from 'vue-numeral-filter';

Vue.use(vueNumeralFilterInstaller, { locale: 'fr'});


Vue.component("star-rating", StarRating);
Vue.component("fatal-error", FatalError);
Vue.component("already-rated", AlreadyRated);
Vue.component("success", Success);
Vue.component("v-errors", ValidationErrors);

const store = new Vuex.Store(storeDefinition);

window.axios.interceptors.response.use(
    response => {
        return response;
    },
    error => {
        if (401 === error.response.status){
            store.dispatch("logout");
        }

        return Promise.reject(error);
    }
);

const app = new Vue({
    el: '#app',
    router,
    store,
    components : {
        "index": Index
    },
    async beforeCreate() {
        this.$store.dispatch("loadStoredState");
        this.$store.dispatch("loadUser");
    }
});
