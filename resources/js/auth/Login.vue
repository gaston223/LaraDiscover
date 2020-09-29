<template>
    <!--Grid column-->
    <div class="w-50 m-auto">


            <!-- Material form login -->
            <div class="card">

                <h5 class="card-header purple-gradient white-text text-center py-4">
                    <strong>Connexion</strong>
                </h5>

                <!--Card content-->
                <div class="card-body px-lg-5 pt-0">

                    <!-- Form -->
                    <form style="color: #757575;">

                        <!-- Email -->
                        <div class="md-form">
                            <input
                                type="email"
                                id="materialLoginFormEmail"
                                class="form-control"
                                v-model="email"
                                :class="[{'is-invalid' : errorFor('email')}]"
                            >
                            <label for="materialLoginFormEmail" class="active">E-mail</label>
                            <v-errors :errors="errorFor('email')"></v-errors>
                        </div>

                        <!-- Password -->
                        <div class="md-form">
                            <input type="password"
                                   id="materialLoginFormPassword"
                                   class="form-control"
                                   v-model="password"
                                   :class="[{'is-invalid' : errorFor('password')}]"
                            >
                            <label for="materialLoginFormPassword" class="active">Mot de passe</label>
                            <v-errors :errors="errorFor('password')"></v-errors>
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
                            @click.prevent="login"
                        >
                            Connexion
                        </button>

                        <!-- Register -->
                        <p>Pas encore inscrit?
                            <router-link :to="{name: 'home'}">Inscription</router-link>
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
            email: null,
            password: null,
            loading: false
        }
    },
    methods: {
        async login(){
            this.loading = true;
            this.errors = null;

                try{
                    await axios.get('/sanctum/csrf-cookie');
                    await axios.post('/login' , {
                        email: this.email,
                        password: this.password
                    });
                    logIn();
                    this.$store.dispatch("loadUser")
                    this.$router.push({name: "home"})
                }catch (error) {
                    this.errors = error.response && error.response.data.errors
                }

            this.loading = false;
        }
    }

};
</script>

