<template>
  <section class="content__padding" :class="bg ? 'tw-bg-inherit' : 'tw-bg-blue-50'">
    <div class="tw-flex tw-justify-between">
      <SectionTitle title="What Our Customers Say About Us" class="tw-max-w-[220px]" />
      <aside>
        <v-btn color="blue-grey-lighten-1" @click="scrollLeft" :rounded="false" size="small"
          icon="mdi-chevron-left"></v-btn>
        <v-btn color="blue-grey-lighten-1" class="tw-ms-3 " @click="scrollRight" :rounded="false" size="small"
          icon="mdi-chevron-right"></v-btn>
      </aside>
    </div>
    <v-sheet id="parent" class="sheet__wrapper !tw-py-5" color="transparent" v-if="data && data.length > 0">
      <div v-for="(compliment, key) in data" :key="key" class="tw-p-6 inner__sheet tw-shadow-md"
        :class="bg ? 'tw-bg-gray-900 tw-text-white' : 'tw-bg-white'">
        <v-icon icon="mdi-format-quote-open" color="blue-darken-2" class="iconSize"></v-icon>
        <p class="tw-text-sm tw-text-justify">{{ compliment.comment.slice(0, 100) }}...</p>
        <UserBox :user="compliment.user" class="tw-mt-5" />
      </div>
    </v-sheet>
  </section>4
</template>

<script setup>
import { onMounted, ref, watch } from 'vue';
import SectionTitle from './SectionTitle.vue'
import UserBox from './UserBox.vue'
import axios from 'axios';
import { useTheme } from 'vuetify';

const data = ref([])
const bg = ref(false)

const theme = useTheme().global.name
watch(theme, (newVal) => {
  updateTheme(newVal);
});

const updateTheme = (newTheme) => {
  if (newTheme == 'dark') {
    bg.value = true;
    bg.value = 'tw-bg-gray-700'
  } else {
    bg.value = false;
  }
};

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
  const parent = document.getElementById('parent');
  parent.scrollLeft += 200;
}

function scrollLeft() {
  const parent = document.getElementById('parent');
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
  transition: all 200ms ease-in-out;
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
