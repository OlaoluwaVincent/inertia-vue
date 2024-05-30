<template>
    <section class="tw-space-y-8">
        <div class="tw-whitespace-pre tw-text-wrap">{{ course.description }}</div>


        <div>
            <h4>Pre-requisite</h4>
            <ol>
                <li v-for="(requirement, index) in course.requirement" :key="index" class="tw-flex tw-gap-3">
                    <span class="tw-font-semibold">{{ index + 1 + ' :' }}</span>
                    <p class="first-letter:tw-capitalize">{{ requirement }}</p>
                </li>
            </ol>
        </div>
        <div>
            <h4>Obectives</h4>
            <ol>
                <li v-for="(objective, index) in course.objective" :key="index" class="tw-flex tw-gap-3">
                    <span class="tw-font-semibold">{{ index + 1 + ' :' }}</span>
                    <p class="first-letter:tw-capitalize">{{ objective }}</p>
                </li>
            </ol>
        </div>

    </section>
</template>

<script setup>
const props = defineProps({
    course: Object,
})
</script>

<style scoped></style>