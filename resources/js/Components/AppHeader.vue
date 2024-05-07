<template><v-app-bar class="md:tw-px-10 tw-py-2" density='comfortable'>
    <v-app-bar-nav-icon variant="text" @click.stop="drawer = !drawer"></v-app-bar-nav-icon>

    <aside id="LOGO" class="flex-row-center tw-gap-10">
      <v-toolbar-title>
        <Link href="/">School</Link>
      </v-toolbar-title>

      <aside class="filter">
        <CoursesFilter />
      </aside>
    </aside>

    <v-spacer></v-spacer>
    <!-- Show on small screen -->

    <AppSearchHeader :isAuth="isAuth" />

    <v-spacer></v-spacer>
    <!-- Show on small screen -->
    <aside v-if="!$vuetify.display.xs">
      <aside class="mx-5 tw-flex">
        <v-btn v-if="isAuth" icon="mdi-heart-outline" variant="text"></v-btn>
        <v-btn v-if="isAuth" icon="mdi-bell" variant="text" color="orange-darken-2"></v-btn>
        <v-btn icon="mdi-cart" variant="text"></v-btn>
        <v-switch v-model="themeStore.isDark" color="primary" hide-details inset></v-switch>
      </aside>

    </aside>
    <AppHeaderAuthBtn v-if="$vuetify.display.mdAndUp" :isAuth="isAuth" />

    <v-avatar v-if="isAuth" :image="`https://via.placeholder.com/640x480.png/001155?text=${user?.email}`"
      class="tw-mx-3"></v-avatar>
    <AppMenuDots v-if="isAuth" />
  </v-app-bar>

  <AppSidebar v-model="drawer" />

</template>

<script setup>
import AppSidebar from '@/Components/AppSidebar.vue'
import AppMenuDots from '@/Components/AppMenuDots.vue'
import AppHeaderAuthBtn from '@/Components/AppHeaderAuthBtn.vue'
import AppSearchHeader from '@/Components/AppSearchHeader.vue'
import CoursesFilter from '@/Components/CoursesFilter.vue'
import { Link, usePage } from '@inertiajs/vue3';
import { computed, ref, watch } from 'vue';
import { useThemeStore } from '@/store/theme';

const themeStore = useThemeStore()

const userData = usePage()
const isAuth = computed(() => userData.props?.auth?.user?.id ? true : false)
const user = computed(() => userData.props.auth.user ?? null)

const drawer = ref(false);
const group = ref(null);


const props = defineProps({
  courses: Object,
  categories: Array,
})


watch(group, () => {
  drawer.value = false;
});
</script>


<style scoped>
.flex-row-center {
  @apply tw-flex tw-items-center tw-justify-center;

}
</style>