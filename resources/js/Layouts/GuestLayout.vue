<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <div
        class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0"
        style="background-image: url('/images/background.png'); background-size: cover; background-position: center;"
    >
        <slot />
    </div>
</template>
