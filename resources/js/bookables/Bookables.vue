<template>

    <div>
        <!-- Jumbotron -->
        <div class="card card-image backgroundImage mb-5" style="background-image: url('https://images.unsplash.com/photo-1489008777659-ad1fc8e07097?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1350&q=80');" >
            <div class="text-white text-center rgba-stylish-strong py-5 px-4">
                <div class="py-5">

                    <!-- Content -->

                    <h2 class="card-title h2 my-4 py-2">Profitez des meilleurs expériences !</h2>
                    <p class="mb-4 pb-2 px-md-5 mx-md-5">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Pariatur obcaecati vero aliquid libero doloribus ad, unde tempora maiores, ullam, modi qui quidem minima debitis perferendis vitae cumque et quo impedit.</p>

                </div>
            </div>
        </div>
        <!-- Jumbotron -->

        <div v-if="loading">
            Chargement...
        </div>

        <div v-else>
            <h2>Nos Expériences : </h2>
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
