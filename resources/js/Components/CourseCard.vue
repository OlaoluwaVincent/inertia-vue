<template>
  <v-card
    v-for="(item, key) in data"
    :key="key"
    class="v__card-popular tw-mx-auto tw-w-full tw-relative tw-min-w-[200px] lg:tw-min-w-[250px] tw-max-w-[280px]"
    :class="className"
  >
    <v-img :src="item.image" cover class="img__height tw-relative">
      <v-btn
        v-if="!store.checkExisting(item.id)"
        @click="() => handleCartClick(item)"
        class="tw-absolute tw-top-3 tw-left-3 tw-z-10 tw-w-full"
        color="warning"
        icon="mdi-cart"
        variant="flat"
      >
      </v-btn>
    </v-img>

    <v-card-item class="!tw-pb-0">
      <v-card-title
        class="tw-text-ellipsis tw-overflow-x-hidden !tw-text-sm md:!tw-text-base"
      >
        <Link :href="route('course.single', { id: item.id })">
          {{ item.title }}
        </Link>
      </v-card-title>

      <v-card-subtitle class="!tw-b-0">
        <span class="tw-me-1 tw-text-xs md:tw-text-base"
          >By {{ item.instructor.name }}</span
        >
        <v-icon color="error" icon="mdi-fire-circle" size="small"></v-icon>
      </v-card-subtitle>
    </v-card-item>

    <v-card-text>
      <div class="tw-flex tw-items-center tw-mx-0 tw-gap-4">
        <v-rating
          :model-value="4.5"
          color="amber"
          density="compact"
          size="small"
          half-increments
          readonly
        ></v-rating>
        <div class="tw-text-grey-400 tw-hidden md:tw-block">4.5 (413)</div>
        <p>{{ item.duration }}hrs</p>
      </div>

      <!-- <div>{{ item.duration }} Total Hours</div> -->
      <p class="tw-font-semibold tw-text-lg">${{ item.price }}</p>
    </v-card-text>
  </v-card>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";
import { useCartStore } from "@/store/cart";
const store = useCartStore();

const props = defineProps({
  data: Array,
  className: String,
});

function handleCartClick(value) {
  store.addToCart(value);
}
</script>

<style scoped>
.img__height {
  height: 180px;
}

@media (width>430px) {
  .img__height {
    height: 200px;
  }
}

@media (width>=768px) {
  .img__height {
    height: 200px;
  }
}

@media (width>=1024px) {
  .v__card-popular:last-child {
    display: block;
  }
}
</style>