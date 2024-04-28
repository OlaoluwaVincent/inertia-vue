<script setup>
import { onMounted, ref } from 'vue';

const model = defineModel({
    type: String,
    required: true,
});

const input = ref(null);

onMounted(() => {
    if (input.value.hasAttribute('autofocus')) {
        input.value.focus();
    }
});

defineExpose({ focus: () => input.value.focus(), onChange: "handleChange" });
</script>

<template>
    <input
        class="tw-border-gray-300 focus:tw-border-primary-100 focus:tw-ring-primary-100 tw-shadow-sm tw-rounded-xl tw-w-full"
        v-model="model" ref="input" />
</template>
