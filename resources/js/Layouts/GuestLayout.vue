<script setup>
import AppHeader from '@/Components/AppHeader.vue';

</script>

<template>
    <VApp>
        <AppHeader />
        <v-main class="tw-bg-gray-300/50">
            <slot />
        </v-main>
    </VApp>
</template>
