<template>
  <v-expansion-panels v-for="lesson in lessons" :key="lesson.id" class="mt-4">
    <v-expansion-panel class="tw-whitespace-pre tw-text-wrap tw-relative">
      <v-expansion-panel-title class="!tw-flex !tw-justify-between !tw-w-full">
        {{ lesson.title }}
      </v-expansion-panel-title>

      <v-expansion-panel-text>
        <div class="tw-my-4 tw-space-x-4">
          <v-btn
            color="warning"
            @click="updateLesson(lesson.course_id, lesson.id)"
            ><v-icon>mdi-pencil</v-icon></v-btn
          >
          <v-btn
            color="error"
            @click="deleteLesson(lesson.course_id, lesson.id)"
            ><v-icon>mdi-delete</v-icon></v-btn
          >
        </div>
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
import { Link, router } from "@inertiajs/vue3";

interface Lesson {
  id: number;
  course_id: number;
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

const deleteLesson = (course_id, lesson_id) => {
  router.delete(
    route("lesson.destroy", { course: course_id, lesson: lesson_id }),
    {
      onSuccess: () => {
        console.log("Successful");
      },
    }
  );
};
const updateLesson = (course_id, lesson_id) => {
  router.get(route("lesson.create", { course: course_id, lesson: lesson_id }));
};
</script>

<style>
</style>