<template><v-app-bar class="md:tw-px-10" prominent>
    <v-app-bar-nav-icon variant="text" @click.stop="drawer = !drawer"></v-app-bar-nav-icon>

    <aside id="LOGO" class="flex-row-center tw-gap-10">
      <v-toolbar-title>School</v-toolbar-title>
      <!-- <Link href="#">categories</Link> -->
    </aside>

    <v-spacer></v-spacer>
    <!-- Show on small screen -->

    <template v-if="$vuetify.display.mdAndUp">

      <div
        class="tw-border tw-rounded-xl tw-border-primary-100 tw-overflow-hidden flex-row-center gap-4 relative tw-pl-4 tw-ms-[50px] !tw-w-1/2 tw-mx-auto">
        <label for="search">
          <v-icon>mdi-magnify</v-icon>
        </label>
        <input type="text" id="search" autocomplete="search" class="tw-bg-gray-100 tw-w-full tw-ring-0 tw-outline-none"
          placeholder="Search Courses">
      </div>
    </template>

    <v-spacer></v-spacer>
    <!-- Show on small screen -->
    <template v-if="$vuetify.display.mdAndUp">
      <v-btn icon="mdi-cart" variant="text" class="mx-5"></v-btn>

      <div class="flex-row-center tw-gap-5 mr-5">
        <Link href="/login"> <v-btn variant="outlined" tile color="gray-darken-4" text='Login' to="/login" />
        </Link>
        <Link href="/register"> <v-btn variant="flat" border tile color="grey-darken-4" text='Register'
          to="/register" />
        </Link>
      </div>
    </template>

    <v-btn icon="mdi-dots-vertical" variant="text"></v-btn>
  </v-app-bar>

  <AppSidebar v-model="drawer" />

</template>

<script setup>
import AppSidebar from '@/Components/AppSidebar.vue'
import { Link } from '@inertiajs/vue3';
import { ref, watch } from 'vue';

const drawer = ref(false);
const group = ref(null);


watch(group, () => {
  drawer.value = false;
});
</script>


<style scoped>
.flex-row-center {
  @apply tw-flex tw-items-center tw-justify-center;

}
</style>