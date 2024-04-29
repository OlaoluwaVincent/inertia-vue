<script setup>
import { defineProps } from 'vue';
import { Head, Link } from '@inertiajs/vue3';
const props = defineProps({
    status: Boolean,
    instructors: Array
});

</script>

<template>

    <Head title="Dashboard" />

    <h2 class="tw-font-semibold tw-text-xl tw-text-gray-800 tw-leading-tight">Dashboard</h2>


    <div class="tw-py-12">
        <Link :href="route('profile.edit')" ethod="get" as="button"
            class="tw-underline tw-text-sm tw-text-gray-600 hover:tw-text-gray-900 tw-rounded-md focus:tw-outline-none focus:tw-ring-2 focus:tw-ring-offset-2 focus:tw-ring-indigo-500 tw-mr-8">
        Profile</Link>
        <Link :href="route('logout')" method="post" as="button"
            class="tw-underline tw-text-sm tw-text-gray-600 hover:tw-text-gray-900 tw-rounded-md focus:tw-outline-none focus:tw-ring-2 focus:tw-ring-offset-2 focus:tw-ring-indigo-500">
        Log Out</Link>
        <div class="tw-max-w-7xl tw-mx-auto sm:tw-px-6 lg:tw-px-8">
            <div class="tw-bg-white tw-overflow-hidden tw-shadow-sm sm:tw-rounded-lg">
                <div class="tw-p-6 tw-text-gray-900">You're logged in!</div>
            </div>
            <div class="tw-max-w-7xl tw-mx-auto sm:tw-px-6 lg:tw-px-8 tw-mt-5">
                <div v-if="props.instructors && props.instructors.length > 0"
                    class="tw-bg-white tw-overflow-hidden tw-shadow-sm sm:tw-rounded-lg">
                    <ul class="tw-p-3 tw-text-gray-900 flex-row-left-center tw-gap-5"
                        v-for="(instructors, key) in props.instructors" :key="key">
                        <span>
                            <v-avatar :image="instructors.profile_picture"></v-avatar>
                        </span>
                        <li>{{
                            instructors.name }}</li>
                    </ul>
                </div>
                <div v-else class="tw-p-3 tw-bg-white tw-rounded-md tw-shadow-md">You do not have any registered
                    Instrctors yet</div>
            </div>
        </div>
    </div>
</template>


<style scoped>
.flex-row-left-center {
    @apply tw-flex tw-items-center;
}
</style>