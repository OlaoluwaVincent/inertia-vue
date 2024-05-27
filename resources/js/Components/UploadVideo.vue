<template>
  <InputLabel value="Attach Videos" />
  <section class="tw-relative tw-border-4 tw-w-full tw-border-dotted">
    <input
      type="file"
      accept="video/*"
      class="tw-hidden"
      id="file"
      @change="handleFileChange"
    />
    <label for="file" class="input">
      <v-icon class="!tw-text-5xl tw-cursor-pointer" color="warning"
        >mdi-plus</v-icon
      >
    </label>
    <div class="tw-relative video__controller">
      <video
        v-if="previewUrl || preview"
        :src="previewUrl || preview"
        controls
        class="tw-h-full tw-w-full"
      />
    </div>

    <InputError :message="videoError" />
  </section>
</template>

<script setup>
import InputError from "@/Components/InputError.vue";
import { ref } from "vue";
import InputLabel from "./InputLabel.vue";

const emits = defineEmits(["getVideoUrl"]);

const props = defineProps({
  videoError: String,
  preview: String,
});

const previewUrl = ref("");

function handleFileChange(e) {
  const [file] = e.target.files;
  previewUrl.value = URL.createObjectURL(file);
  emits("getVideoUrl", file);
}
</script>

<style scoped>
.video__controller {
  height: 300px;
  width: 100%;
  margin-inline: auto;
}

.input {
  content: "";
  position: absolute;
  background: transparent;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  z-index: 100;
}
</style>