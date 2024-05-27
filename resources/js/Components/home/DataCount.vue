<template>
  <v-sheet
    id="count"
    class="!tw-bg-gray-200 !tw-flex !tw-flex-col md:!tw-flex-row !tw-gap-10 !tw-items-center !tw-justify-between content__padding !tw-py-10"
    :class="theme.isDark && '!tw-bg-gray-900'"
  >
    <v-sheet
      v-for="(item, key) in items"
      :key="key"
      class="tw-flex tw-items-center"
      color="transparent"
    >
      <h4 class="tw-text-center tw-text-3xl tw-font-bold">{{ item.title }}+</h4>
      <p class="tw-text-center">{{ item.desc }}</p>
    </v-sheet>
  </v-sheet>
</template>


<script setup>
import { onMounted, ref } from "vue";

import axios from "axios";
import { useThemeStore } from "@/store/theme";

const theme = useThemeStore();
const props = defineProps({ data: Object });
const coursesCount = ref(0);
const lessonHrs = ref(0);
const instructorsCount = ref(0);

const items = [
  { title: ref(0), desc: "Courses by our Mentors" },
  { title: ref(0), desc: "Hours of Lessons" },
  { title: ref(0), desc: "Worthy Instructors" },
];

function getCounts() {
  axios
    .get("/api/coursescount")
    .then((response) => {
      const data = response.data;
      coursesCount.value = data.coursesNum;
      lessonHrs.value = Number((data.lessonHrs / 3600).toFixed(2));
      updateItems();
    })
    .catch((error) => {
      console.error("Error fetching items:", error);
    });
}
function getInstructorsCount() {
  axios
    .get("/api/instructorsCount")
    .then((response) => {
      instructorsCount.value = response.data;
      updateItems();
    })
    .catch((error) => {
      console.error("Error fetching items:", error);
    });
}

function updateItems() {
  items[0].title.value = coursesCount.value;
  items[1].title.value = lessonHrs.value;
  items[2].title.value = instructorsCount.value;
}

onMounted(() => {
  getCounts();
  getInstructorsCount();
});
</script>



<style></style>
