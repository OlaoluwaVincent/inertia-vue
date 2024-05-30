<template>
    <section class="tw-space-y-3 md:tw-space-y-6">
        <h3 class="tw-font-bold tw-text-xl tw-mb-3">Instructor</h3>
        <h3 class="tw-text-blue-600 tw-font-semibold tw-text-lg">{{ course.instructor.user.fullname }}</h3>
        <p class="tw-font-light tw-text-center md:tw-text-left"> {{ course.instructor.headline }}</p>

        <div class="tw-flex tw-items-center tw-gap-4">
            <v-avatar size="100" color="teal">
                <img :src="course.instructor.user.profile_picture" :alt="course.instructor.user.fullname">
            </v-avatar>

            <div class="tw-space-y-4">
                <p><v-icon class="tw-mr-2 " size="24"
                        :color="theme.isDark ? 'teal-lighten-4' : 'teal-darken-4'">mdi-seal</v-icon>{{ course.avg_voters
                    }}
                    Reviews</p>
                <p><v-icon class="tw-mr-2 " size="24"
                        :color="theme.isDark ? 'teal-lighten-4' : 'teal-darken-4'">mdi-account-school</v-icon>{{
                            course.students_count }} Registered Student</p>
            </div>
        </div>
        <p class="tw-whitespace-pre tw-text-wrap tw-text-justify">{{ course.instructor.professional_experience }}</p>
    </section>
</template>

<script setup>
import { useThemeStore } from '@/store/theme'
const theme = useThemeStore()
const props = defineProps({
    course: Object
})
</script>

<style scoped></style>