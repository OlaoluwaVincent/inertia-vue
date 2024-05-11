<template>
  <aside v-if="controller" class="tw-flex tw-justify-end">
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

  <v-sheet
    id="parent"
    class="sheet__wrapper !tw-py-5 tw-overflow-x-hidden"
    :class="scrollable && 'tw-overflow-x-scroll'"
    color="transparent"
  >
    <slot />
  </v-sheet>
</template>

<script setup>
const props = defineProps({
  controller: Boolean,
  scrollable: Boolean,
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
  gap: 20px;
  scroll-behavior: smooth;
}

.sheet__wrapper::-webkit-scrollbar {
  width: 6px;
  height: 6px;
}

.sheet__wrapper::-webkit-scrollbar-thumb {
  @apply tw-bg-slate-200;
}

.sheet__wrapper {
  scrollbar-width: thin;
}

.sheet__wrapper::-webkit-scrollbar-thumb {
  @apply tw-bg-slate-200;
}
</style>
