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
                <div v-if="!loading">
                    <review-list :bookable-id="this.$route.params.id" :avg-rating="bookable.average_rating" :sum-review="bookable.sum_review"></review-list>
                </div>
            </div>
            <div class="col-md-4 pb-4">
                <availability :bookable-id="this.$route.params.id"></availability>
            </div>
        </div>

    </div>
</template>

<script>
    import Availability from "./Availability";
    import ReviewList from "./ReviewList";
    export default {
        components: {
            Availability,
            ReviewList
        },
        props: {
            avgRating: Number,
            sumReview : Number
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
