<template>

    <!-- Card -->
    <div class="card w-100">
        <!-- Card image -->
        <div class="view overlay">
            <img class="card-img-top" src="https://mdbootstrap.com/img/Photos/Others/images/16.jpg"
                 alt="Card image cap">
            <a href="#!">
                <div class="mask rgba-white-slight"></div>
            </a>
        </div>

        <!-- Card content -->
        <div class="card-body">

            <router-link :to="{ name: 'bookable', params: { id : id} }">
                <!-- Title -->
                <h4 class="card-title">{{ title }}</h4>
            </router-link>

            <!-- Text -->
            <p class="card-text"> {{ description }}</p>

            <!-- Button -->
            <a href="#" class="btn btn-primary">Button</a>

        </div>

    </div>
    <!-- Card -->


</template>

<script>
    export default {
        props: {"title": String, "description" : String, "id" : Number},
    }
</script>
