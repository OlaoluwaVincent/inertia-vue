<template>
  <VApp :theme="themeStore.isDark ? 'dark' : 'light'">
    <AppHeader />
    <v-main class="tw-mt-4">
      <section id="layout" class="tw-mb-32 content__padding">
        <UserSidebarVue id="dashboard__sidebar" />

        <div id="layout__content">
          <h2
            class="tw-font-semibold tw-text-xl tw-text-gray-800 tw-leading-tight tw-capitalize"
          >
            {{ url }}
          </h2>
          <slot />
        </div>
      </section>
    </v-main>
    <Footer />
  </VApp>
</template>

<script setup>
import UserSidebarVue from "@/Components/profile/UserSidebar.vue";
import AppHeader from "@/Components/AppHeader.vue";
import Footer from "@/Components/Footer.vue";
import { usePage } from "@inertiajs/vue3";
import { computed } from "vue";
import { useThemeStore } from "@/store/theme";
const page = usePage();
const themeStore = useThemeStore();

const url = computed(() => {
  const splitted = page.url.split("/");
  const urlLink = splitted[1];
  return urlLink.split("?")[0];
});
</script>

<style scoped>
#layout {
  display: flex;
  gap: 20px;
}

#layout__content {
  /* background: red; */
  width: 100%;
}
</style>
