<template>
  <Head title="Courses" />
  <section class="content__padding">
     <Filter />
    <div class="tw-pt-5">
      <section class="courses">
        <CourseCard :data="main_courses" />
      </section>
      <Pagination :links="main_links" />
    </div>
  </section>
</template>

<script setup>
import { Head } from "@inertiajs/vue3";
import CourseCard from "@/Components/CourseCard.vue";
import Filter from "@/Components/Filter.vue";
import Pagination from "@/Components/Pagination.vue";
import {computed} from "vue";
import {courses} from "@/utils/debounce.js";

const props = defineProps({
  courses: Object,
  errors:Object,
  auth:Object
});
const main_courses = computed(()=>courses.value?.data?.length ? courses.value.data : props.courses.data)
const main_links = computed(()=>courses.value?.data?.length ? courses.value.links : props.courses.links)
</script>


<style scoped>
.courses {
    padding: 0 5% 5%;
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
