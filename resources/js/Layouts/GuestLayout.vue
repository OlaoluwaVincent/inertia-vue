<template>
    <!-- theme='dark' -->
    <VApp :theme="themeStore.isDark ? 'dark' : 'light'">
        <AppHeader />
        <v-main class="tw-mt-4">
            <slot />
        </v-main>
        <Footer />
    </VApp>
</template>

<script setup>
import AppHeader from '@/Components/AppHeader.vue';
import Footer from '@/Components/Footer.vue';
import { useThemeStore } from '@/store/theme';
const themeStore = useThemeStore()

</script>


<style>
.content__padding {
    padding: 4%;
}

@media (width>600px) {
    .content__padding {
        padding: 20px;
    }
}

@media (width>=1024px) {
    .content__padding {
        padding: 20px 40px;
    }
}
</style>