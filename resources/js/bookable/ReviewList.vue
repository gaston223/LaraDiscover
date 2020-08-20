<template>
    <div style="padding: 1.25rem">
        <h4 class="mb-3">Commentaires de nos Explorateurs :</h4>

        <!-- Note globale -->
        <div class="alert alert-info">
            <h4 class="alert-heading text-center">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        Note globale donnée par nos explorateurs :

                        <div class="col">
                            {{avgRating  | numeral('0.00')}} /5
                            <small>( {{sumReview}} Evaluations clients )</small>
                        </div>

                            <!--{{avgRating}}-->
                        <div class="col d-flex justify-content-center">

                            <star-rating :rating="avgRating" class="rating pt-2 text-center"></star-rating>

                        </div>
                    </div>

                </div>
            </h4>
        </div>

        <div v-if="loading">
            Chargement...
        </div>
        <div v-else>
            <!--Commentaires-->
            <div class="bg-light rounded mb-3 py-3 px-3 d-none d-md-block " v-for="(review, index) in reviews" :key="index">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <strong>Eric Choupo</strong> a dit :
                    </div>

                    <div class="col-md-6 d-flex justify-content-end">

                        <star-rating :rating="review.rating" class="fa-lg rating"></star-rating>
                    </div>
                </div>

                <blockquote>
                    {{review.content}}
                </blockquote>

                <blockquote>
                    {{ review.created_at | fromNow}}
                </blockquote>

            </div>
        </div>


    </div>
</template>

<script>

    /*import moment from "moment";
    moment.locale('fr');*/
    export default {
        props: {
            bookableId: [String, Number],
            avgRating:Number,
            sumReview : Number
        },
        data(){
            return {
                loading :false,
                reviews: null
            };
        },

        created() {
            this.loading = true
            axios.get(`/api/bookables/${this.bookableId}/reviews`)
                .then(response => this.reviews = response.data.data)
                .then(()=>(this.loading = false));

        },
       /* filters: {
            fromNow(value){
                return moment(value).fromNow();
            }
        }*/
    }
</script>

