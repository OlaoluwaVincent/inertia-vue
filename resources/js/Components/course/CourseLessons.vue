<template>
  <section
    id="lessons"
    class="md:tw-max-w-[55%] lg:tw-max-w-[60%] tw-my-5"
    v-if="lessons.length"
  >
    <h5 class="tw-font-bold tw-mb-4">Lessons in this course</h5>

    <div>
      <v-expansion-panels v-for="lesson in lessons" :key="lesson.id">
        <v-expansion-panel :title="lesson.title" :text="lesson.description">
        </v-expansion-panel>
      </v-expansion-panels>
    </div>
  </section>
</template>

<script setup>
const props = defineProps({
  lessons: Array,
});
</script>

<style></style>