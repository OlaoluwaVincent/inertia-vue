<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <div class="min-h-screen flex flex-col bg-gray-100">

        <div class="">
            <slot />
        </div>
    </div>
</template>
