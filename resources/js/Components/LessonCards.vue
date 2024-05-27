<template>
  <v-expansion-panels v-for="lesson in lessons" :key="lesson.id" class="mt-4">
    <v-expansion-panel class="tw-whitespace-pre tw-text-wrap tw-relative">
      <v-expansion-panel-title class="!tw-flex !tw-justify-between !tw-w-full">
        {{ lesson.title }}
      </v-expansion-panel-title>

      <v-expansion-panel-text>
        {{ lesson.description }}
        <video
          :src="lesson.video_url"
          controls
          class="tw-aspect-video tw-border tw-my-2 tw-max-h-[400px] tw-w-full"
        />
      </v-expansion-panel-text>
    </v-expansion-panel>
  </v-expansion-panels>
</template>

<script setup lang="ts">
import { PropType } from "vue";

interface Lesson {
  id: number;
  title: string;
  description: string;
  video_url: string;
}
[];
const props = defineProps({
  lessons: {
    type: Array as PropType<Lesson[]>,
    required: true,
  },
});
</script>

<style>
</style>