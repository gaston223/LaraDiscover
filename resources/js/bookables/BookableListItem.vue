<template>

    <!-- Card -->
    <div class="card">
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

            <!-- Title -->
            <h4 class="card-title">{{ itemTitle }}</h4>
            <!-- Text -->
            <p class="card-text"> {{ itemContent }}</p>

            <p>{{ price }}</p>
            <!-- Button -->
            <a href="#" class="btn btn-primary">Button</a>

        </div>

    </div>
    <!-- Card -->


</template>

<script>
    export default {
        props: {"itemTitle": String, "itemContent" : String, "price" : Number},
    }
</script>
