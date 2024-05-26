<template>
  <form
    @submit.prevent="updateProfile"
    class="tw-flex tw-flex-col tw-gap-3 tw-justify-center tw-w-fit tw-mx-auto"
  >
    <v-file-input
      id="file"
      v-model="form.image"
      accept="image/*"
      @change="previewImage(form.image)"
      outlined
      required
      prepend-icon="mdi-camera"
      class="d-none"
    ></v-file-input>
    <label for="file" class="tw-mx-auto">
      <v-avatar
        color="surface-variant"
        :size="imgSize || 200"
        icon="mdi-camera"
        :rounded="false"
        :image="previewUrl"
      ></v-avatar>
    </label>
    <InputError class="tw-mt-2" :message="form.errors.image" />
    <v-btn type="submit" color="teal-lighten-1" block :disabled="!previewUrl"
      >Upload</v-btn
    >
  </form>
</template>

<script setup>
import { useForm } from "@inertiajs/vue3";
import InputError from "@/Components/InputError.vue";
import { usePreviewImg } from "@/composable/usePreviewImg";

const props = defineProps({
  imgSize: Number,
});

const { previewImage, previewUrl } = usePreviewImg();

const form = useForm({
  image: null,
});

function updateProfile() {
  form.submit("post", route("profile.update"), {
    onSuccess: () => {
      previewUrl.value = "";
    },
  });
}
</script>

<style>
</style>