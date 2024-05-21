<template>
  <v-sheet rounded color="transparent" class="userBox">
    <v-avatar :image="user.profile_picture" :size="size"></v-avatar>
    <h5 class="tw-text-sm md:tw-text-base tw-text-blue-600 tw-font-semibold">
      <Link
        v-if="user.instructor_id"
        :href="`/details/${user.id}`"
        class="tw-underline"
      >
        {{ user.name || user.username }}</Link
      >
      <p v-else class="tw-font-semibold">
        {{ user.name || user.username }}
      </p>
    </h5>
  </v-sheet>
</template>

<script setup>
import { computed } from "vue";
import { Link } from "@inertiajs/vue3";
import { useDisplay } from "vuetify";
const { mobile } = useDisplay();

const props = defineProps({
  user: {
    type: Object,
    required: true,
  },
  size: {
    type: String,
    required: false,
  },
});

const size = computed(() => {
  if (props.size) {
    return props.size;
  }
  if (mobile) {
    return 30;
  }
  return 50;
});
</script>

<style scoped>
.userBox {
  display: flex;
  gap: 6px;
  align-items: center;
}
</style>