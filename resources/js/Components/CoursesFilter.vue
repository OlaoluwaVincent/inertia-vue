<template>
    <v-btn color="primary" variant="text">
        Categories

        <v-menu activator="parent">
            <v-list>
                <v-list-item v-for="(category, i) in actualCategories" :key="i" :title="category.name"
                    :value="category.id" @click="handleCategoryClick(category.id)" class="!tw-text-sm md:!tw-text-base">
                </v-list-item>
            </v-list>
        </v-menu>
    </v-btn>



</template>

<script setup>
import { computed, ref } from 'vue';

const props = defineProps({
    categories: Array
})

const actualCategories = computed(() =>
    props.categories.
        filter((cat) => cat.category_ids !== null && cat.category_ids.length >= 1)
        .sort((a, b) => a.id - b.id))

// Define your reactive data
const open = ref([]);

const handleCategoryClick = (categoryId, price = null) => {
    const currentUrl = window.location.href;
    let url = new URL(currentUrl);
    let newPath = '';

    // If the current path is not the courses route, set it to /courses
    if (!url.pathname.includes('/courses')) {
        newPath = '/courses';
    }

    // If there's already a query string, append the category parameter with '&' separator
    if (url.search) {
        url.search += `&category=${categoryId}`;
    } else {
        // If there's no query string, start a new one with the category parameter
        url.search = `?category=${categoryId}`;
    }

    // Append or set the price parameter if provided
    if (price !== null) {
        if (url.search.includes('price')) {
            url.search += `&price=${price}`;
        } else {
            url.search += `?price=${price}`;
        }
    }

    // Update the URL path if needed
    if (newPath) {
        url.pathname = newPath;
    }

    // Update the browser's location
    window.location.href = url.toString();
}


</script>


<style scoped></style>