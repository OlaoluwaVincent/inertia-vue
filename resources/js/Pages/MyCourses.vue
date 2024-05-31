<template>
  <div class="tw-pt-5">
    <p v-if="courses.data === undefined || !courses.data.length">
      <span v-if="isStudent">You have not enrolled for any course yet.</span>
      <span v-else>You have not created any course yet</span>
    </p>
    <Link v-if="!isStudent" href="my-courses/create"
      class="tw-bg-teal-800 tw-text-white tw-p-2 rounded-md tw-mb-5 tw-block tw-w-fit">
    Add Course
    </Link>
    <div v-if="isStudent" class="tw-flex tw-flex-col tw-gap-5 md:tw-gap-8">
      <EnrolledCard v-for="course in courseData.data" :course="course" :key="course.id" />
    </div>
    <section class="courses">
      <CourseCard v-if="!isStudent" :data="courseData.data" :canDelete="!isStudent" />
    </section>

    <Pagination v-if="courseData.next_page_url" :links="courseData.links" />
  </div>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";
import CourseCard from "@/Components/CourseCard.vue";
import EnrolledCard from "@/Components/EnrolledCard.vue";
import Pagination from "@/Components/Pagination.vue";

import UserLayout from "@/Layouts/UserLayout.vue";
import { computed, ref } from "vue";
import { useCartStore } from "@/store/cart";

defineOptions({ layout: UserLayout });

const props = defineProps({
  courses: Object,
  status: Boolean,
  isStudent: Boolean,
});

const cartStore = useCartStore()

if (props.status) {
  cartStore.clearCart()
}
const courses_data = ref(props.courses);

const courseData = computed(() =>
  props.isStudent
    ? {
      ...props.courses,
      data: courses_data.value["data"].map((course) => course.course[0]),
    }
    : props.courses
);
</script>

<style scoped>
.courses {
  padding: 5%;
  padding-top: 0;
  display: grid;
  grid-template-columns: 1fr;
  gap: 20px;
}

@media (width>430px) {
  .courses {
    grid-template-columns: 1fr 1fr;
  }
}

@media (width>768px) {
  .courses {
    grid-template-columns: 1fr 1fr 1fr;
  }
}

@media (width>=1024px) {
  .courses {
    grid-template-columns: 1fr 1fr 1fr 1fr;
  }
}
</style>
