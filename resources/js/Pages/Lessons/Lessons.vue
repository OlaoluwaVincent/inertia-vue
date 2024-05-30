<template>
  <section class="content__padding">
    <Link :href="route('lesson.create', { course: course.id })">
      <v-btn color="success" prepend-icon="mdi-plus">Add New Lesson</v-btn>
    </Link>
    <h1 class="text-center tw-font-bold tw-text-lg tw-my-4">
      {{ course.title }}
    </h1>

    <LessonCards :lessons="lessons" canDelete />
  </section>

  <p v-if="!lessons.length">You have not added any lessons to this course</p>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";
import UserLayout from "@/Layouts/UserLayout.vue";
import LessonCards from "@/Components/LessonCards.vue";
defineOptions({ layout: UserLayout });

const props = defineProps({
  lessons: Array,
  course: Object,
});
</script>


<style scoped>
.box {
  box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px,
    rgba(60, 64, 67, 0.15) 0px 1px 3px 1px;
}
</style>