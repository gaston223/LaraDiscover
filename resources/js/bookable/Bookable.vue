<template>
    <div>
        <div class="row">
            <div class="col-md-8 pb-4">
               <div class="card-body">
                   <div v-if="!loading">
                       <h2>{{bookable.title}}</h2>
                       <hr>
                       <article>
                           {{bookable.description}}
                       </article>
                   </div>
                   <div v-else>Chargement ...</div>

               </div>
                <review-list></review-list>
            </div>
            <div class="col-md-4 pb-4">
                <disponibilite></disponibilite>
            </div>
        </div>

    </div>
</template>

<script>
    import Disponibilite from "./Availability";
    import ReviewList from "./ReviewList";
    export default {
        components: {
            Disponibilite,
            ReviewList
        },
        data(){
            return {
                bookable: null,
                loading : false
            }
        },
        created() {
            this.loading = true;
            axios
                .get(`/api/bookables/${this.$route.params.id}`)
                .then(response => {
                    this.bookable = response.data.data;
                    this.loading = false
                });
        }
    }
</script>
