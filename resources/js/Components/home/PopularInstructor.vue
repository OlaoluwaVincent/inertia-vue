<template>
  <section class="content__padding">
    <SectionTitle title="Popular Instructors" />
    <ScrollX v-if="data && data.length > 0" :scrollable="true">
      <v-card
        class="tw-max-w-[220px] tw-mx-auto tw-w-full tw-relative !tw-p-3"
        v-for="(instructor, key) in data"
        min-width="150"
        :key="key"
      >
        <v-img
          :src="instructor.profile"
          cover
          position="top"
          class="img__height"
        ></v-img>

        <v-card-item>
          <v-card-title class="!tw-text-sm md:!tw-text-base">{{
            instructor.name
          }}</v-card-title>
        </v-card-item>

        <v-divider
          thickness="3"
          class="divider__line"
          color="warning"
        ></v-divider>
        <div class="tw-flex tw-items-center tw-justify-between tw-py-2">
          <v-rating
            model-value="3"
            color="amber"
            density="compact"
            size="small"
            half-increments
            readonly
          ></v-rating>
          <v-card-subtitle
            >{{ instructor.instructor_courses }}+</v-card-subtitle
          >
        </div>
      </v-card>
    </ScrollX>
  </section>
</template>




<script setup>
import axios from "axios";
import { ref, onMounted } from "vue";
import SectionTitle from "./SectionTitle.vue";
import ScrollX from "../ScrollX.vue";

const data = ref([]);

async function getPopularInstructors() {
  try {
    const response = await axios.get("/api/popular/instructors");
    data.value = response.data;
  } catch (error) {
    console.error("Error fetching items:", error);
  }
}

onMounted(async () => {
  await getPopularInstructors();
});
</script>


<style scoped>
.img__height {
  height: 140px;
}

.divider__line {
  @apply tw-border-blue-500;
  opacity: 1;
  z-index: 100;
}

@media (width>430px) {
  .img__height {
    height: 150px;
  }
}

@media (width>=768px) {
  .img__height {
    height: 160px;
  }
}
</style>