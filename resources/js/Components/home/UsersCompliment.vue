<template>
  <section
    class="content__padding"
    :class="theme.isDark ? 'tw-bg-inherit' : 'tw-bg-blue-50'"
  >
    <SectionTitle
      title="What Our Customers Say About Us"
      class="tw-max-w-[220px]"
    />

    <ScrollX v-if="data && data.length" scrollable controller>
      <ComplimentBox :data="data" />
    </ScrollX>
  </section>
</template>

<script setup>
import { onMounted, ref } from "vue";
import ScrollX from "../ScrollX.vue";
import ComplimentBox from "@/Components/ComplimentBox.vue";
import SectionTitle from "./SectionTitle.vue";

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
