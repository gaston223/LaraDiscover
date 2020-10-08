<template>
    <div>

        <body>

        <header>
        <!--Navbar -->
            <nav class="mb-1 navbar navbar-expand-lg navbar navbar-light grey lighten-5 fixed-top scrolling-navbar">
                <div class="container">
                    <router-link :to="{name: 'home'}" class="navbar-brand logo" href="#"><i style="color: #2bbbad" class="fas fa-car-alt"></i> CAR-DISCOVER</router-link>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-333"
                            aria-controls="navbarSupportedContent-333" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent-333">
                        <ul class="navbar-nav mr-auto">
                            <!--<li class="nav-item">
                                <router-link :to="{name : 'home'}" class="nav-link">Home</router-link>
                            </li>
-->
                        </ul>
                        <ul class="navbar-nav ml-auto nav-flex-icons">
                            <li class="nav-item dropdown" v-if="isLoggedIn">
                                <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-333" data-toggle="dropdown"
                                   aria-haspopup="true" aria-expanded="false">
                                    Bonjour {{currentUser.name}}
                                    <i class="fas fa-user"></i>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right dropdown-default"
                                     aria-labelledby="navbarDropdownMenuLink-334">
                                    <router-link :to="{name:'bookings',params: { id : user.id} }" class="dropdown-item">
                                        Mon Compte
                                    </router-link>
                                </div>
                            </li>

                            <li class="nav-item" v-if="!isLoggedIn">
                                <router-link :to="{name:'register'}" class="nav-link waves-effect">
                                   Inscription
                                    <i class="fas fa-user-plus"></i>
                                </router-link>
                            </li>
                            <li class="nav-item" v-if="!isLoggedIn">
                                <router-link :to="{name:'login'}" class="nav-link waves-effect">
                                   Connexion
                                    <i class="fas fa-sign-in-alt"></i>
                                </router-link>
                            </li>
                            <li class="nav-item" v-if="isLoggedIn">
                                <a class="nav-link waves-effect" href="#" @click.prevent="logout">
                                    Déconnexion
                                    <i class="fas fa-sign-out-alt"></i>
                                </a>
                            </li>

                            <li class="nav-item">
                                <router-link :to="{name:'basket'}" class="nav-link waves-effect">
                                    <span v-if="itemsInBasket" class="badge red z-depth-1 mr-1">{{itemsInBasket}}</span>
                                    <i class="fas fa-shopping-cart"></i>
                                    <span class="clearfix d-none d-sm-inline-block"> Panier </span>
                                </router-link>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>


        </header>
        <!--/.Navbar -->
        <!--<router-link to="/">Home</router-link>
        <router-link to="/second">Second</router-link>-->





        <div class="container mt-5 mb-5 pr-4 pl-4 ">
            <router-view class="pt-5"></router-view>
        </div>


        </body>
    </div>
</template>


<style>
    body{
        font-weight: normal;
    }
    h1,h2,h3,h4,h5,h6,p{
        font-weight: normal;
    }
   .logo{
        font-weight: bold;
    }
</style>

<script>
    import { mapState, mapGetters } from 'vuex';
    import {logOut} from "./shared/utils/auth";
    export default {
        data(){
            return {
                lastSearch: this.$store.state.lastSearch,
                //userId: this.$store.state.user.id
            };
        },
        computed: {
            ...mapState({
                lastSearchComputed: "lastSearch",
                isLoggedIn: "isLoggedIn",
                user: "user"
            }),
            ...mapGetters({
               itemsInBasket: 'itemsInBasket',
                currentUser : 'currentUser'
            }),
            somethingElse(){
               return 1+2;
            }
        },
        methods :{
            async logout (){
               try {
                axios.post("/logout");
               this.$store.dispatch("logout");
               } catch (error) {
                   this.$store.dispatch("logout");
               }
            }
        }
    }
</script>
