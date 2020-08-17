<template>
    <div>
        <h6 class="text-uppercase blue-grey-text font-weight-bolder">Verifier la disponibilité</h6>
        <span class="badge badge-pill badge-danger" v-if="noAvailability">Pas Disponible</span>
        <span class="badge badge-pill badge-success" v-if="hasAvailability">Disponible</span>

        <div class="row">

            <div class="col-md-6">
                <div class="md-form mb-0">
                    <input
                        v-model="from"
                        @keyup.enter="check"
                        type="text"
                        id="from"
                        class="form-control"
                        name="from"
                        :class="[{'is-invalid' : this.errorFor('from')}]"
                    >
                    <div class="invalid-feedback"
                         v-for="(error, index) in this.errorFor('from')"
                         :key="'from' + index"> {{error}}
                    </div>
                    <label for="from">Date de départ</label>
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
                        :class="[{'is-invalid' : this.errorFor('to')}]"
                    >
                    <div class="invalid-feedback"
                         v-for="(error, index) in this.errorFor('to')"
                         :key="'to' + index">
                        {{error}}
                    </div>
                    <label for="to">Date d'arrivée</label>
                </div>
            </div>
        </div>

        <button class="btn btn-block aqua-gradient" @click="check" :disabled="loading">Vérifier</button>
    </div>

</template>

<script>
    export default {
        props: {
            bookableId: String
        },
        data(){
            return {
                from: null,
                to: null,
                loading: false,
                status: null,
                errors: null
            }
        },
        methods : {
            check(){
               this.loading = true;
               this.errors = null;
               axios.get(`/api/bookables/${this.bookable.id}/availability?from=${this.from}&to=${this.to}`)
                    .then(response => {
                        this.status = response.status;
                    }).catch(error => {
                        if(422 === error.response.status){
                            this.errors = error.response.data.errors;
                        }
                        this.status = error.response.status;
                    }).then(()=> (this.loading = false));
            },
            errorFor(field){
                return this.hasErrors && this.errors[field] ? this.errors[field] : null
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
