<template>
 <section class="content__padding">

  <h1>Popular Categories</h1>
  <v-sheet class="sheet__wrapper !tw-py-5" color='transparent' v-if="data && data.length > 0">

   <v-card v-for="(item, key) in data" :key="key" class="v__card-popular tw-mx-auto tw-w-full" color="blue-lighten-3">
    <v-img :src="item.image" cover class="tw-h-[140px]"></v-img>

    <v-card-item class="!tw-pb-0">
     <v-card-title class="tw-text-ellipsis tw-overflow-x-hidden !tw-text-sm md:!tw-text-base">{{ item.title
      }}</v-card-title>

     <v-card-subtitle class="!tw-b-0">
      <span class="tw-me-1 tw-text-xs md:tw-text-base">By {{ item.instructor.name }}</span>
      <v-icon color="error" icon="mdi-fire-circle" size="small"></v-icon>
     </v-card-subtitle>
    </v-card-item>

    <v-card-text class="">
     <div class="tw-flex tw-items-center tw-mx-0 tw-gap-4">
      <v-rating :model-value="4.5" color="amber" density="comfortable" size="small" half-increments readonly></v-rating>
      <div class="tw-text-grey-400 tw-hidden md:tw-block">4.5 (413)</div>
     </div>

     <div>{{ item.duration }} Total Hours</div>
     <div>{{ item.price }}</div>
    </v-card-text>
   </v-card>

  </v-sheet>

 </section>
</template>

<script setup>
import { onMounted, ref } from 'vue';
import axios from 'axios';

const data = ref([])

onMounted(() => {
 axios.get('/api/popular').then(response => {
  const items = response.data
  data.value = items;
 }).catch(error => {
  console.error('Error fetching items:', error)
 })
})

</script>

<style scoped>
.sheet__wrapper {
 width: 100%;
 display: grid;
 grid-template-columns: 1fr;
 /* grid-template-columns: repeat(2, 1fr); */
 gap: 16px;
 justify-items: center;
}

@media (width>430px) {
 .sheet__wrapper {
  grid-template-columns: repeat(2, 1fr);
  padding: 5%;
  gap: 3%;
 }
}

@media (width>=768px) {
 .sheet__wrapper {
  grid-template-columns: repeat(3, 1fr);
  padding: 0;
 }

 .v__card-popular:last-child {
  display: none;
 }
}

@media (width>=1024px) {
 .sheet__wrapper {
  grid-template-columns: repeat(4, 1fr);
 }

 .v__card-popular:last-child {
  display: block;
 }
}
</style>