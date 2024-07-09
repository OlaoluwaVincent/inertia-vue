import {defineStore} from "pinia";
import {ref} from "vue";
import axios from "axios";

export const useWatchStore = defineStore(
    'watch',
    () => {
        const playing_url = ref('')
        const lesson = ref(null)


        async function playThis(lessonData) {
            playing_url.value = lessonData.video_url;
            lesson.value = lessonData;
            // Update DB with the lesson Data to Monitor Progress
        }

        function isPlaying(url) {
            return url === playing_url.value
        }

        async function updateLessonProgress(duration, status) {
            const response = await axios.post('/api/progress/' + lesson.value.id, {
                ...lesson.value, duration, status
            })
            console.log(response.data)
            return await response.data;
        }

        return {
            playing_url,
            isPlaying,
            playThis,
            updateLessonProgress
        }
    })
