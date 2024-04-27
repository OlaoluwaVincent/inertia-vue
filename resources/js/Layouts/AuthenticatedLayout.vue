<script setup>
import { ref } from 'vue';

const showingNavigationDropdown = ref(false);

</script>

<template>
    <div>

        <main>
            <h1>Auth layout</h1>
            <slot />
        </main>
    </div>
</template>
