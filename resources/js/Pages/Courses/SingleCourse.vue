<template>
  <Head :title="course.title" />
  <section
    class="tw-mb-10 tw-relative content__padding tw-min-h-[90svh]"
    :class="theme.isDark ? 'tw-bg-gray-800' : 'tw-bg-gray-50'"
  >
    <div class="tw-relative">
      <CourseBanner :course="props.course" />
      <CourseBannerCard :isExistInCart="isExistInCart" :course="course" />
    </div>
    <MobileCheckoutButton :course="course" v-model="snackbar" />
    <CourseLessons :lessons="course.lessons" />

    <div class="tw-py-10 md:tw-py-32" />

    <RelatedCourses :instructor_id="course.instructor_id" />
  </section>
</template>

<script setup>
import { Head } from "@inertiajs/vue3";
import CourseBanner from "@/Components/course/CourseBanner.vue";
import CourseBannerCard from "@/Components/course/CourseBannerCard.vue";
import MobileCheckoutButton from "@/Components/course/MobileCheckoutButton.vue";
import RelatedCourses from "@/Components/course/RelatedCourses.vue";
import CourseLessons from "@/Components/course/CourseLessons.vue";

import { useThemeStore } from "@/store/theme";
import { useCartStore } from "@/store/cart";
import { computed, ref } from "vue";

const cartStore = useCartStore();
const theme = useThemeStore();

const props = defineProps({
  course: Object,
});

const snackbar = ref(false);
const isExistInCart = computed(() => cartStore.checkExisting(props.course.id));
</script>
