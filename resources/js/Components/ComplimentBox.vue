<template>
  <div
    v-for="compliment in data"
    :key="compliment.id"
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
</template>

<script setup>
import { useThemeStore } from "@/store/theme";
import UserBox from "@/Components/UserBox.vue";

const theme = useThemeStore();
const props = defineProps({
  data: Array,
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