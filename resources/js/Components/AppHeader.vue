<template><v-app-bar color="primary" prominent>
    <v-app-bar-nav-icon variant="text" @click.stop="drawer = !drawer"></v-app-bar-nav-icon>

    <v-toolbar-title>My files</v-toolbar-title>

    <v-spacer></v-spacer>

    <template v-if="$vuetify.display.mdAndUp">
      <v-btn icon="mdi-magnify" variant="text"></v-btn>

      <v-btn icon="mdi-filter" variant="text"></v-btn>
    </template>

    <v-btn icon="mdi-dots-vertical" variant="text"></v-btn>
  </v-app-bar>

  <AppSidebar v-model="drawer" />

</template>

<script setup>
import AppSidebar from '@/Components/AppSidebar.vue'
import { ref, watch } from 'vue';

const drawer = ref(false);
const group = ref(null);


watch(group, () => {
  drawer.value = false;
});
</script>
