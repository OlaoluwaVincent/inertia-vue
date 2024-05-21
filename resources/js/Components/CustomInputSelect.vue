<template>
  <div class="form__group">
    <label for="professional_experience" class="form__label">{{ label }}</label>
    <div class="form__input-container">
      <input
        type="text"
        class="form__input"
        @keydown.enter="pressed"
        v-model="model"
      />
    </div>
    <InputError class="mt-2" :message="formError" />

    <v-list v-if="formValue.length" density="compact">
      <v-list-item
        v-for="(item, index) in formValue"
        :key="index"
        density="compact"
      >
        <span class="tw-mr-3 tw-cursor-pointer">
          <v-icon color="error" @click="deleteItem(index)"
            >mdi-delete</v-icon
          ></span
        >
        {{ item }}
      </v-list-item>
    </v-list>
  </div>
</template>

<script setup>
import InputError from "@/Components/InputError.vue";
import { keyPressedAction } from "@/composable/instructorComposable";
import { toRef } from "vue";
const model = defineModel("model");
const props = defineProps({
  label: String,
  formValue: Array,
  formError: String,
});

const emit = defineEmits(["delete"]);

function pressed() {
  keyPressedAction(model, props.formValue);
}

function deleteItem(index) {
  emit("delete", index);
}
</script>

<style scoped>
.form__group {
  display: flex;
  gap: 6px;
  flex-direction: column;
}

.form__label {
  font-size: 18px;
  font-weight: 500;
}

.form__input-container {
  @apply tw-border tw-border-primary-100 tw-rounded-md tw-overflow-hidden;
}

.form__input {
  width: 100%;
}
</style>