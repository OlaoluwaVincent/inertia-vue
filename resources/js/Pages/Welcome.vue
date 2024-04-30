<template>

    <Head title="Welcome" />
    <section>
        <v-switch v-model="isDark" color="primary" hide-details inset></v-switch>
        <div>Hello</div>
    </section>
</template>

<script setup>
import { Head } from '@inertiajs/vue3';
import { ref, watch } from 'vue';
import { useTheme } from 'vuetify';

const props = defineProps({
    canResetPassword: Boolean,
    status: String,
});

const theme = useTheme();
const isDark = ref(false);

function toggleTheme() {
    if (isDark.value) {
        theme.global.name.value = 'dark';
    } else {
        theme.global.name.value = 'light';
    }
}

// Watch for changes in the isDark variable and toggle theme accordingly
watch(isDark, () => {
    toggleTheme();
});
</script>
