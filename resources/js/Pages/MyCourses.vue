<template>
  <h1>All my courses</h1>
  <section class="courses">
    <CourseCard :data="courses.data" />
  </section>
</template>

<script setup>
import CourseCard from "@/Components/CourseCard.vue";
const props = defineProps({
  courses: Object,
});
console.log(props.courses);
</script>

<style>
</style>