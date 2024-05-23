<template>
  <v-menu>
    <template v-slot:activator="{ props }">
      <v-btn
        color="primary"
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
        <Link
          :href="route(item.route)"
          :method="item.method"
          as="button"
          class="tw-capitalize"
        >
          {{ item.title }}</Link
        >
      </v-list-item>
    </v-list>
  </v-menu>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";
const authItems = [
  { title: "profile", route: "profile.edit", method: "get" },
  { title: "logout", route: "logout", method: "post" },
];
</script>
