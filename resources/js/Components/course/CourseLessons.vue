<template>
  <section
    id="lessons"
    class="md:tw-max-w-[55%] lg:tw-max-w-[60%] tw-my-5"
    v-if="lessons.length"
  >
    <h5 class="tw-font-bold tw-mb-4">Lessons in this course</h5>

    <div>
      <v-expansion-panels v-for="lesson in lessonsArray" :key="lesson.id">
        <v-expansion-panel
          class="tw-whitespace-pre tw-text-wrap"
          :title="lesson.title"
          :text="lesson.description"
        >
        </v-expansion-panel>
      </v-expansion-panels>
    </div>
  </section>
</template>

<script setup>
import { computed } from "vue";

const props = defineProps({
  lessons: Array,
});

const lessonsArray = computed(() => props.lessons.sort((a, b) => a.id - b.id));
</script>

<style></style>