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
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-334" data-toggle="dropdown"
                                   aria-haspopup="true" aria-expanded="false">
                                    Bonjour Gaoussou
                                    <i class="fas fa-user"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-default"
                                     aria-labelledby="navbarDropdownMenuLink-334">
                                    <a class="dropdown-item" href="#">Action</a>
                                    <a class="dropdown-item" href="#">Another action</a>
                                    <a class="dropdown-item" href="#">Something else here</a>
                                </div>
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

        <!-- Jumbotron -->
        <div class="card card-image pt-5 backgroundImage" style="background-image: url('https://images.unsplash.com/photo-1489008777659-ad1fc8e07097?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1350&q=80');" >
            <div class="text-white text-center rgba-stylish-strong py-5 px-4">
                <div class="py-5">

                    <!-- Content -->

                    <h2 class="card-title h2 my-4 py-2">Profitez des meilleurs expériences !</h2>
                    <p class="mb-4 pb-2 px-md-5 mx-md-5">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Pariatur obcaecati vero aliquid libero doloribus ad, unde tempora maiores, ullam, modi qui quidem minima debitis perferendis vitae cumque et quo impedit.</p>
                    <a class="btn btn-rounded purple-gradient"><i class="fas fa-clone left"></i> RESERVATION</a>

                </div>
            </div>
        </div>
        <!-- Jumbotron -->


        <div class="container mt-4 mb-4 pr-4 pl-4 ">
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
    export default {
        data(){
            return {
                lastSearch: this.$store.state.lastSearch
            };
        },
        computed: {
            ...mapState({
                lastSearchComputed: "lastSearch"
            }),
            ...mapGetters({
               itemsInBasket: 'itemsInBasket'
            }),
            somethingElse(){
               return 1+2;
            }
        }
    }
</script>
