<template>
 <h1 class="tw-font-bold tw-capitalize tw-text-sm md:tw-text-base" :class="props.class">{{ props.title }}</h1>
</template>

<script setup>
const props = defineProps({
 title: {
  type: String,
  required: true
 },
 class: String
})
</script>

<style></style>