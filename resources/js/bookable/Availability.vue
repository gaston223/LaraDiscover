<template>
    <div>
        <h6 class="text-uppercase blue-grey-text font-weight-bolder">Verifier la disponibilité</h6>

        <div class="row">

            <div class="col-md-6">
                <div class="md-form mb-0">
                    <input v-model="from" @keyup.enter="check" type="text" id="from" class="form-control" name="from">
                    <label for="from">Date de départ</label>
                </div>
            </div>
            <div class="col-md-6">
                <div class="md-form mb-0">
                    <input v-model="to" @keyup.enter="check" type="text" id="to" class="form-control" name="to" >
                    <label for="to">Date d'arrivée</label>
                </div>
            </div>
        </div>

        <button class="btn btn-block aqua-gradient" @click="check">Vérifier</button>
    </div>

</template>

<script>
    export default {
        data(){
            return {
                from: null,
                to: null
            }
        },
        methods : {
            check(){
                alert('On verifie vite fait !');
            }
        }
    }
</script>

<style scoped>
    label {
       font-size: 0.7rem;
        text-transform: uppercase;
        /*color: gray;*/
        font-weight: bold;
    }
</style>
