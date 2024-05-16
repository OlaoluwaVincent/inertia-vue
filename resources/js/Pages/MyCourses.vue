<template>
  <div class="tw-pt-5">
    <p v-if="courses.data === undefined">You have not created any course yet</p>
    <section class="courses">
      <CourseCard :data="courses.data" />
    </section>

    <Pagination v-if="courses.next_page_url" :links="courses.links" />
  </div>
</template>

<script setup>
import CourseCard from "@/Components/CourseCard.vue";
import Pagination from "@/Components/Pagination.vue";

import UserLayout from "@/Layouts/UserLayout.vue";

defineOptions({ layout: UserLayout });

const props = defineProps({
  courses: Object,
});
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
