<template>
  <form
    @submit.prevent="updateProfile"
    class="tw-flex tw-flex-col tw-gap-3 tw-justify-center tw-w-fit tw-mx-auto"
  >
    <v-file-input
      id="file"
      v-model="form.image"
      accept="image/*"
      @change="previewImage"
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
import { useForm, usePage } from "@inertiajs/vue3";
import { ref } from "vue";
import InputError from "@/Components/InputError.vue";

const props = defineProps({
  imgSize: Number,
});

const user = usePage().props.auth.user;

const previewUrl = ref("");

const form = useForm({
  image: null,
});

function previewImage() {
  if (form.image !== null) {
    const reader = new FileReader();
    reader.onload = (event) => {
      previewUrl.value = event.target.result;
    };

    reader.readAsDataURL(form.image);
  }
}

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