<template>
  <Head :title="course.title" />
  <section
    class="tw-mb-10 tw-relative content__padding tw-min-h-[90svh]"
    :class="theme.isDark ? 'tw-bg-gray-800' : 'tw-bg-gray-50'"
  >
    <div class="tw-relative">
      <CourseBanner :course="course" />
      <CourseBannerCard :isExistInCart="isExistInCart" :course="course" />
    </div>
    <MobileCheckoutButton :course="course" v-model="snackbar" />
    <div class="md:tw-max-w-[55%] lg:tw-max-w-[60%] tw-my-5">
      <LessonCards :lessons="course.lessons" :hasEnrolled="hasEnrolled" />
    </div>
    <div class="tw-py-10 md:tw-py-32" />
    <ReviewForm :id="course.id" />

    <div class="tw-py-10" />
    <RelatedCourses :instructor_id="course.instructor_id" />
  </section>
</template>

<script setup>
import { Head } from "@inertiajs/vue3";
import CourseBanner from "@/Components/course/CourseBanner.vue";
import CourseBannerCard from "@/Components/course/CourseBannerCard.vue";
import MobileCheckoutButton from "@/Components/course/MobileCheckoutButton.vue";
import RelatedCourses from "@/Components/course/RelatedCourses.vue";
import ReviewForm from "@/Components/course/ReviewForm.vue";
import LessonCards from "@/Components/LessonCards.vue";

import { useThemeStore } from "@/store/theme";
import { useCartStore } from "@/store/cart";
import { computed, ref } from "vue";

const cartStore = useCartStore();
const theme = useThemeStore();

const props = defineProps({
  course: Object,
  errors: Object,
  auth: Object,
  hasEnrolled: Boolean,
});

const snackbar = ref(false);
const isExistInCart = computed(() => cartStore.checkExisting(props.course.id));
</script>
