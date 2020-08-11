<template>

    <!-- Card -->
    <div class="card card-personal mb-4 ">
        <!--Card image-->
        <div class="view overlay">
            <img class="card-img-top" src="https://mdbootstrap.com/img/Photos/Others/images/21.jpg"
                 alt="Card image cap">
            <a href="#!">
                <div class="mask rgba-white-slight"></div>
            </a>
        </div>
        <!--Card image-->

        <!-- Card content -->
        <div class="card-body ">

            <router-link :to="{ name: 'bookable', params: { id : id} }">
                <!-- Title -->
                <h4 class="card-title">{{ title }}</h4>
            </router-link>

            <a>
                <span class="badge badge-info py-2 px-2 mt-2">$ 150</span>
            </a>

            <!-- Text -->
            <p class="card-text mt-2"> {{ description }}</p>

            <!--Grid row-->
            <div class="row">

                <!--Grid column-->
                <div class="col-lg-4 col-md-12 text-center">
                    <p class="dark-grey-text">
                        <i class="fas fa-hotel dark-grey-text" aria-hidden="true"></i> 1 bed
                    </p>
                </div>
                <!--Grid column-->

                <!--Grid column-->
                <div class="col-lg-4 col-md-12 text-center">
                    <p class="dark-grey-text">
                        <i class="fas fa-utensils dark-grey-text" aria-hidden="true"></i> Launches
                    </p>
                </div>
                <!--Grid column-->

                <!--Grid column-->
                <div class="col-lg-4 col-md-12 text-center">
                    <p class="dark-grey-text">
                        <i class="fas fa-wifi dark-grey-text" aria-hidden="true"></i> Wi-Fi</p>
                </div>
                <!--Grid column-->

            </div>
            <!--Grid row-->

            <hr>
            <!--Grid column-->
            <div class="col-12 text-center ">
                <button class="btn btn-info btn-sm font-weight-bold btn-rounded">
                    <strong>Book a room</strong>
                </button>
            </div>
            <!--Grid column-->

        </div>

    </div>
    <!-- Card -->


</template>

<script>
    export default {
        props: {"title": String, "description" : String, "id" : Number},
    }
</script>
