<template>
    <!--Grid column-->
    <div class="col-md-6 m-auto">


        <!-- Material form login -->
        <div class="card">

            <h5 class="card-header purple-gradient white-text text-center py-4">
                <strong>Inscription</strong>
            </h5>

            <!--Card content-->
            <div class="card-body px-lg-5 pt-0">

                <!-- Form -->
                <form style="color: #757575;">

                    <!-- Name -->
                    <div class="md-form">
                        <input
                            type="text"
                            name="name"
                            id="materialLoginFormName"
                            class="form-control"
                            v-model="user.name"
                            :class="[{'is-invalid' : errorFor('name')}]"
                        >
                        <label for="materialLoginFormName" class="active">Prénom et Nom</label>
                        <v-errors :errors="errorFor('name')"></v-errors>
                    </div>

                    <!-- Email -->
                    <div class="md-form">
                        <input
                            type="email"
                            name="email"
                            id="materialLoginFormEmail"
                            class="form-control"
                            v-model="user.email"
                            :class="[{'is-invalid' : errorFor('email')}]"
                        >
                        <label for="materialLoginFormEmail" class="active">E-mail</label>
                        <v-errors :errors="errorFor('email')"></v-errors>
                    </div>

                    <!-- Password -->
                    <div class="md-form">
                        <input type="password"
                               name="password"
                               id="materialLoginFormPassword"
                               class="form-control"
                               v-model="user.password"
                               :class="[{'is-invalid' : errorFor('password')}]"
                        >
                        <label for="materialLoginFormPassword" class="active">Mot de passe</label>
                        <v-errors :errors="errorFor('password')"></v-errors>
                    </div>
                    <!-- Confirm Password -->
                    <div class="md-form">
                        <input type="password"
                               id="materialLoginFormPassword2"
                               class="form-control"
                               v-model="user.password_confirmation"
                               name="password_confirmation"
                               :class="[{'is-invalid' : errorFor('password_confirmation')}]"
                        >
                        <label for="materialLoginFormPassword2" class="active">Confirmez le Mot de passe</label>
                        <v-errors :errors="errorFor('password_confirmation')"></v-errors>
                    </div>

                    <div class="d-flex justify-content-around">
                        <div>
                            <!-- Remember me -->
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="materialLoginFormRemember">
                                <label class="form-check-label" for="materialLoginFormRemember">Se souvenir de moi</label>
                            </div>
                        </div>
                        <div>
                            <!-- Forgot password -->
                            <a href="">Mot de passe oublié ?</a>
                        </div>
                    </div>

                    <!-- Sign in button -->
                    <button
                        class="btn btn-outline-info btn-rounded btn-block my-4 waves-effect z-depth-0"
                        :disabled="loading"
                        type="submit"
                        @click.prevent="register"
                    >
                        S'inscrire
                    </button>

                    <!-- Register -->
                    <p>Vous êtes déja inscrit?
                        <router-link :to="{name: 'login'}">Connexion</router-link>
                    </p>

                </form>
                <!-- Form -->

            </div>

        </div>
        <!-- Material form login -->

    </div>
    <!--Grid column-->

</template>

<script>
    import validationErrors from "../shared/mixins/validationErrors";
    import {logIn} from "../shared/utils/auth";

    export default {
        mixins : [validationErrors],
        data () {
            return {
                user:{
                    name: null,
                    email: null,
                    password: null,
                    password_confirmation: null
                },

                loading: false
            }
        },
        methods: {
            async register(){
                this.loading = true;
                this.errors = null;

                try{
                    const response =  await axios.post('/register' , this.user);
                    if(201 === response.status){
                        logIn();
                        this.$store.dispatch("loadUser")
                        this.$router.push({name: "home"})
                    }

                }catch (error) {
                    this.errors = error.response && error.response.data.errors
                }

                this.loading = false;
            }
        }

    };
</script>

