<template>

    <!-- Card -->
    <div class="card card-personal mb-4 ">
        <!--Card image-->
        <div class="view overlay">
            <img class="card-img-top" :srcset="this.image"
                 alt="Card image cap">
            <router-link :to="{ name: 'bookable', params: { id : id} }">
                <div class="mask rgba-white-slight"></div>
            </router-link>
        </div>
        <!--Card image-->

        <!-- Card content -->
        <div class="card-body ">

            <router-link :to="{ name: 'bookable', params: { id : id} }">
                <!-- Title -->
                <h4 class="card-title">{{ title }}</h4>
            </router-link>

            <a>
                <span class="badge badge-info py-2 px-2 mt-2 mb-2">{{price}} € / jour</span>
            </a>

            <star-rating :value="average_rating" class="list-unstyled rating mt-2"></star-rating>
            <span class="text-muted">{{average_rating|numeral('0.0')}} ({{sum_review}}) </span>



            <!-- Text -->
            <p class="card-text mt-2"> {{ description }}</p>

            <!--Grid row-->
            <div class="row single-line">

                <!--Grid column-->
                <div class="col-lg-4 col-md-12 text-center">
                    <p class="dark-grey-text">
                        <i class="fas fa-gas-pump"></i>
                         <span> Diesel</span>
                    </p>
                </div>
                <!--Grid column-->

                <!--Grid column-->
                <div class="col-lg-4 col-md-12 text-center" style="text-align: justify">
                    <p class="dark-grey-text">
                        <i class="far fa-snowflake"></i> Clim
                    </p>
                </div>
                <!--Grid column-->


                <!--Grid column-->
                <div class="col-lg-4 col-md-12 text-center">
                    <p class="dark-grey-text">
                        <i class="fab fa-bluetooth"></i> Bluetooth</p>
                </div>
                <!--Grid column-->

            </div>
            <!--Grid row-->

            <hr>
            <!--Grid column-->
            <div class="col-12 text-center ">
                <router-link :to="{ name: 'bookable', params: { id : id} }" class="btn btn-info btn-sm">
                    <strong>Réserver</strong>
                </router-link>
            </div>
            <!--Grid column-->

        </div>

    </div>
    <!-- Card -->


</template>

<script>
    export default {
        props: {"title": String, "description" : String, "id" : Number, "image" : String, "price" : Number,  "average_rating":Number, "sum_review" : Number},
    }
</script>
<style scoped>
        @media (min-width: 900px) {
            .card-img-top {
                width: 100%;
                height: 15vw;
                object-fit: cover;
            }
        }

</style>
