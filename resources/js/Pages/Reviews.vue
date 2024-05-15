<template>
  <h4 class="tw-text-4xl tw-mb-10 content__padding" v-if="!reviews.data.length">
    You have not given any reviews yet
  </h4>
  <setion class="tw-flex tw-gap-5 tw-flex-col tw-mb-12">
    <UserReview :reviews="reviews.data" :canDelete="canDelete" />
  </setion>
  <Pagination :links="reviews.links" />
</template>

<script setup>
import Pagination from "@/Components/Pagination.vue";
import UserReview from "@/Components/course/UserReview.vue";
import UserLayout from "@/Layouts/UserLayout.vue";

defineOptions({ layout: UserLayout });

const props = defineProps({
  reviews: Object,
  canDelete: Boolean,
});

console.log(props.canDelete);
</script>

<style>
</style>