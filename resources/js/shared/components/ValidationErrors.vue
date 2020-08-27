<template>
    <div>
        <div class="invalid-feedback"
             v-for="(error, index) in errors"
             :key="key(index)">
            {{error}}
        </div>
    </div>
</template>

<style scoped>
    .form-control.is-invalid ~ div > .invalid-feedback {
        display: block;
    }
</style>

<script>
    export default {
        props : ["errors"],
        methods : {
            key(){
                return `validation_error_$(index)_${Math.random()}`;
            }
        }
    }
</script>
