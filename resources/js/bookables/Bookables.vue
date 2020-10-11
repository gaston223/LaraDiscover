<template>

    <div>
        <!-- Jumbotron -->
        <div class="card card-image backgroundImage mb-5" style="background-image: url('http://www.coga6486.odns.fr/Chevereto/images/2020/10/10/theodor-vasile-d3jPsWVlYr4-unsplash-2.md.jpg');" >
            <div class="text-white text-center rgba-stylish-strong py-5 px-4">
                <div class="py-5">

                    <!-- Content -->

                    <h2 class="card-title h2 my-4 py-2">Trouvez le Combi de vos rêves !</h2>
                    <p class="mb-4 pb-2 px-md-5 mx-md-5">
                        Verifier la disponibilité des véhicules dans vos dates choisies et réserver la voiture de vos reves en toute sérénité !
                    </p>
                </div>
            </div>
        </div>
        <!-- Jumbotron -->

        <div v-if="loading">
            Chargement...
        </div>

        <div v-else>
            <h2>Nos Combis : </h2>
            <div class="row mb-4" v-for="row in rows" :key=" 'row' + row">
                <div class="col-md-4 d-flex align-items-stretch" v-for="(bookable, column) in bookablesInRow(row)"
                     :key="'row'+ row + column">
                    <bookable-list-item
                        v-bind="bookable"
                    >
                    </bookable-list-item>
                </div>
                <div class="col" v-for="p in placeholdersInRow(row)" :key="'placeholder' + row + p">

                </div>
            </div>

        </div>

    </div>
</template>

<script>
    import BookableListItem from "./BookableListItem";
    export default {
        components : {
            BookableListItem
        },
        data (){
            return {
             bookables : null,
             loading: false,
             columns: 3
            };
        },

        computed:{
            rows() {
              return this.bookables ===null ? 0 : Math.ceil(this.bookables.length / this.columns)
            }
        },
        methods: {
          bookablesInRow(row){
            return this.bookables.slice((row - 1) * this.columns, row * this.columns);
          },
          placeholdersInRow(row){
              return this.columns - this.bookablesInRow(row).length;
          }
        },
        created() {
            this.loading = true;

            const request = axios
                .get('/api/bookables')
                .then(response => {
                    this.bookables = response.data.data;
                    this.loading = false;
                });
        }
    };
</script>
