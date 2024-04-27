<script setup>
import { Head, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
});

const { user } = usePage();

const isLoggedIn = computed(() => !!user);
</script>


<template>


    <Head title="Welcome" />
    <div>Hello, {{ }}</div>

</template>
