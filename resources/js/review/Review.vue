<template>
    <div >
        <fatal-error v-if="error"></fatal-error>
        <div class="row" v-else>
            <div :class="[{'col-md-4':twoColumns},{'d-none': oneColumn}]">
                <div class="card m-4">
                    <div class="card-body">
                        <div v-if="loading">Chargement...</div>
                        <div v-if="hasBooking">
                            <p>
                                Votre réservation à
                                <router-link
                                :to="{name: 'bookable', params: { id: booking.bookable.bookable_id}}"
                                 >{{ booking.bookable.title }}
                                </router-link>
                            </p>
                            <p>Du {{booking.from}} au {{booking.to}}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div :class="[{'col-md-8': twoColumns},{'col-md-12': oneColumn}]">
                <div v-if="loading">Chargement</div>

                <div v-else>
                    <div v-if="alreadyReviewed">
                        <h3>Vous avez déja laissé un avis pour cette réservation !</h3>
                    </div>

                    <div v-else>
                        <div class="form-group">
                            <label class="text-muted">Selectionnez votre note de 1 (Catastrophique) à 5 (Magnifique)</label>
                            <star-rating class="fa-2x rating" v-model="review.rating"></star-rating>
                        </div>
                        <div class="form-group md-form">
                            <label for="content" class="text-muted">Décrivez votre expérience ...</label>
                            <textarea id="content" class="md-textarea form-control" cols="20" rows="5" v-model="review.content"></textarea>
                        </div>
                        <button class="btn btn-block aqua-gradient" @click.prevent="submit" :disabled="loading">Envoyer</button>
                    </div>
                </div>
            </div>

        </div>

    </div>
</template>

<script>
    import {is404} from "../shared/utils/response";

    export default {
        data () {
         return{
             review: {
                 id: null,
                 rating:5,
                 content: null
             },
             existingReview: null,
             loading: false,
             booking : null,
             error: false
         }
        },
        created() {
            this.review.id = this.$route.params.id;
            this.loading = true;
            // 1. If review already exists(in reviews by Id)
            axios.get(`/api/reviews/${this.review.id}`)
                .then(response => {
                    this.existingReview = response.data.data
                })
                .catch(err => {
                    if(
                        is404(err)
                    ){
                        // 2. Fetch a booking by a review key
                        return axios.get(`/api/booking-by-review/${this.review.id}`)
                            .then(response => {
                                this.booking = response.data.data;
                            }).catch((err) => {
                                this.error = !is404(err);

                                //is404(err) ? {} : (this.error = true);

                                /*if(!is404(err)){
                                    this.error = true;
                                }*/
                            });
                    }
                    this.error = true;
                })
                .then(() => {
                    /*console.log(response)*/
                    this.loading = false;
                });

            // 3. Store the review
        },
        computed: {
            alreadyReviewed() {
                return this.hasReview || !this.booking;
            },
            hasReview() {
                return this.existingReview !== null;
            },
            hasBooking() {
                return this.booking !== null;
            },
            oneColumn(){
                return !this.loading && this.alreadyReviewed;
            },
            twoColumns(){
                return this.loading || !this.alreadyReviewed;
            },
        },
        methods: {
            submit(){
                this.loading = true;
                axios.post(`/api/reviews`, this.review)
                    .then(response => console.log(response))
                    .catch((err) => this.error = true)
                    .then(() => this.loading = false);
            }
        }
    }
</script>
