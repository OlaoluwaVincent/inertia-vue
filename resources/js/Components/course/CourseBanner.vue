<template>
  <section class="md:tw-max-w-[60%]">
    <h1 class="md:tw-text-3xl xl:tw-text-5xl tw-font-extrabold">
      {{ course.title }}
    </h1>
    <p class="tw-mt-4 md:tw-mt-8 tw-text-sm md:tw-text-base">
      {{ course.description }}
    </p>

    <div class="tw-pt-5 tw-flex tw-gap-20 tw-items-center">
      <span
        class="tw-flex tw-items-center gap-3 flex-1 tw-border-r tw-pr-20"
        :class="theme.isDark ? 'tw-border-slate-100' : 'tw-border-gray-800'"
      >
        <v-rating
          :model-value="4.5"
          color="amber"
          density="compact"
          size="small"
          half-increments
          readonly
        />

        <div class="tw-text-grey-400 tw-hidden md:tw-block">4.5 (413)</div>
      </span>

      <p>{{ course.duration }}hrs</p>
    </div>

    <UserBox :user="user" class="mt-8" />
  </section>
</template>

<script setup>
import { computed } from "vue";
import UserBox from "../UserBox.vue";
import { useThemeStore } from "@/store/theme";

const theme = useThemeStore();

const props = defineProps({
  course: Object,
});

const user = computed(() => props.course.instructor.user);
const course = computed(() => props.course);
</script>

<style scoped></style>