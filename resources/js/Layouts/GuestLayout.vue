<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <div class="min-h-screen flex flex-col bg-gray-300/50">
        <h1>Guest Layouts</h1>
        <div>
            <slot />
        </div>
    </div>
</template>
