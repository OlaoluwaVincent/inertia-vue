<script setup>
import { onMounted, ref } from "vue";

const model = defineModel({
  type: String,
  required: true,
});

const input = ref(null);

onMounted(() => {
  if (input.value.hasAttribute("autofocus")) {
    input.value.focus();
  }
});

defineExpose({ focus: () => input.value.focus(), onChange: "handleChange" });
</script>

<template>
  <input class="input" v-model="model" ref="input" />
</template>

<style scoped>
.input {
  width: 100%;
  border-radius: 20px;
  border: 1px solid teal;
  outline: transparent;
  color: #222 !important;
}

.input:focus {
  outline: none !important;
  box-shadow: none !important;
}
</style>