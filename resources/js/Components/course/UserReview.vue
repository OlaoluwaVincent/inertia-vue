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
        <p>{{ showDate(review.created_at) }}</p>
      </div>
      <p>{{ review.comment }}</p>
    </aside>
  </v-sheet>
</template>

<script setup>
import UserBox from "../UserBox.vue";
import { format } from "date-fns";
import { useThemeStore } from "@/store/theme";

const props = defineProps({
  reviews: Array,
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