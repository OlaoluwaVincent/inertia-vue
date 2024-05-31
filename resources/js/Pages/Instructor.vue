<template>
  <section class="content__padding tw-flex tw-flex-col md:tw-flex-row tw-justify-between tw-gap-8 md:gap-0 tw-mb-10">

    <section id="about" class="tw-space-y-3 md:tw-space-y-5 md:tw-w-[60%]">

      <div>
        <h5 :class="theme.isDark && 'tw-text-slate-100'" class="tw-text-gray-600">Instructor</h5>
        <h1 class="tw-text-xl tw-font-bold md:tw-text-2xl tw-my-3">{{ details.user.fullname }}</h1>
        <p :class="theme.isDark && 'tw-text-slate-100'" class="tw-text-gray-600 tw-text-center md:tw-text-left">{{
          details.headline }}</p>
      </div>

      <v-divider class="mt-10"></v-divider>

      <div id="counts" class="tw-flex tw-items-center tw-gap-5 tw-justify-center md:tw-max-w-fit">
        <span class="tw-text-center">
          <h6 class="tw-mb-2">Total Students</h6>
          <p class="tw-font-semibold md:tw-font-black tw-text-xl md:tw-text-2xl">10</p>
        </span>

        <span class="tw-text-center">
          <h6 class="tw-mb-2">Reviews</h6>
          <p class="tw-font-semibold md:tw-font-black tw-text-xl md:tw-text-2xl">{{ reviews.length }}</p>
        </span>
      </div>

      <div id="experience">
        <h3 class="tw-mb-3 tw-font-bold tw-text-lg">About {{ details.user.fullname }}</h3>
        <p class="tw-whitespace-pre tw-text-wrap tw-text-justify md:tw-text-left">{{ details.professional_experience }}
        </p>
      </div>

      <div id="expertise">
        <h3 class="tw-mb-3 tw-font-bold tw-text-lg">Expertise</h3>
        <ul class="tw-list-disc tw-ml-8">
          <li v-for="(expertise, index) in details.expertise" :key="index">
            <p class="tw-whitespace-pre tw-text-wrap">{{ expertise }}</p>
          </li>
        </ul>
      </div>
    </section>

    <section id="profile" class="tw-min-w-[280px] tw-text-center tw-px-5">
      <v-avatar size="150" color="teal darken-4">
        <img :src="details.user.profile_picture" :alt="details.user.fullname">
      </v-avatar>
      <div class="tw-space-y-3 tw-mt-4">
        <v-btn v-for="(social, index) in details.user.socials" :key="index" :href="social.link" target="_blank" block
          variant="outlined" :color="theme.isDark ? 'teal-lighten-3' : 'teal-darken-4'">{{
            social.handle }}</v-btn>
      </div>
    </section>

    <div class="tw-my-10">
      <h3 class="tw-font-semibold tw-text-xl md:tw-text-2xl">Courses by <span class="tw-text-blue-600">{{
        details.user.fullname }}</span></h3>
      <ScrollX scrollable>
        <CourseCard :data="courses" />
      </ScrollX>

    </div>
  </section>
</template>

<script setup>
import CourseCard from '@/Components/CourseCard.vue';
import ScrollX from '@/Components/ScrollX.vue';
import { useThemeStore } from '@/store/theme';

const theme = useThemeStore();
const props = defineProps({
  details: Object,
  courses: Array,
  reviews: Array,
});
</script>

<style scoped>
#profile *,
#about * {
  font-size: 90% !important;
}

@media (width>=768px) {

  #profile *,
  #about * {
    font-size: 100% !important;
  }
}
</style>