<template>
    <div >
        <success v-if="success">
            Vous avez évalué votre expérience avec succès, nous vous remercions de votre contribution !
        </success>

        <fatal-error v-if="error"></fatal-error>
        <div class="row" v-if="!success && !error">
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
                            <textarea
                                id="content"
                                class="md-textarea form-control"
                                cols="20"
                                rows="5"
                                v-model="review.content"
                                :class="[{'is-invalid' : errorFor('content')}]">
                            </textarea>
                           <v-errors :errors="errorFor('content')"></v-errors>
                        </div>
                        <button class="btn btn-block aqua-gradient" @click.prevent="submit" :disabled="sending">Envoyer</button>
                    </div>
                </div>
            </div>

        </div>

    </div>
</template>

<script>
    import {is404, is422} from "../shared/utils/response";
    import validationErrors from "../shared/mixins/validationErrors";

    export default {
        mixins : [validationErrors],
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
             error: false,
             sending: false,
             success: false
         }
        },
       async created() {
            this.review.id = this.$route.params.id;
            this.loading = true;

            try{
                // 1. If review already exists(in reviews by Id)
                this.existingReview = (await axios.get(`/api/reviews/${this.review.id}`)).data.data;
            } catch (err) {
                if(is404(err)){
                    try {
                        // 2. Fetch a booking by a review key
                        this.booking = (await axios.get(`/api/booking-by-review/${this.review.id}`)).data.data;
                    } catch (err) {
                        this.error = !is404(err);
                    }

                } else{
                    this.error = true;
                }
            }
            this.loading = false;
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
            // 3. Store the review
            submit(){
                this.errors = null;
                this.sending = true;
                this.success = false;

                axios.post(`/api/reviews`, this.review)
                    .then(response =>{
                        this.success = 201 === response.status;
                    })
                    .catch((err) => {
                        if (is422(err)){
                            const errors = err.response.data.errors;
                            if(errors["content"] && 1 === _.size(errors)){
                                this.errors = errors;
                                return;
                            }
                        }
                        this.error = true;
                    })
                    .then(() => this.sending = false);
            }
        }
    }
</script>

<style scoped>
    .form-control.is-invalid ~ div > .invalid-feedback {
        display: block;
    }
</style>
