<template>
  <div class="tw-pt-5">
    <p v-if="courses.data === undefined || !courses.data.length">
      You have not created any course yet
    </p>
    <Link
      href="my-courses/create"
      class="tw-bg-teal-800 tw-text-white tw-p-2 rounded-md tw-mb-5 tw-block tw-w-fit"
    >
      Add Course
    </Link>
    <section class="courses">
      <CourseCard :data="courses.data" canDelete />
    </section>

    <Pagination v-if="courses.next_page_url" :links="courses.links" />
  </div>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";
import CourseCard from "@/Components/CourseCard.vue";
import Pagination from "@/Components/Pagination.vue";

import UserLayout from "@/Layouts/UserLayout.vue";

defineOptions({ layout: UserLayout });

const props = defineProps({
  courses: Object,
  status: String,
});
console.log(props.status);
</script>

<style scoped>
.courses {
  padding: 5%;
  padding-top: 0;
  display: grid;
  grid-template-columns: 1fr;
  gap: 20px;
}

@media (width>430px) {
  .courses {
    grid-template-columns: 1fr 1fr;
  }
}

@media (width>768px) {
  .courses {
    grid-template-columns: 1fr 1fr 1fr;
  }
}

@media (width>=1024px) {
  .courses {
    grid-template-columns: 1fr 1fr 1fr 1fr;
  }
}
</style>
