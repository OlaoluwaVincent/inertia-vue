<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
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
    <GuestLayout>

        <Head title="Welcome" />
        <div>Hello, {{ }}</div>
    </GuestLayout>

</template>
