<template>
  <h1>Hello there</h1>
</template>

<script setup>
const props = defineProps({
  details: Object,
});
console.log(props.details);
</script>

<style scoped>
</style>