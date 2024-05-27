<template>
  <section class="tw-flex tw-gap-8">
    <Link v-for="link in paths" :key="link" :href="`${link}`">{{ link }}</Link>
  </section>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";
import { ref } from "vue";
const url = window.location.href;

// Extract the path part of the URL
const path = new URL(url).pathname;

// Remove the leading and trailing slashes
const trimmedPath = path.replace(/^\/|\/$/g, "");

// Split the path into an array based on '/'
const pathArray = trimmedPath.split("/");

// Log the array
const paths = ref(pathArray);
</script>

<style scoped>
</style>