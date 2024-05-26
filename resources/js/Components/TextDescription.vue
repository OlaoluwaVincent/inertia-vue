<template>
  <section>
    <InputLabel value="Description" class="tw-mb-3" />
    <div class="tw-border !tw-border-teal-700">
      <textarea
        id="description"
        class="!tw-m-0 tw-outline-0 focus:tw-outline-0 tw-min-h-fit tw-h-[150px] tw-bg-white tw-w-full"
        :class="theme.isDark && '!tw-bg-gray-700'"
        v-model="model"
      />
    </div>
    <InputError class="mt-2" :message="descriptionError" />
  </section>
</template>

<script setup>
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import { useThemeStore } from "@/store/theme";

const theme = useThemeStore();
const model = defineModel("description");
defineProps({
  descriptionError: undefined,
});
</script>

<style>
</style>