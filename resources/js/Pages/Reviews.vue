<template>
  <p class="tw-text-2xl tw-mb-10 content__padding" v-if="isNotAvailable">
    You have not given any reviews yet
  </p>
  <setion class="tw-flex tw-gap-5 tw-flex-col tw-mb-12">
    <UserReview :reviews="reviews.data" :canDelete="canDelete" />
  </setion>
  <Pagination :links="reviews.links" />
</template>

<script setup>
import Pagination from "@/Components/Pagination.vue";
import UserReview from "@/Components/course/UserReview.vue";
import UserLayout from "@/Layouts/UserLayout.vue";
import { computed } from "vue";

defineOptions({ layout: UserLayout });

const props = defineProps({
  reviews: Object,
  canDelete: Boolean,
});
const isNotAvailable = computed(() => {
  if (props.reviews == null || props.reviews?.data == undefined) {
    return true;
  }
  return false;
});

console.log(isNotAvailable.value);
</script>

<style>
</style>