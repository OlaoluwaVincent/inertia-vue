<template>
  <Link
    v-if="isOnboard"
    href="my-courses/create"
    class="tw-bg-teal-800 tw-text-white tw-p-2 rounded-md"
  >
    Add Course
  </Link>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";
import UserLayout from "@/Layouts/UserLayout.vue";

defineOptions({ layout: UserLayout });

const props = defineProps({
  auth: Object,
  errors: Object,
  isOnboard: Boolean,
});
</script>

<style scoped>
</style>
