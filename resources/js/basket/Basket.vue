<template>
    <div>
        <success v-if="success">
            Votre réservation a bien été effectuée !
            Merci de votre confiance
        </success>
        <div class="row" v-else>
            <div class="col-md-8 mb-3" v-if="itemsInBasket">
                <h4 class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-muted">Vos informations</span>
                </h4>

                <!--Card-->
                <div class="card">

                    <!--Card content-->
                    <form class="card-body">

                        <!--Grid row-->
                        <div class="row">
                            <!--Grid column-->
                            <div class="col-md-6 mb-2">

                                <!--firstName-->
                                <div class="md-form ">
                                    <input
                                        type="text"
                                        id="firstName"
                                        class="form-control"
                                        name="first_name"
                                        v-model="customer.first_name"
                                        :class="[{'is-invalid' : errorFor('customer.first_name')}]"
                                    >
                                    <v-errors :errors="errorFor('customer.first_name')"></v-errors>
                                    <label for="firstName" class="">Prénom</label>

                                </div>

                            </div>
                            <!--Grid column-->

                            <!--Grid column-->
                            <div class="col-md-6 mb-2">
                                <!--lastName-->
                                <div class="md-form">
                                    <input
                                        type="text"
                                        id="lastName"
                                        class="form-control"
                                        name="last_name"
                                        v-model="customer.last_name"
                                        :class="[{'is-invalid' : errorFor('customer.last_name')}]">
                                    <v-errors :errors="errorFor('customer.last_name')"></v-errors>
                                    <label for="lastName" class="">Nom</label>
                                </div>

                            </div>
                            <!--Grid column-->
                        </div>
                        <!--Grid row-->

                        <!--email-->
                        <div class="md-form mb-5">
                            <input
                                type="text"
                                id="email"
                                class="form-control"
                                name="email"
                                v-model="customer.email"
                                :class="[{'is-invalid' : errorFor('customer.email')}]">
                            <v-errors :errors="errorFor('customer.email')"></v-errors>
                            <label for="email" class="">Email </label>
                        </div>

                        <!--address-->
                        <div class="md-form mb-5">
                            <input
                                type="text"
                                id="address"
                                class="form-control"
                                name="address"
                                v-model="customer.street"
                                :class="[{'is-invalid' : errorFor('customer.street')}]"
                            >
                            <v-errors :errors="errorFor('customer.street')"></v-errors>
                            <label for="address" class="">Adresse</label>
                        </div>

                        <!--Grid row-->
                        <div class="row">
                            <!--Grid column-->
                            <div class="col-md-6 mb-2">

                                <!--city-->
                                <div class="md-form ">
                                    <input
                                        type="text"
                                        id="city"
                                        class="form-control"
                                        name="city"
                                        v-model="customer.city"
                                        :class="[{'is-invalid' : errorFor('customer.city')}]"
                                    >
                                    <v-errors :errors="errorFor('customer.city')"></v-errors>
                                    <label for="city" class="">Ville</label>
                                </div>

                            </div>
                            <!--Grid column-->

                            <!--Grid column-->
                            <div class="col-md-6 mb-2">
                                <!--code Postal-->
                                <div class="md-form">
                                    <input
                                        type="number"
                                        id="zip"
                                        class="form-control"
                                        name="zip"
                                        v-model="customer.zip"
                                        :class="[{'is-invalid' : errorFor('customer.zip')}]">
                                    <v-errors :errors="errorFor('customer.zip')"></v-errors>
                                    <label for="zip" class="">Code Postal</label>
                                </div>

                            </div>
                            <!--Grid column-->
                        </div>
                        <!--Grid row-->
                        <hr class="mb-4">
                        <button class="btn btn-primary btn-lg btn-block"
                                type="submit"
                                @click.prevent="book"
                                :disabled="loading"
                        >Réserver Maintenant
                        </button>

                    </form>

                </div>
                <!--/.Card-->
            </div>

            <div class="col-md-8" v-else>
                <div class="jumbotron jumbotron-fluid text-center">
                    <div class="container">
                        <h2 class="display-4">Vide</h2>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <!-- Heading -->
                <h4 class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-muted">Votre Panier</span>
                    <span class="badge badge-secondary badge-pill" v-if="itemsInBasket">{{itemsInBasket}}</span>
                    <span class="badge badge-secondary badge-pill" v-else>Vide</span>
                </h4>
                        <!--Cart-->
                        <ul class="list-group mb-3 z-depth-1" :key="1">
                            <transition-group name="fade">
                                <li class="list-group-item" v-for="item in basket" :key="item.bookable.id">
                                    <div class="pt-2 pb-2 d-flex justify-content-between">
                                    <span>
                                      <router-link
                                          :to="{name: 'bookable', params: {id: item.bookable.id}}"
                                      >{{ item.bookable.title }}</router-link>
                                    </span>
                                        <span class="font-weight-bold">{{ item.price.total }} €</span>
                                    </div>

                                    <div class="pt-2 pb-2 d-flex justify-content-between">
                                        <span>Du {{ item.dates.from | date }}</span>
                                        <span>Au {{ item.dates.to | date }}</span>
                                    </div>

                                    <div class="pt-2 pb-2 text-right">
                                        <button
                                            class="btn btn-sm btn-outline-secondary"
                                            @click="$store.dispatch('removeFromBasket', item.bookable.id)"
                                        >
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </div>
                                </li>
                            </transition-group>

                            <li class="list-group-item d-flex justify-content-between">
                                <span>Total</span>
                                <strong>20€</strong>
                            </li>

                        </ul>
                        <!--Cart-->


            </div>
        </div>
    </div>
</template>
<script>
    import {mapGetters, mapState} from "vuex";
    import validationErrors from "../shared/mixins/validationErrors";
    export default {
        mixins : [validationErrors],
        data(){
            return{
                loading: false,
                bookingAttempted: false,
                customer: {
                    first_name:null,
                    last_name:null,
                    email:null,
                    street:null,
                    city:null,
                    zip:null,
                }
            }

        },
        computed: {
            ...mapGetters(["itemsInBasket"]),
            ...mapState({
                basket: state => state.basket.items
            }),
            success(){
                return !this.loading && 0 === this.itemsInBasket && this.bookingAttempted;
            }
        },
        methods : {
            async book(){
            this.loading = true;
            this.bookingAttempted = false;
            this.errors = null;

            try {
                await axios.post(`api/checkout`, {
                    customer: this.customer,
                    bookings :this.basket.map(basketItem => ({
                        bookable_id : basketItem.bookable.id,
                        from : basketItem.dates.from,
                        to : basketItem.dates.to
                    }))
                });
                await this.$store.dispatch("clearBasket")
            }catch (err) {
                this.errors = err.response && err.response.data.errors;
            }
                this.loading = false;
                this.bookingAttempted = true;
            },
        }
    }

</script>

<style scoped>
    a{
        color:black;
    }
</style>
