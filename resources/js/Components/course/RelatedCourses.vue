<template>
  <section class="tw-mt-10" v-if="relatedCourses.length">
    <h5 class="tw-font-semibold tw-mb-5">Courses by the same Author</h5>
    <section class="courses">
      <CourseCard :data="relatedCourses" />
    </section>
  </section>
</template>

<script setup>
import axios from "axios";
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