<template></template>

<script setup>
import UserLayout from "@/Layouts/UserLayout.vue";

defineOptions({ layout: UserLayout });

const props = defineProps({
  auth: Object,
  errors: Object,
  isOnboard: Boolean,
});

console.log(props.isOnboard);
</script>

<style scoped>
</style>
