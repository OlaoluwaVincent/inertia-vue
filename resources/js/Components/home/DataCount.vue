<template>
 <v-sheet id="count" color="grey-lighten-3"
  class="!tw-flex !tw-flex-col md:!tw-flex-row !tw-gap-10 !tw-items-center !tw-justify-between content__padding !tw-py-10">
  <v-sheet v-for="(item, key) in items" :key="key" class="tw-flex tw-items-center" color="transparent">
   <h4 class="tw-text-center tw-text-3xl tw-font-bold">{{ item.title }}+</h4>
   <p class="tw-text-center">{{ item.desc }}</p>
  </v-sheet>
 </v-sheet>
</template>

<script setup>
import { defineProps } from 'vue';

const props = defineProps({ data: Object });

const items = [
 { title: props.data.coursesCount, desc: "Courses by our Mentors" },
 { title: props.data.lessonHrs, desc: "Hours of Lessons" },
 { title: props.data.instructorsCount, desc: "Worthy Instructors" }
];
</script>


<style></style>
