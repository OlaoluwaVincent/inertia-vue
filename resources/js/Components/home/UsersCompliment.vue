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
      <aside>
        <v-btn
          color="blue-grey-lighten-1"
          @click="scrollLeft"
          :rounded="false"
          size="small"
          icon="mdi-chevron-left"
        ></v-btn>
        <v-btn
          color="blue-grey-lighten-1"
          class="tw-ms-3"
          @click="scrollRight"
          :rounded="false"
          size="small"
          icon="mdi-chevron-right"
        ></v-btn>
      </aside>
    </div>
    <v-sheet
      id="parent"
      class="sheet__wrapper !tw-py-5"
      color="transparent"
      v-if="data && data.length > 0"
    >
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
    </v-sheet>
  </section>
</template>

<script setup>
import { onMounted, ref, watch } from "vue";
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

function scrollRight() {
  const parent = document.getElementById("parent");
  parent.scrollLeft += 200;
}

function scrollLeft() {
  const parent = document.getElementById("parent");
  parent.scrollLeft -= 200;
}
</script>

<style scoped>
.sheet__wrapper {
  display: flex;
  overflow-x: hidden;
  gap: 20px;
  scroll-behavior: smooth;
}

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
