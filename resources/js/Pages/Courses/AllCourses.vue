<template>
  <Head title="Courses" />
  <section class="wrapper">
    <!-- <Filter /> -->
    <div class="tw-pt-5">
      <section class="courses">
        <CourseCard :data="props.courses.data" />
      </section>
      <Pagination :links="props.courses.links" />
    </div>
  </section>
</template>

<script setup>
import { Head } from "@inertiajs/vue3";
import CourseCard from "@/Components/CourseCard.vue";
import Filter from "@/Components/Filter.vue";
import Pagination from "@/Components/Pagination.vue";

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
