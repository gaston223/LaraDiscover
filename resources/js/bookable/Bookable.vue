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
                <availability :bookable-id="this.$route.params.id" @availability="checkPrice($event)" class="mb-4"></availability>

                <transition name="fade">
                    <price-breakdown v-if="price" :price="price"></price-breakdown>
                </transition>
                <transition name="fade">
                    <button type="button" class="btn btn-block purple-gradient" v-if="price">Réserver</button>
                </transition>

            </div>
        </div>

    </div>
</template>

<script>
    import Availability from "./Availability";
    import ReviewList from "./ReviewList";
    import PriceBreakdown from "./PriceBreakdown";
    import { mapState } from 'vuex';
    import moment from 'moment';
    export default {
        components: {
            Availability,
            ReviewList,
            PriceBreakdown
        },
        props: {
            avgRating: Number,
            sumReview : Number
        },
        data(){
            return {
                bookable: null,
                loading : false,
                price: null
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
        },
        computed:mapState({
            lastSearch: "lastSearch"
        }),
        methods: {
           async checkPrice(hasAvailability){
                if(!hasAvailability){
                    this.price = null;
                    return;
                }
                try{
                    this.price = (await axios.get(`/api/bookables/${this.bookable.id}/price?from=${moment(this.lastSearch.from).format('YYYY-MM-DD') }&to=${moment(this.lastSearch.to).format('YYYY-MM-DD')}`
                    )).data.data;
                }catch (e) {
                    this.price = null;
                }
            }
        }
    }
</script>
