<template>
  <div class="tw-mb-20">
    <div class="pagination">
      <Link
        v-for="(link, index) in props.links"
        :key="index"
        :class="{ active: link.active }"
        :href="link.url ?? ''"
        class="page-link"
      >
        {{ link.url !== null ? stripSymbols(link.label) : "" }}
      </Link>
    </div>
  </div>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";
import { computed } from "vue";
const props = defineProps({
  links: {
    type: Array,
  },
});

const stripSymbols = (label) => {
  // Remove HTML entities and symbols from the label
  return label.replace(/&[^\s;]+;|[^a-zA-Z0-9\s]/g, "");
};
</script>

<style scoped>
.pagination {
  /* background: coral; */
  display: flex;
  justify-content: center;
  align-items: center;
  gap: 20px;
  padding: 0;
  margin: 0 auto;
}

.page-link {
  display: block;
  text-align: center;
}

.pagination .active {
  @apply tw-bg-blue-600 tw-text-white;
  display: flex;
  align-items: center;
  justify-content: center;
  pointer-events: none;
  height: 40px;
  width: 40px;
}
</style>
