<script setup>
import { useThemeStore } from "@/store/theme";

defineProps({
  value: {
    type: String,
  },
});

const theme = useThemeStore();
</script>

<template>
  <label
    class="tw-block tw-font-medium tw-text-sm tw-text-gray-700"
    :class="theme.isDark && '!tw-text-white'"
    :for="value"
  >
    <span v-if="value">{{ value }}</span>
    <span v-else>
      <slot />
    </span>
  </label>
</template>
