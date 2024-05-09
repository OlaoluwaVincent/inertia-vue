<template>

    <Head title="Welcome" />
    <section class="pb-10 tw-space-y-7 md:tw-space-y-10">
        <HomeBanner />
        <DataCount />
        <PopularCategories />
        <PopularCourse />
        <PopularInstructor />
        <UsersCompliment />
    </section>
</template>

<script setup>
import { Head } from '@inertiajs/vue3';
import HomeBanner from '@/Components/home/HomeBanner.vue';
import DataCount from '@/Components/home/DataCount.vue';
import PopularCourse from '@/Components/home/PopularCourse.vue';
import PopularCategories from '@/Components/home/PopularCategories.vue';
import PopularInstructor from '@/Components/home/PopularInstructor.vue';
import UsersCompliment from '@/Components/home/UsersCompliment.vue';
import { ref } from 'vue';

</script>
