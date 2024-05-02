<template>
 <section class="content__padding">

  <h1>Popular Categories</h1>
  <v-sheet class="sheet__wrapper !tw-py-5" color='transparent' v-if="data && data.length > 0">

   <v-card v-for="(item, key) in data" :key="key" class="v__card-popular tw-mx-auto tw-w-full tw-relative">


    <v-img :src="item.image" cover class="img__height tw-relative">
     <v-btn @click="() => handleCartClick(item)" class="tw-absolute tw-top-3 tw-left-3 tw-z-10 tw-w-full"
      color="warning" icon="mdi-cart" variant="flat">
     </v-btn>
    </v-img>

    <v-card-item class="!tw-pb-0">
     <v-card-title class="tw-text-ellipsis tw-overflow-x-hidden !tw-text-sm md:!tw-text-base">{{ item.title
      }}</v-card-title>

     <v-card-subtitle class="!tw-b-0">
      <span class="tw-me-1 tw-text-xs md:tw-text-base">By {{ item.instructor.name }}</span>
      <v-icon color="error" icon="mdi-fire-circle" size="small"></v-icon>
     </v-card-subtitle>
    </v-card-item>

    <v-card-text>
     <div class="tw-flex tw-items-center tw-mx-0 tw-gap-4">
      <v-rating :model-value="4.5" color="amber" density="compact" size="small" half-increments readonly></v-rating>
      <div class="tw-text-grey-400 tw-hidden md:tw-block">4.5 (413)</div>
     </div>

     <div>{{ item.duration }} Total Hours</div>
     <p class="tw-font-semibold tw-text-lg ">${{ item.price }}</p>
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
 axios.get('/api/courses').then(response => {
  const items = response.data
  data.value = items.splice(0, 4);
 }).catch(error => {
  console.error('Error fetching items:', error)
 })
})



import { useCartStore } from "@/store/cart";
const store = useCartStore();

function handleCartClick(value) {
 store.addToCart(value)
}
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

.img__height {
 height: 180px;
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
  grid-template-columns: repeat(4, 1fr);
 }

 .v__card-popular:last-child {
  display: block;
 }
}
</style>