<template>
  <section>
    <v-expansion-panels v-for="lesson in sortedLessons" :key="lesson.id" class="mt-4"
      :class="theme.isDark && '!tw-bg-gray-900 !tw-text-white'">
      <v-expansion-panel class="tw-whitespace-pre tw-text-wrap tw-relative"
        :class="theme.isDark && '!tw-bg-gray-900 !tw-text-white'">
        <v-expansion-panel-title class="!tw-flex !tw-justify-between !tw-w-full">
          {{ lesson.title }}
        </v-expansion-panel-title>

        <v-expansion-panel-text>
          <div class="tw-my-4 tw-space-x-4" v-if="canDelete">
            <v-btn color="warning"
              @click="updateLesson(lesson.course_id, lesson.id)"><v-icon>mdi-pencil</v-icon></v-btn>
            <v-btn color="error" @click="deleteLesson(lesson.course_id, lesson.id)"><v-icon>mdi-delete</v-icon></v-btn>
          </div>
          {{ lesson.description }}
        </v-expansion-panel-text>
      </v-expansion-panel>
    </v-expansion-panels>
  </section>
</template>

<script setup>
import { useThemeStore } from "@/store/theme";
import { router } from "@inertiajs/vue3";
import { computed } from "vue";

const theme = useThemeStore();

const props = defineProps({
  lessons: {
    type: Array,
    required: true,
  },
  canDelete: Boolean,
});

const sortedLessons = computed(() => props.lessons.sort((a, b) => a.id - b.id))

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