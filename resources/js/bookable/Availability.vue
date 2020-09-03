<template>
    <div>
        <h6 class="text-uppercase blue-grey-text font-weight-bolder">Verifier la disponibilité</h6>
        <span class="badge badge-pill badge-danger" v-if="noAvailability">Pas Disponible</span>
        <span class="badge badge-pill badge-success" v-if="hasAvailability">Disponible</span>

        <div class="row">

            <div class="col-md-6">
                <div class="md-form">
                    <!--<label for="from">Date de départ</label>-->
                    <input
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

        <button class="btn btn-block aqua-gradient" @click="check" :disabled="loading">Vérifier</button>
    </div>

</template>

<script>
    import {is422} from "../shared/utils/response";
    import validationErrors from "../shared/mixins/validationErrors";
    export default {
        mixins : [validationErrors],
        props: {
            bookableId: [String, Number]
        },
        data(){
            return {
                from: this.$store.state.lastSearch.from,
                to: this.$store.state.lastSearch.to,
                loading: false,
                status: null,
            };
        },
        methods : {
            check(){
               this.loading = true;
               this.errors = null;

               this.$store.dispatch('setLastSearch', {
                   from : this.from,
                   to : this.to
               })

               axios.get(`/api/bookables/${this.bookableId}/availability?from=${this.from}&to=${this.to}`)
                    .then(response => {
                        this.status = response.status;
                    }).catch(error => {
                        if(is422(error)){
                            this.errors = error.response.data.errors;
                        }
                        this.status = error.response.status;
                    }).then(()=> (this.loading = false));
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
            }
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
