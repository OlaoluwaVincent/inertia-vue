<script setup>
import {ref} from "vue";
import {search} from "@/utils/debounce.js";

const searchQuery = ref('')

</script>
<template>
    <div class="tw-relative">
        <input
            type="text"
            id="search"
            autocomplete="search"
            class="tw-bg-gray-100 tw-w-full tw-ring-0 tw-outline-none tw-block tw-pl-10 tw-text-gray-950"
            placeholder="Search Courses"
            v-model="searchQuery"
            @input="search(searchQuery)"
        />
    </div>
</template>
<style scoped></style>
