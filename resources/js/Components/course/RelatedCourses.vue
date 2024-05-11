<template>
  <section class="tw-mt-10" v-if="relatedCourses.length">
    <h5 class="tw-font-semibold tw-mb-5">Courses by the same Author</h5>
    <ScrollX :scrollable="true">
      <CourseCard :data="relatedCourses" size="tw-min-w-[200px]" />
    </ScrollX>
  </section>
</template>

<script setup>
import axios from "axios";
import ScrollX from "../ScrollX.vue";
import CourseCard from "@/Components/CourseCard.vue";
import { onMounted, ref } from "vue";

const props = defineProps({
  instructor_id: Number,
});

const relatedCourses = ref([]);

function getRelatedCourses() {
  axios
    .get("/api/relatedcourses/" + props.instructor_id)
    .then((response) => {
      relatedCourses.value = response.data;
    })
    .catch((error) => {
      console.error("Error fetching items:", error);
    });
}

onMounted(() => {
  getRelatedCourses();
});
</script>
