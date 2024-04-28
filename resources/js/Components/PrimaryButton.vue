<script setup>
const props = defineProps({
    disabled: Boolean,
    block: Boolean
})
</script>

<template>
    <VBtn type="submit" class="tw-ms-4" color="teal-darken-1" tile variant="elevated" :block="props.block || false"
        :disabled="props.disabled" slim>
        <slot />
    </VBtn>
</template>
