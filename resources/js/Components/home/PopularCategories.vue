<template>
  <section class="content__padding">
    <SectionTitle title="Popular Categories" />
    <v-sheet class="sheet__wrapper tw-py-5" color="transparent">
      <v-sheet
        v-for="(category, key) in categories"
        :key="key"
        :elevation="4"
        rounded
        class="sheet__flex-col tw-p-3 tw-py-5 md:tw-py-10 tw-w-auto tw-gap-7"
        :class="theme.isDark && '!tw-bg-gray-900'"
      >
        <div
          class="tw-bg-blue-400/20 tw-rounded-full tw-block tw-p-3 tw-bg-blend-screen"
        >
          <v-icon
            :icon="`mdi-${category.icon_name}`"
            variant="tonal"
            color="blue"
            class="btn__icon"
          >
          </v-icon>
        </div>
        <h4
          class="tw-font-semibold tw-text-xs sm:tw-text-md md:tw-text-lg tw-text-center tw-text-wrap"
        >
          {{ category.name }}
        </h4>
        <p class="tw-text-base tw-text-gray-500">
          {{ category.courses_count }}
        </p>
      </v-sheet>
    </v-sheet>
  </section>
</template>

<script setup>
import { onMounted, ref } from "vue";
import SectionTitle from "./SectionTitle.vue";
import { useThemeStore } from "@/store/theme";

const theme = useThemeStore();

const categories = ref([]);

async function getPopularCategories() {
  try {
    const res = await axios.get("/api/categories");
    categories.value = res.data.slice(0, 4);
  } catch (error) {
    return error.stack;
  }
}

onMounted(async () => {
  await getPopularCategories();
});
</script>

<style scoped>
.btn__icon {
  font-size: 24px;
}

.sheet__flex-col {
  display: flex;
  justify-content: space-evenly;
  align-items: center;
  flex-direction: column;
  width: 100%;
}

.sheet__wrapper {
  width: 100%;
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  gap: 16px;
  justify-items: center;
}

@media (width>540px) {
  .sheet__wrapper {
    grid-template-columns: repeat(3, 1fr);
  }

  .sheet__flex-col:last-child {
    display: none;
  }

  .btn__icon {
    font-size: 24px;
  }
}

@media (width>=1024px) {
  .sheet__wrapper {
    grid-template-columns: repeat(4, 1fr);
  }

  .btn__icon {
    font-size: 60px;
  }

  .sheet__flex-col:last-child {
    display: flex;
  }
}
</style>