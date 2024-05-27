<template>
  <v-menu color="warning">
    <template v-slot:activator="{ props }">
      <v-btn
        color="warning"
        v-bind="props"
        icon="mdi-dots-vertical"
        class="tw-pl-5"
      >
      </v-btn>
    </template>
    <v-list>
      <v-list-item
        v-for="(item, index) in authItems"
        :key="index"
        :value="index"
      >
        <v-list-item-title>
          <Link
            :href="`${route(item.route, { course: id })}`"
            :method="item.method"
            as="button"
            class="tw-capitalize"
          >
            {{ item.title }}</Link
          >
        </v-list-item-title>
      </v-list-item>
    </v-list>
  </v-menu>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";
const props = defineProps({
  id: Number,
});
const authItems = [
  { title: "Delete", route: "userCourse.delete", method: "delete" },
  { title: "Edit", route: "userCourse.show", method: "get" },
  { title: "Lessons", route: "lesson.index", method: "get" },
];
</script>
