<template>
    <div>
        <h6 class="text-uppercase blue-grey-text font-weight-bolder">Verifier la disponibilité</h6>
        <transition name="fade">
            <span class="badge badge-pill badge-danger" v-if="noAvailability">Indisponible</span>
            <span class="badge badge-pill badge-success" v-if="hasAvailability">Disponible</span>
        </transition>

        <div class="row" >
            <div class="col-md-6">
                <div class="md-form">
                    <datepicker v-model="from" name="from" :value="from" :input-class="[{'is-invalid' : errorFor('from')}]" :language='fr'></datepicker>
                    <v-errors :errors="errorFor('from')"></v-errors>
                </div>
            </div>
            <div class="col-md-6">
                <div class="md-form">
                    <datepicker v-model="to" name="to" :value="to" :input-class="[{'is-invalid' : errorFor('to')}]" :language='fr'></datepicker>
                    <v-errors :errors="errorFor('to')"></v-errors>
                </div>
            </div>
        </div>

        <div class="row" >
            <div class="col-md-6">
                <div class="md-form">
                    <input
                        v-show="fake"
                        v-model="from"
                        @keyup.enter="check"
                        type="text"
                        id="from"
                        class="form-control"
                        name="from"
                        placeholder="Date de Départ"
                        :class="[{'is-invalid' : errorFor('from')}]"
                    >
                    <v-errors :errors="errorFor('from')"></v-errors>

                </div>
            </div>
            <div class="col-md-6">
                <div class="md-form mb-0">
                    <input
                        v-show="fake"
                        v-model="to"
                        @keyup.enter="check"
                        type="text"
                        id="to"
                        class="form-control"
                        name="to"
                        placeholder="Date d'arrivée"
                        :class="[{'is-invalid' : errorFor('to')}]"
                    >
                   <v-errors :errors="errorFor('to')"></v-errors>
                   <!-- <label for="to">Date d'arrivée</label>-->
                </div>
            </div>
        </div>


        <button class="btn btn-outline-secondary btn-block waves-effect" @click.prevent="check" :disabled="loading">
            <span v-if="!loading">Vérifier</span>
            <span v-if="loading">  <i class="fas fa-circle-notch fa-spin"></i> Verification...</span>
        </button>
    </div>

</template>

<script>
    import {is422} from "../shared/utils/response";
    import validationErrors from "../shared/mixins/validationErrors";
    import moment from 'moment';
    import Datepicker from 'vuejs-datepicker';
    import {fr} from 'vuejs-datepicker/dist/locale'


    export default {
        components:{
            Datepicker
        },
        mixins : [validationErrors],
        props: {
            bookableId: [String, Number],
        },
        data(){
            return {
                fake : false,
                from: this.$store.state.lastSearch.from,
                to: this.$store.state.lastSearch.to,
                loading: false,
                status: null,
                fr: fr
            };
        },
        methods : {
           async check(){
               this.from = moment(this.from).format('YYYY-MM-DD')
               this.to = moment(this.to).format('YYYY-MM-DD')
               this.loading = true;
               this.errors = null;

               this.$store.dispatch('setLastSearch', {
                   from : this.from,
                   to : this.to
               });

               try {
                   this.status = (await axios.get(
                       `/api/bookables/${this.bookableId}/availability?from=${this.from}&to=${this.to}`))
                       .status;
                   this.$emit("availability", this.hasAvailability)
               }catch (error) {
                   if(is422(error)){
                       this.errors = error.response.data.errors;
                   }
                   this.status = error.response.status;
               }
               this.loading = false;

            }
        },
        computed: {
             hasErrors(){
                 return 422 === this.status && this.errors != null;
             },
            hasAvailability(){
                 return 200 === this.status;
            },
            noAvailability(){
                 return 404 === this.status;
            },

        }
    }
</script>

<style scoped>
    label {
       font-size: 0.7rem;
        text-transform: uppercase;
        /*color: gray;*/
        font-weight: bold;
    }
</style>
