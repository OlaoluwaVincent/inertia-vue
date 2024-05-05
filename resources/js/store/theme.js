import { defineStore } from "pinia";
import { watch } from "vue";
import { ref } from "vue";
import { useTheme } from "vuetify";

export const useThemeStore = defineStore(
    "theme",
    () => {
        const theme = useTheme();
        const isDark = ref(false);

        function toggleTheme() {
            if (isDark.value) {
                theme.global.name.value = "dark";
            } else {
                theme.global.name.value = "light";
            }
        }

        // Watch for changes in the isDark variable and toggle theme accordingly
        watch(isDark, () => {
            toggleTheme();
        });

        return { toggleTheme, isDark };
    },
    { persist: true }
);
