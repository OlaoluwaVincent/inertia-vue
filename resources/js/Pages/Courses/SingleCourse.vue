<template>

  <Head :title="course.title" />
  <section class="tw-relative content__padding tw-min-h-[90svh]"
    :class="theme.isDark ? 'tw-bg-gray-800' : 'tw-bg-gray-50'">
    <div class="tw-relative">
      <CourseBanner :course="course" />
      <CourseBannerCard v-if="!hasEnrolled" :isExistInCart="isExistInCart" :course="course" />
    </div>
    <MobileCheckoutButton v-if="!hasEnrolled" :course="course" v-model="snackbar" />

    <div class="tw-py-10 md:tw-py-32" :class="hasEnrolled && '!tw-py-10'" />

    <DescriptionTabs :tabs="tabs" @tab-title="handleTabUpdate">

      <template v-slot:lessons>
        <LessonCards :lessons="course.lessons" />
      </template>
      <template v-slot:reviews>
        <ReviewForm :id="course.id" />
      </template>
      <template v-slot:description>
        <CourseDescription :course="course" />
      </template>
      <template v-slot:instructor>
        <InstructorDetail :course="course" />
      </template>
    </DescriptionTabs>

    <div class="tw-py-10" />
    <RelatedCourses :instructor_id="course.instructor_id" />
  </section>
</template>

<script setup>
import { Head } from "@inertiajs/vue3";
import CourseBanner from "@/Components/course/CourseBanner.vue";
import CourseDescription from "@/Components/course/CourseDescription.vue";
import InstructorDetail from "@/Components/course/InstructorDetail.vue";
import CourseBannerCard from "@/Components/course/CourseBannerCard.vue";
import MobileCheckoutButton from "@/Components/course/MobileCheckoutButton.vue";
import RelatedCourses from "@/Components/course/RelatedCourses.vue";
import DescriptionTabs from "@/Components/course/DescriptionTabs.vue";
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
const tabs = ref(['description', 'instructor', 'lessons', 'reviews'])
const selectedTab = ref(tabs.value[0]);

const handleTabUpdate = (newTab) => {
  selectedTab.value = newTab;
};

</script>
