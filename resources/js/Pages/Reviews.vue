<template>
  <p class="tw-text-2xl tw-mb-10 content__padding" v-if="isAvailable">
    You have not given any reviews yet
  </p>
  <setion class="tw-flex tw-gap-5 tw-flex-col tw-mb-12">
    <UserReview :reviews="reviews.data" :canDelete="canDelete" />
  </setion>
  <Pagination v-if="!isAvailable" :links="reviews.links" />
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
  error: Object,
  auth: Object,
  status: String,
});
const isAvailable = computed(() => {
  if (!props.reviews?.data?.length || props.reviews?.data == undefined) {
    return true;
  }
  return false;
});
</script>

<style>
</style>