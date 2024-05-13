<template>
  <h1>Helo</h1>
</template>

<script setup>
import UserLayout from "@/Layouts/UserLayout.vue";

defineOptions({ layout: UserLayout });

const props = defineProps({
  user: Object,
});
</script>

<style scoped>
</style>
