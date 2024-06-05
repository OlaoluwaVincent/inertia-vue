<template>
    <div class="tw-min-w-full">
        <video ref="videoPlayer" controls :src="playing_url" @timeupdate="checkProgress" class="tw-w-full"></video>
    </div>
</template>

<script setup>
import {onMounted, ref, watch} from 'vue';
import useVideoMetadata from "@/utils/useVideoMetadata.js";
import {useWatchStore} from "@/store/watch.js";

// The video URL
const watchStore = useWatchStore();
const playing_url = ref(watchStore.playing_url);

// Setup refs
const videoPlayer = ref(null);
const videoMetadata = ref(null);

// Function to check progress
function checkProgress() {
    if (videoMetadata.value && videoPlayer.value) {
        const currentTime = videoPlayer.value.currentTime;
        const duration = videoMetadata.value.duration;
        const ninetyPercent = duration * 0.9;

        if (currentTime >= ninetyPercent) {
            // TODO
            //Update the db with is completed

        }
    }
}


// Watch for changes in playing_url and fetch new video metadata
watch(() => watchStore.playing_url, async (newUrl) => {
    playing_url.value = newUrl;
    try {
        videoMetadata.value = await useVideoMetadata(newUrl);
        if (videoPlayer.value) {
            videoPlayer.value.load(); // Reload the video element
        }
    } catch (error) {
        console.error('Error fetching video metadata:', error);
    }
});

// Fetch video metadata on mounted
onMounted(async () => {
    try {
        videoMetadata.value = await useVideoMetadata(watchStore.playing_url);
    } catch (error) {
        console.error('Error fetching video metadata:', error);
    }
});
</script>

<style scoped>
/* Add your styles here */
</style>
