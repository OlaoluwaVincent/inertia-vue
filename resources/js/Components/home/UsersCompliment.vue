<template>
  <section
    class="content__padding"
    :class="theme.isDark ? 'tw-bg-inherit' : 'tw-bg-blue-50'"
  >
    <div class="tw-flex tw-justify-between">
      <SectionTitle
        title="What Our Customers Say About Us"
        class="tw-max-w-[220px]"
      />
    </div>

    <ScrollX :controller="true">
      <div
        v-for="(compliment, key) in data"
        :key="key"
        class="tw-p-6 inner__sheet tw-shadow-md"
        :class="theme.isDark ? 'tw-bg-gray-900 tw-text-white' : 'tw-bg-white'"
      >
        <v-icon
          icon="mdi-format-quote-open"
          color="blue-darken-2"
          class="iconSize"
        ></v-icon>
        <p class="tw-text-sm tw-text-justify">
          {{ compliment.comment.slice(0, 100) }}...
        </p>
        <UserBox :user="compliment.user" class="tw-mt-5" />
      </div>
    </ScrollX>
  </section>
</template>

<script setup>
import { onMounted, ref } from "vue";
import ScrollX from "../ScrollX.vue";
import SectionTitle from "./SectionTitle.vue";

import UserBox from "../UserBox.vue";
import axios from "axios";
import { useThemeStore } from "@/store/theme";

const data = ref([]);

const theme = useThemeStore();

async function getCompliments() {
  try {
    const response = await axios.get("/api/compliments");
    data.value = response.data;
  } catch (error) {
    console.error("Error fetching items:", error);
  }
}

onMounted(async () => {
  await getCompliments();
});
</script>

<style scoped>
.inner__sheet {
  border-radius: 20px;
  display: flex;
  flex-shrink: 0;
  flex-direction: column;
  gap: 12px;
  justify-content: space-between;
  width: 80%;
  max-width: 300px;
}

.iconSize {
  font-size: 50px !important;
}
</style>
