<template>
  <v-snackbar v-model="snackbar" :timeout="2000" color="primary">
    <slot> Added to Cart </slot>

    <template v-slot:actions>
      <v-btn color="warning" variant="text" @click="snackbar = false">
        Close
      </v-btn>
    </template>
  </v-snackbar>
</template>

<script setup>
const snackbar = defineModel("snackbar");
</script>
