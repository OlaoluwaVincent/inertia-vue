<template>
    <section v-if="lessons.length" class="tw-shadow-md tw-shadow-gray-400">
        <v-list class="pa-0">
            <v-list-item
                v-for="lesson in lessons"
                :key="lesson.id"
                :class="isPlaying(lesson.video_url) && '!tw-bg-gray-900 !tw-text-slate-100'"
                @click="playThis(lesson.video_url)">
                <template #prepend>
                    <VIcon :color="isCompleted ? 'teal' : 'red'" size="30"
                           :icon="isCompleted ? 'mdi-checkbox-marked' : 'mdi-checkbox-blank-outline'"/>
                </template>
                {{ lesson.title }}

                <template #append>
                    <VIcon color="teal" size="30" icon="mdi-video"/>
                    <span>{{
                            videoLengths[lesson.id] !== undefined ? videoLengths[lesson.id].toFixed(0) + ' min' : 'Loading...'
                        }}</span>
                </template>
            </v-list-item>
        </v-list>
    </section>
</template>

<script setup>
import {onMounted, ref, watch} from 'vue';
import {fetchVideoLengths} from '@/utils/useVideoMetadata.js';
import {useWatchStore} from "@/store/watch.js";

const {playThis, isPlaying} = useWatchStore()

const props = defineProps({
    lessons: {
        type: Array,
        required: true,
    },
    isCompleted: Boolean,
});

const videoLengths = ref({});

onMounted(async () => {
    videoLengths.value = await fetchVideoLengths(props.lessons);
});

watch(() => props.lessons, fetchVideoLengths, {immediate: true});
</script>

<style scoped>
/* Add your styles here */
</style>
