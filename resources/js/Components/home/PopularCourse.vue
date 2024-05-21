<template>
  <section class="content__padding">
    <div class="tw-flex tw-justify-between tw-items-end">
      <SectionTitle title="Popular Courses" />
      <Link :href="route('course.show')" class="tw-underline">View All</Link>
    </div>

    <ScrollX v-if="data && data.length" scrollable>
      <CourseCard :data="data" />
    </ScrollX>
  </section>
</template>

<script setup>
import { onMounted, ref } from "vue";
import { Link } from "@inertiajs/vue3";
import axios from "axios";
import SectionTitle from "./SectionTitle.vue";
import CourseCard from "@/Components/CourseCard.vue";
import ScrollX from "../ScrollX.vue";

const data = ref([]);

function getPopularCourses() {
  axios
    .get("/api/popular/courses")
    .then((response) => {
      const items = response.data;
      data.value = items.splice(0, 4);
    })
    .catch((error) => {
      console.error("Error fetching items:", error);
    });
}

onMounted(() => {
  getPopularCourses();
});
</script>
