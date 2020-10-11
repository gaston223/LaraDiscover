<template>
    <div>
        <div v-if="this.$store.state.isLoggedIn">
            <div v-if="loading">
                Chargement...
            </div>

            <div v-else>
                <h1 class="my-5">Mes réservations</h1>
                <div class="alert alert-info mt-5">
                    <p>Retrouvez ci-dessous toutes vos réservations passées et à venir</p>
                    <!--  {{currentUser}}-->
                </div>

                <div class="row mt-5" v-for="booking in bookings" :key=" 'booking' + booking.id">
                    <div class="col-md-4">
                        <img :srcset="booking.bookable.image" alt="Photo de l'annonce" class="img-fluid">
                        <div class="mt-3">
                           <!-- <router-link :to="{name: 'review', params: {id: booking.review_key}}">Je donne mon avis</router-link>-->
                        <!--{{booking.review_key}}-->
                        </div>
                    </div>

                    <div class="col-md-8">
                        <h4>{{booking.bookable.title}}.</h4>
                        <p>Réservation <strong>{{booking.id}}</strong> <br>
                            Du {{ booking.from | date }} au {{ booking.to | date }}
                            ({{booking.price}} €)
                        </p>
                        <!--<a href="/booking/1159" class="btn btn-info">Plus d'informations</a>-->
                        <router-link class="btn purple-gradient" :to="{name: 'review', params: {id: booking.review_key}}">Je donne mon avis !</router-link>
                    </div>
                </div>
            </div>
        </div>
        <div v-else>
            <h4 class="display-5"> Veuillez vous connecter pour consulter vos réservations</h4>

        </div>

    </div>
</template>
<script>
    import {mapGetters, mapState} from "vuex";
    import {is404, is422} from "../shared/utils/response";

    export default {
    data (){
        return {
            bookings : null,
            loading: false,
            userId : this.$route.params.id
        };
    },
        computed: {
            ...mapGetters(["currentUser"]),
            ...mapState({
                user: state => state.user
            }),

        },

       async created() {

        try {
            console.log(this.userId);
            this.loading = true;
            await
                axios.get(`/api/bookings/${this.userId}`)
                    .then(response => this.bookings = response.data.data)
                    .then(()=>(this.loading = false)
                    );

        }catch (error) {
            this.errors = error.response.data.errors;
            this.status = error.response.status;
        }


    }
}
</script>
