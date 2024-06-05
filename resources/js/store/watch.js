import {defineStore} from "pinia";
import {ref} from "vue";

export const useWatchStore = defineStore(
    'watch',
    () => {
        const playing_url = ref('')

        function playThis(url) {
            playing_url.value = url;
            console.log(playing_url.value)
        }

        function isPlaying(url) {
            return url === playing_url.value
        }

        return {
            playing_url,
            isPlaying,
            playThis
        }
    })
