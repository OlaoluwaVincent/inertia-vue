<template>
  <section class="content__padding">
    <div class="tw-flex tw-justify-between tw-items-end">
      <SectionTitle title="Popular Courses" />
      <Link :href="route('course.show')" class="tw-underline">View All</Link>
    </div>

    <ScrollX v-if="data && data.length" :scrollable="true">
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

<style scoped>
.sheet__wrapper {
  width: 100%;
  display: grid;
  grid-template-columns: 1fr;
  /* grid-template-columns: repeat(2, 1fr); */
  gap: 16px;
  justify-items: center;
}

.img__height {
  height: 180px;
}

@media (width>430px) {
  .sheet__wrapper {
    grid-template-columns: repeat(2, 1fr);
    padding: 5%;
    gap: 3%;
  }

  .img__height {
    height: 200px;
  }
}

@media (width>=768px) {
  .sheet__wrapper {
    grid-template-columns: repeat(3, 1fr);
    padding: 0;
  }

  .img__height {
    height: 200px;
  }

  .v__card-popular:last-child {
    display: none;
  }
}

@media (width>=1024px) {
  .sheet__wrapper {
    grid-template-columns: repeat(4, 1fr);
  }

  .v__card-popular:last-child {
    display: block;
  }
}
</style>