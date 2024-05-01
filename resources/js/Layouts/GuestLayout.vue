<template>
    <!-- theme='dark' -->
    <VApp :theme="theme">
        <AppHeader />
        <v-main class="tw-mt-4">
            <slot />
        </v-main>
    </VApp>
</template>

<script setup>
import AppHeader from '@/Components/AppHeader.vue';
import { watch } from 'vue';
import { useTheme } from 'vuetify';

const theme = useTheme().global.name;

// Watch for changes in the global theme and update the local theme variable
watch(theme, (newVal) => {
    updateTheme(newVal);
});

const updateTheme = (newTheme) => {
    theme.value = newTheme;
};
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