<template>
  <v-sheet
    elevated="4"
    rounded
    v-for="review of reviews"
    :key="review.id"
    class="review__sheet !tw-bg-gray-300"
    :class="theme.isDark && '!tw-bg-gray-900'"
  >
    <UserBox size="50" :user="review.user" />
    <aside>
      <div class="rating">
        <v-rating
          v-model="review.rating"
          readonly
          density="compact"
          active-color="orange"
          color="orange-lighten-1"
        ></v-rating>
        <v-icon
          v-if="canDelete"
          class="tw-cursor-pointer hover:tw-text-red-700"
          @click="router.delete(route('review.destroy', { id: review.id }))"
          >mdi-delete</v-icon
        >
      </div>
      <p class="tw-whitespace-pre tw-text-wrap">{{ review.comment }}</p>
      <p class="tw-opacity-80">{{ showDate(review.created_at) }}</p>
    </aside>
  </v-sheet>
</template>

<script setup>
import UserBox from "../UserBox.vue";
import { format } from "date-fns";
import { useThemeStore } from "@/store/theme";
import { router } from "@inertiajs/vue3";

const props = defineProps({
  reviews: Array,
  canDelete: Boolean,
});

const theme = useThemeStore();

function showDate(dateString) {
  const date = new Date(dateString);
  const formattedDate = format(date, "do MMMM',' yyyy");
  return formattedDate;
}
</script>

<style scoped>
.review__sheet {
  display: flex;
  flex-direction: column-reverse;
  align-items: flex-start;
  gap: 12px;
  width: 100%;
  padding: 10px 20px;
}

aside {
  width: 100%;
  display: flex;
  flex-direction: column;
  gap: 8px;
}

.rating {
  display: flex;
  gap: 10px;
  align-items: flex-end;
  justify-content: space-between !important;
}
</style>