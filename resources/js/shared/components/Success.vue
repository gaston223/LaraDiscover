<template>
    <div class="text-center success">
        <i class="fas fa-check"></i>
        <h1 class="mt-4"> Super ! </h1>
        <h2>
            <slot></slot>
        </h2>
    </div>
</template>

<style scoped>
    .success {
        color: #999;
        font-size : 10rem;
    }
</style>
