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

                <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img class="d-block w-100" :srcset="bookable.image">
                        </div>
                    </div>
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
                    <button type="button"
                            class="btn btn-block purple-gradient mb-2"
                            v-if="price"
                            @click="addToBasket"
                            :disabled="inBasketAlready"
                    >Ajouter au panier
                    </button>
                </transition>

                <button type="button"
                        class="btn btn-block purple-gradient"
                        v-if="inBasketAlready"
                         @click="removeFromBasket"
                >Supprimer du Panier
                </button>
                <div v-if="inBasketAlready" class="mt-4 text-muted warning">
                    Vous avez déja ajouté cette réservation dans le panier !
                </div>

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
            sumReview : Number,
        },
        data(){
            return {
                bookable: {},
                loading : false,
                price: null,
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
        computed:{
            ...mapState({
                lastSearch: "lastSearch",
            }),
            inBasketAlready(){
                if (null === this.bookable){
                    return false;
                }
                return this.$store.getters.inBasketAlready(this.bookable.id);
            }
        },
        methods: {
           async checkPrice(hasAvailability){
               this.lastSearch.from = moment(this.lastSearch.from).format('YYYY-MM-DD')
               this.lastSearch.to = moment(this.lastSearch.to).format('YYYY-MM-DD')
                if(!hasAvailability){
                    this.price = null;
                    return;
                }
                try{
                    this.price = (await axios.get(
                        `/api/bookables/${this.bookable.id}/price?from=${this.lastSearch.from}&to=${this.lastSearch.to}`
                    )).data.data;
                }catch (e) {
                    this.price = null;
                }
            },
            addToBasket(){
               this.$store.dispatch("addToBasket", {
                   bookable: this.bookable,
                   price : this.price,
                   dates : this.lastSearch
               });
            },
            removeFromBasket(){
               this.$store.dispatch("removeFromBasket", this.bookable.id);
            }

        }
    }
</script>
<style scoped>
    .warning{
        font-size: 0.7rem;
    }
    .carousel-item{
        width: 100%;
        /*height: 25vw;*/
        object-fit: cover;
    }
</style>
