<template>
    <div style="padding: 1.25rem">
        <h4 class="mb-3">Commentaires de nos Explorateurs :</h4>

        <!-- Note globale -->
        <div class="alert alert-info">
            <h4 class="alert-heading text-center">
                <div class="row align-items-center">
                    <div class="col">
                        Note globale donnée par nos explorateurs
                    </div>
                    <div class="col">
                        <span class="rating">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </span>
                        <br>
                         <small>(Calculée sur 1 avis )</small>
                    </div>
                </div>
            </h4>
        </div>

        <!--Commentaires-->
        <div class="bg-light rounded mb-3 py-3 px-3 d-none d-md-block " v-for="number in 3" :key="number">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <strong>Eric Choupo</strong> a dit :
                </div>

                <div class="col-md-6 d-flex justify-content-end">
                    <strong>Note : </strong>

                    <span class="rating">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </span>
                </div>
            </div>

            <blockquote>
                Voluptatem ducimus assumenda voluptatibus asperiores velit vel. Illo expedita ex inventore doloribus eligendi suscipit omnis est. Fugit quia ratione temporibus nobis esse consectetur.
            </blockquote>

            <blockquote>
                Ajouté il y a 5 minutes
            </blockquote>

        </div>


    </div>
</template>

