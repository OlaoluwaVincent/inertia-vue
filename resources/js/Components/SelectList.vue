<template>
  <section>
    <InputLabel value="Select a Course" />
    <v-select
      v-model="model"
      :items="lists"
      hint="This lesson wil be added to this Course."
      label="Select Course"
      class="tw-mt-4"
    ></v-select>
    <InputError class="tw-mt-2" :message="listError" />
  </section>
</template>

<script setup>
import InputLabel from "@/Components/InputLabel.vue";
import InputError from "@/Components/InputError.vue";

const model = defineModel();

defineProps({
  lists: Array,
  listError: String,
});
</script>

<style>
</style>