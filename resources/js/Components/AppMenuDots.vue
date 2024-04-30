<template>
 <v-menu>
  <template v-slot:activator="{ props }">
   <v-btn color="primary" v-bind="props" icon="mdi-dots-vertical" class="tw-pl-5">
   </v-btn>
  </template>
  <v-list>
   <v-list-item v-for="(item, index) in authItems" :key="index" :value="index">
    <v-list-item-title>
     <Link :href="route(item.route)" :method="item.method" as="button"
      class="tw-text-sm hover:tw-text-gray-900 tw-rounded-md focus:tw-outline-none focus:tw-ring-2 focus:tw-ring-offset-2 focus:tw-ring-blue-500 tw-capitalize">
     {{ item.title }}</Link>
    </v-list-item-title>
   </v-list-item>
  </v-list>
 </v-menu>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
const authItems = [
 { title: 'profile', route: "profile.edit", method: 'get' },
 { title: 'logout', route: "logout", method: 'post' },
];

</script>
