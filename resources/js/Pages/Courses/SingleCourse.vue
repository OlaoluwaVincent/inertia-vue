<template>
    <section class="tw-pb-20 tw-relative content__padding" :class="theme.isDark ? 'tw-bg-gray-800' : 'tw-bg-gray-50'">
        <div class="tw-relative">

            <CourseBanner :course="props.course" />
            <CourseBannerCard :image="props.course.image" :price="props.course.price" :id="props.course.id" />
        </div>
    </section>
</template>

<script setup>
import CourseBanner from '@/Components/course/CourseBanner.vue';
import CourseBannerCard from '@/Components/course/CourseBannerCard.vue';
import { useThemeStore } from '@/store/theme';

const theme = useThemeStore()
const props = defineProps({
    course: Object
})


console.log(props.course)
</script>
