<template>
 <h1>Hello</h1>
</template>

<script setup>
import axios from 'axios';
import { computed, onMounted, ref, watch } from 'vue';
const data = ref([])

onMounted(() => {
 axios.get('/api/instructors').then(response => {
  const items = response.data
  data.value = items;
 }).catch(error => {
  console.error('Error fetching items:', error)
 })
})

watch(data, () => {
 data.value = data.value.sort((a, b) => a.instructor_courses.length - b.instructor_courses.length)
 return;
})
</script>

<style></style>