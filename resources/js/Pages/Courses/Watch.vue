<script setup>

import LessonCards from "@/Components/LessonCards.vue";
import WatchVideoBox from "@/Components/WatchVideoBox.vue";
import WatchVideoLesson from "@/Components/WatchVideoLesson.vue";
import useVideoMetadata from "@/utils/useVideoMetadata.js";
import {onMounted, ref} from "vue";

const props = defineProps({
    course: Object,
    errors: Object,
    auth: Object,
})

const metadata = ref()
onMounted(async () => {
    metadata.value = await useVideoMetadata();
});
</script>

<template>
    <section class="content__padding tw-flex tw-flex-col sm:tw-flex-row tw-justify-between tw-gap-5">
        <div class="sm:tw-w-[60%] lg:tw-w-3/4">
            <WatchVideoBox/>
        </div>
        <div class="sm:tw-w-[40%] lg:tw-w-1/4 flex-shrink-0">
            <WatchVideoLesson :lessons="course.lessons"/>
        </div>
    </section>
</template>

<style scoped>

</style>
