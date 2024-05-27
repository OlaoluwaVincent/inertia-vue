<template>
  <section>
    <InputLabel value="Select a Course" />
    <v-select
      v-model="model"
      :items="lists"
      hint="This lesson wil be added to this Course."
      :label="label_title"
      class="tw-mt-4"
    ></v-select>
    <InputError class="tw-mt-2" :message="listError" />
  </section>
</template>

<script setup>
import InputLabel from "@/Components/InputLabel.vue";
import InputError from "@/Components/InputError.vue";
import { computed } from "vue";

const model = defineModel();

const props = defineProps({
  lists: Array,
  listError: String,
  label: String,
});

const label_title = computed(() =>
  props.label ? props.label : "Select Course"
);
</script>

<style>
</style>