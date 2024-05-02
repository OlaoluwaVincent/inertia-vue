<template>
  <section class="content__padding">
    <h1>Popular instructors</h1>
    <v-sheet class=" sheet__wrapper !tw-py-5" color='transparent' v-if="data && data.length > 0">

      <v-card class="v__card-popular tw-mx-auto tw-w-full tw-relative !tw-p-3" v-for="(instructor, key) in sortedData"
        :key="key">
        <v-img :src="instructor.profile" cover></v-img>

        <v-card-item>
          <v-card-title>{{ instructor.name }}</v-card-title>

          <v-card-subtitle>
            <span class="me-1">role</span>

            <v-icon color="error" icon="mdi-fire-circle" size="small"></v-icon>
          </v-card-subtitle>
        </v-card-item>


        <v-divider thickness="3" class="divider__line" color="warning"></v-divider>
        <div class="tw-flex tw-items-center tw-justify-between tw-py-2">
          <v-rating model-value="3" color="amber" density="compact" size="small" half-increments readonly></v-rating>
          <v-card-subtitle>400+</v-card-subtitle>
        </div>

      </v-card>

    </v-sheet>

  </section>
</template>




<script setup>
import axios from 'axios';
import { ref, onMounted, computed } from 'vue';

const data = ref([]);

onMounted(async () => {
  try {
    const response = await axios.get('/api/instructors');
    data.value = response.data.splice(0, 5);
  } catch (error) {
    console.error('Error fetching items:', error);
  }
});

const sortedData = computed(() => {
  return data.value
    .slice()
    .sort((a, b) => b.instructor_courses.length - a.instructor_courses.length)
});

</script>


<style scoped>
.sheet__wrapper {
  width: 100%;
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  gap: 16px;
  justify-items: center;
}

.img__height {
  height: 180px;
}

.divider__line {
  color: red !important;
  opacity: 1;
  z-index: 100;
}

@media (width>430px) {
  .sheet__wrapper {
    grid-template-columns: repeat(2, 1fr);
    padding: 5%;
    gap: 3%;
  }

  .img__height {
    height: 200px;
  }
}

@media (width>=768px) {
  .sheet__wrapper {
    grid-template-columns: repeat(3, 1fr);
    padding: 0;
  }

  .img__height {
    height: 200px;
  }

  .v__card-popular:last-child {
    display: none;
  }
}

@media (width>=1024px) {
  .sheet__wrapper {
    grid-template-columns: repeat(5, 1fr);
  }

  .v__card-popular:last-child {
    display: block;
  }
}
</style>