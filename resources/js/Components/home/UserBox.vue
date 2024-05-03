<template>
 <v-sheet rounded color="transparent" class="userBox">
  <v-avatar :image="props.user.image" :size="$vuetify.display.mobile ? 40 : 50"></v-avatar>
  <h5 class="tw-text-sm tw-ms-4">{{ props.user.name }}</h5>
 </v-sheet>
</template>

<script setup>
const props = defineProps({
 user: {
  type: Object,
  required: true,
 }
})
</script>

<style scoped>
.userBox {
 display: flex;
 gap: 6px;
 align-items: center;
}
</style>